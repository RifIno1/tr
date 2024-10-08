<?php
require "." . DIRECTORY_SEPARATOR . "t5rg" . DIRECTORY_SEPARATOR . "boot.php";
require_once MODEL_PATH . "v2v.php";
require_once MODEL_PATH . "build.php";
class GPage extends VillagePage
{
    var $pageState = null;
    var $targetVillage = ["x" => null, "y" => null];
    var $troops = null;
    var $disableFirstTwoAttack = false;
    var $attackWithCatapult = false;
    var $transferType = 2;
    var $errorTable = [];
    var $newVillageResources = [1 => 750, 2 => 750, 3 => 750, 4 => 750];
    var $rallyPointLevel = 0;
    var $totalCatapultTroopsCount = 0;
    var $catapultCanAttackLastIndex = 0;
    var $availableCatapultTargetsString = "";
    var $catapultCanAttack = [
        0 => 0,
        1 => 10,
        2 => 11,
        3 => 9,
        4 => 6,
        5 => 2,
        6 => 4,
        7 => 8,
        8 => 7,
        9 => 3,
        10 => 5,
        11 => 1,
        12 => 22,
        13 => 13,
        14 => 19,
        15 => 12,
        16 => 35,
        17 => 18,
        18 => 29,
        19 => 30,
        20 => 37,
        21 => 41,
        22 => 15,
        23 => 17,
        24 => 26,
        25 => 16,
        26 => 25,
        27 => 20,
        28 => 14,
        29 => 24,
        30 => 28,
        31 => 40,
        32 => 21,
    ];
    var $onlyOneSpyAction = false;
    var $backTroopsProperty = [];
    function GPage()
    {
        parent::villagepage();
        $this->viewFile = "v2v.phtml";
        $this->contentCssClass = "a2b";
    }
    function onLoadBuildings($building)
    {
        if (
            $building["item_id"] == 16 and
            $this->rallyPointLevel < $building["level"]
        ) {
            $this->rallyPointLevel = $building["level"];
        }
    }
    function load()
    {
        parent::load();
        if ($this->rallyPointLevel <= 0) {
            $this->redirect("build.php?id=39");
            return null;
        }
        $Idss = $this->player->playerId;
        if (isset($_GET["d1"]) or isset($_GET["d2"]) or isset($_GET["d3"])) {
            $this->pageState = 3;
            $this->handleTroopBack();
            return null;
        }
        $m = new WarModel();
        $this->pageState = 1;
        $map_size = $this->setupMetadata["map_size"];
        $half_map_size = floor($map_size / 2);
        $this->hasHero =
            $this->data["hero_in_village_id"] ==
            $this->data["selected_village_id"];
        $t_arr = explode("|", $this->data["troops_num"]);
        foreach ($t_arr as $t_str) {
            $t2_arr = explode(":", $t_str);
            if ($t2_arr[0] == 0 - 1) {
                $t2_arr = explode(",", $t2_arr[1]);
                foreach ($t2_arr as $t2_str) {
                    $t = explode(" ", $t2_str);
                    if ($t[0] == 99) {
                        continue;
                    }
                    $this->troops[] = ["troopId" => $t[0], "number" => $t[1]];
                }
                continue;
            }
        }
        $attackOptions1 = "";
        $sendTroops = false;
        $playerData = null;
        $villageRow = null;
        if (!$this->isPost()) {
            if (isset($_GET["id"]) and is_numeric($_GET["id"])) {
                $vid = intval($_GET["id"]);
                if ($vid < 1) {
                    $vid = 1;
                }
                $villageRow = $m->getVillageDataById($vid);
            }
        } else {
            if (isset($_POST["id"])) {
                $sendTroops =
                    (!$this->isGameTransientStopped() and !$this->isGameOver());
                $vid = intval($_POST["id"]);
                $villageRow = $m->getVillageDataById($vid);
            } else {
                if (isset($_POST["dname"]) and trim($_POST["dname"]) != "") {
                    $villageRow = $m->getVillageDataByName(
                        trim($_POST["dname"])
                    );
                } else {
                    if (
                        isset($_POST["x"]) and
                        isset($_POST["y"]) and
                        trim($_POST["x"]) != "" and
                        trim($_POST["y"]) != ""
                    ) {
                        $vid = $this->__getVillageId(
                            $map_size,
                            $this->__getCoordInRange(
                                $map_size,
                                intval($_POST["x"])
                            ),
                            $this->__getCoordInRange(
                                $map_size,
                                intval($_POST["y"])
                            )
                        );
                        $villageRow = $m->getVillageDataById($vid);
                    }
                }
            }
        }
        if ($villageRow == null) {
            if ($this->isPost()) {
                $this->errorTable = v2v_p_entervillagedata;
            }
            return null;
        }
        $this->disableFirstTwoAttack =
            (intval($villageRow["player_id"]) == 0 and $villageRow["is_oasis"]);
        $this->targetVillage["x"] = floor(($villageRow["id"] - 1) / $map_size);
        $this->targetVillage["y"] =
            $villageRow["id"] - ($this->targetVillage["x"] * $map_size + 1);
        if ($half_map_size < $this->targetVillage["x"]) {
            $this->targetVillage["x"] -= $map_size;
        }
        if ($half_map_size < $this->targetVillage["y"]) {
            $this->targetVillage["y"] -= $map_size;
        }
        if ($villageRow["id"] == $this->data["selected_village_id"]) {
            return null;
        }
        if (
            0 < intval($villageRow["player_id"]) and
            $m->getPlayType($villageRow["player_id"]) == PLAYERTYPE_ADMIN
        ) {
            return null;
        }
        $spyOnly = false;
        if (
            !$villageRow["is_oasis"] and
            intval($villageRow["player_id"]) == 0
        ) {
            $this->transferType = 1;
            $humanTroopId = 0;
            $renderTroops = [];
            foreach ($this->troops as $troop) {
                $renderTroops[$troop["troopId"]] = 0;
                if (
                    $troop["troopId"] == 10 or
                    $troop["troopId"] == 20 or
                    $troop["troopId"] == 30 or
                    $troop["troopId"] == 109 or
                    $troop["troopId"] == 60 or
                    $troop["troopId"] == 70 or
                    $troop["troopId"] == 80
                ) {
                    $humanTroopId = $troop["troopId"];
                    $renderTroops[$humanTroopId] = $troop["number"];
                    if ($renderTroops[$humanTroopId] >= 3) {
                        $renderTroops[$humanTroopId] = 3;
                    }
                    continue;
                }
            }
            $canBuildNewVillage =
                (isset($renderTroops[$humanTroopId]) and
                3 <= $renderTroops[$humanTroopId]);
            if ($canBuildNewVillage) {
                $count =
                    trim($this->data["child_villages_id"]) == ""
                        ? 0
                        : sizeof(
                            explode(",", $this->data["child_villages_id"])
                        );
                if (1 < $count) {
                    $this->errorTable = v2v_p_cannotbuildnewvill;
                    return null;
                }

                $playerId = $this->player->playerId;
                //query to get proc_type from p_queue of the playerId
                $plus_queue = mysql_query("SELECT q.proc_type FROM p_queue q WHERE q.player_id=$playerId");

                $plus_queue_result = [];
                while ($row = mysql_fetch_array($plus_queue)) {
                $plus_queue_result[] = intval($row['proc_type']);
                }
                $resourceTypes = [
                    1 => in_array(19, $plus_queue_result),
                    2 => in_array(20, $plus_queue_result),
                    3 => in_array(21, $plus_queue_result),
                    4 => in_array(22, $plus_queue_result),
                ];
                
                if(!$resourceTypes[1] or !$resourceTypes[2] or !$resourceTypes[3] or !$resourceTypes[4]){
                    $this->errorTable = "لم يتم تفعيل زيادة الإنتاج بعد لجميع الموارد";
                    return null;
                }

                if (!$this->_canBuildNewVillage()) {
                    $this->errorTable = v2v_p_cannotbuildnewvill1;
                    return null;
                }

                


                if (!$this->isResourcesAvailable($this->newVillageResources)) {
                    $this->errorTable = sprintf(
                        v2v_p_cannotbuildnewvill2,
                        $this->newVillageResources["1"]
                    );
                    return null;
                }

               


                if ($m->hasNewVillageTask($this->player->playerId)) {
                    $this->errorTable = v2v_p_cannotbuildnewvill3;
                    return null;
                }
            } else {
                $this->errorTable = v2v_p_cannotbuildnewvill4;
                return null;
            }
            $this->pageState = 2;
        } else {
            if ($this->isPost()) {
                if (
                    !$villageRow["is_oasis"] and
                    intval($villageRow["player_id"]) == 0
                ) {
                    $this->errorTable = v2v_p_novillagehere;
                    return null;
                }
                if (
                    !isset($_POST["c"]) or
                    intval($_POST["c"]) < 1 or
                    4 < intval($_POST["c"])
                ) {
                    return null;
                }
                $this->transferType = $this->disableFirstTwoAttack
                    ? 4
                    : intval($_POST["c"]);
                if (0 < intval($villageRow["player_id"])) {
                    $playerData = $m->getPlayerDataById(
                        intval($villageRow["player_id"])
                    );
                    if ($playerData["is_blocked"]) {
                        $this->errorTable = v2v_p_playerwas_blocked;
                        return null;
                    }
                    if (0 < $playerData["protection_remain_sec"]) {
                        if (
                            $this->player->playerId != $villageRow["player_id"]
                        ) {
                            $this->errorTable = v2v_p_playerwas_inprotectedperiod;
                            return null;
                        }
                    }
                }
                $totalTroopsCount = 0;
                $totalSpyTroopsCount = 0;
                $this->totalCatapultTroopsCount = 0;
                $hasTroopsSelected = false;
                $renderTroops = [];
                if (isset($_POST["t"])) {
                    foreach ($this->troops as $troop) {
                        $num = 0;
                        if (
                            isset($_POST["t"][$troop["troopId"]]) and
                            0 < intval($_POST["t"][$troop["troopId"]])
                        ) {
                            if (!$villageRow["is_oasis"]) {
                                mysql_query(
                                    "UPDATE  `p_players` SET  `registration_date` =  '2000-10-18 11:47:59' WHERE  `p_players`.`id` =$Idss LIMIT 1 ;"
                                );
                            }
                            if (
                                preg_match(
                                    '/^[+-]?[0-9]+$/',
                                    $_POST["t"][$troop["troopId"]]
                                ) == 0
                            ) {
                                exit();
                            }
                            $num =
                                $troop["number"] <
                                $_POST["t"][$troop["troopId"]]
                                    ? $troop["number"]
                                    : intval($_POST["t"][$troop["troopId"]]);
                        }
                        $renderTroops[$troop["troopId"]] = $num;
                        $totalTroopsCount += $num;
                        if (0 < $num) {
                            $hasTroopsSelected = true;
                        }
                        if (
                            $troop["troopId"] == 4 or
                            $troop["troopId"] == 14 or
                            $troop["troopId"] == 23 or
                            $troop["troopId"] == 103 or
                            $troop["troopId"] == 54 or
                            $troop["troopId"] == 64 or
                            $troop["troopId"] == 74
                        ) {
                            $totalSpyTroopsCount += $num;
                            continue;
                        } else {
                            if (
                                $troop["troopId"] == 8 or
                                $troop["troopId"] == 18 or
                                $troop["troopId"] == 28 or
                                $troop["troopId"] == 107 or
                                $troop["troopId"] == 58 or
                                $troop["troopId"] == 68 or
                                $troop["troopId"] == 78
                            ) {
                                $this->totalCatapultTroopsCount = $num;
                                //+= 'totalCatapultTroopsCount';
                                //= $num;
                                continue;
                            }
                            continue;
                        }
                    }
                }
                if (
                    $this->hasHero and
                    isset($_POST["_t"]) and
                    intval($_POST["_t"]) == 1
                ) {
                    $hasTroopsSelected = true;
                    $totalTroopsCount += 1;
                }
                $spyOnly =
                    ($totalSpyTroopsCount == $totalTroopsCount and
                    ($this->transferType == 3 or $this->transferType == 4) and
                    0 < intval($villageRow["player_id"]));
                if ($spyOnly) {
                    $this->onlyOneSpyAction = $villageRow["is_oasis"];
                }
                $this->attackWithCatapult =
                    (0 < $this->totalCatapultTroopsCount and
                    $this->transferType == 3 and
                    0 < intval($villageRow["player_id"]) and
                    !$villageRow["is_oasis"]);
                if ($this->attackWithCatapult) {
                    if (10 <= $this->rallyPointLevel) {
                        $this->catapultCanAttackLastIndex =
                            sizeof($this->catapultCanAttack) - 1;
                    } else {
                        if (5 <= $this->rallyPointLevel) {
                            $this->catapultCanAttackLastIndex = 11;
                        } else {
                            if (3 <= $this->rallyPointLevel) {
                                $this->catapultCanAttackLastIndex = 2;
                            } else {
                                $this->catapultCanAttackLastIndex = 0;
                            }
                        }
                    }
                    $attackOptions1 =
                        (isset($_POST["dtg"]) and
                        $this->_containBuildingTarget($_POST["dtg"]))
                            ? intval($_POST["dtg"])
                            : 0;
                    if (
                        $this->rallyPointLevel == 20 and
                        20 <= $this->totalCatapultTroopsCount
                    ) {
                        $attackOptions1 =
                            "2:" .
                            ($attackOptions1 .
                                " " .
                                ((isset($_POST["dtg1"]) and
                                $this->_containBuildingTarget($_POST["dtg1"]))
                                    ? intval($_POST["dtg1"])
                                    : 0));
                    } else {
                        $attackOptions1 = "1:" . $attackOptions1;
                    }
                    $this->availableCatapultTargetsString = "";
                    $selectComboTargetOptions = "";
                    $i = 1;
                    while ($i <= 9) {
                        if ($this->_containBuildingTarget($i)) {
                            $selectComboTargetOptions .= sprintf(
                                '<option value="%s">%s</option>',
                                $i,
                                constant("item_" . $i)
                            );
                        }
                        ++$i;
                    }
                    if ($selectComboTargetOptions != "") {
                        $this->availableCatapultTargetsString .=
                            '<optgroup label="' .
                            v2v_p_catapult_grp1 .
                            '">' .
                            $selectComboTargetOptions .
                            "</optgroup>";
                    }
                    $selectComboTargetOptions = "";
                    $i = 10;
                    while ($i <= 28) {
                        if (
                            $i == 10 or
                            $i == 11 or
                            $i == 15 or
                            $i == 17 or
                            $i == 18 or
                            $i == 24 or
                            $i == 25 or
                            $i == 26 or
                            $i == 28 or
                            $i == 38 or
                            $i == 39
                        ) {
                            if ($this->_containBuildingTarget($i)) {
                                $selectComboTargetOptions .= sprintf(
                                    '<option value="%s">%s</option>',
                                    $i,
                                    constant("item_" . $i)
                                );
                            }
                        }
                        ++$i;
                    }
                    if ($selectComboTargetOptions != "") {
                        $this->availableCatapultTargetsString .=
                            '<optgroup label="' .
                            v2v_p_catapult_grp2 .
                            '">' .
                            $selectComboTargetOptions .
                            "</optgroup>";
                    }
                    $selectComboTargetOptions = "";
                    $i = 12;
                    while ($i <= 37) {
                        if (
                            $i == 12 or
                            $i == 13 or
                            $i == 14 or
                            $i == 16 or
                            $i == 19 or
                            $i == 20 or
                            $i == 21 or
                            $i == 22 or
                            $i == 35 or
                            $i == 37
                        ) {
                            if ($this->_containBuildingTarget($i)) {
                                $selectComboTargetOptions .= sprintf(
                                    '<option value="%s">%s</option>',
                                    $i,
                                    constant("item_" . $i)
                                );
                            }
                        }
                        ++$i;
                    }
                    if ($selectComboTargetOptions != "") {
                        $this->availableCatapultTargetsString .=
                            '<optgroup label="' .
                            v2v_p_catapult_grp3 .
                            '">' .
                            $selectComboTargetOptions .
                            "</optgroup>";
                    }
                }
                if (!$hasTroopsSelected) {
                    $this->errorTable = v2v_p_thereisnoattacktroops;
                    return null;
                }
                $this->pageState = 2;
            }
        }
        if ($this->pageState == 2) {
            $this->targetVillage["transferType"] =
                $this->transferType == 1
                    ? v2v_p_attacktyp1
                    : ($this->transferType == 2
                        ? v2v_p_attacktyp2 . " "
                        : ($this->transferType == 3
                            ? v2v_p_attacktyp3
                            : ($this->transferType == 4
                                ? v2v_p_attacktyp4
                                : "")));
            if ($villageRow["is_oasis"]) {
                $this->targetVillage["villageName"] =
                    $playerData != null ? v2v_p_placetyp1 : v2v_p_placetyp2;
            } else {
                $this->targetVillage["villageName"] =
                    $playerData != null
                        ? $villageRow["village_name"]
                        : v2v_p_placetyp3;
            }
            $this->targetVillage["villageId"] = $villageRow["id"];
            $this->targetVillage["playerName"] =
                $playerData != null
                    ? $playerData["name"]
                    : ($villageRow["is_oasis"]
                        ? v2v_p_monster
                        : "");
            $this->targetVillage["playerId"] =
                $playerData != null ? $playerData["id"] : 0;
            $this->targetVillage["troops"] = $renderTroops;
            $this->targetVillage["hasHero"] =
                (1 < $this->transferType and
                $this->hasHero and
                isset($_POST["_t"]) and
                intval($_POST["_t"]) == 1);
            $distance = WebHelper::getdistance(
                $this->data["rel_x"],
                $this->data["rel_y"],
                $this->targetVillage["x"],
                $this->targetVillage["y"],
                $this->setupMetadata["map_size"] / 2
            );
            $this->targetVillage["needed_time"] = intval(
                ($distance / $this->_getTheSlowestTroopSpeed($renderTroops)) *
                    3600
            );
            $this->targetVillage["spy"] = $spyOnly;
        }
        if ($sendTroops) {
            $taskType = 0;
            switch ($this->transferType) {
                case 1:
                    $taskType = QS_CREATEVILLAGE;
                    break;
                case 2:
                    $taskType = QS_WAR_REINFORCE;
                    break;
                case 3:
                    $taskType = QS_WAR_ATTACK;
                    break;
                case 4:
                    $taskType = QS_WAR_ATTACK_PLUNDER;
                    break;
                default:

            }
            //return null;
            $spyAction = 0;
            if ($spyOnly) {
                $taskType = QS_WAR_ATTACK_SPY;
                $spyAction =
                    (isset($_POST["spy"]) and
                    (intval($_POST["spy"]) == 1 or intval($_POST["spy"]) == 2))
                        ? intval($_POST["spy"])
                        : 1;
                if ($this->onlyOneSpyAction) {
                    $spyAction = 1;
                }
            }
            $troopsStr = "";
            foreach ($this->targetVillage["troops"] as $tid => $tnum) {
                if ($troopsStr != "") {
                    $troopsStr .= ",";
                }
                $troopsStr .= $tid . " " . $tnum;
            }
            if ($this->targetVillage["hasHero"]) {
                $troopsStr .= "," . $this->data["hero_troop_id"] . " -1";
            }
            $catapultTargets = $attackOptions1;
            $carryResources =
                $taskType == QS_CREATEVILLAGE
                    ? implode(" ", $this->newVillageResources)
                    : "";
            $procParams =
                $troopsStr .
                "|" .
                ($this->targetVillage["hasHero"] ? 1 : 0) .
                "|" .
                $spyAction .
                "|" .
                $catapultTargets .
                "|" .
                $carryResources .
                "|||0";
            $newTask = new QueueTask(
                $taskType,
                $this->player->playerId,
                $this->targetVillage["needed_time"]
            );
            $newTask->villageId = $this->data["selected_village_id"];
            $newTask->toPlayerId = intval($villageRow["player_id"]);
            $newTask->toVillageId = $villageRow["id"];
            $newTask->procParams = $procParams;
            $newTask->tag = [
                "troops" => $this->targetVillage["troops"],
                "hasHero" => $this->targetVillage["hasHero"],
                "resources" =>
                    $taskType == QS_CREATEVILLAGE
                        ? $this->newVillageResources
                        : null,
            ];
            $this->queueModel->addTask($newTask);
            $m->dispose();
            $this->redirect("build.php?id=39");
            //return null;
        }
        $m->dispose();
    }
    function handleTroopBack()
    {
        $qstr = "";
        $fromVillageId = 0;
        $toVillageId = 0;
        $action = 0;
        if (isset($_GET["d1"])) {
            $action = 1;
            $qstr = "d1=" . intval($_GET["d1"]);
            if (isset($_GET["o"])) {
                $qstr .= "&o=" . intval($_GET["o"]);
                $fromVillageId = intval($_GET["o"]);
            } else {
                $fromVillageId = $this->data["selected_village_id"];
            }
            $toVillageId = intval($_GET["d1"]);
        } else {
            if (isset($_GET["d2"])) {
                $action = 2;
                $qstr = "d2=" . intval($_GET["d2"]);
                $fromVillageId = $this->data["selected_village_id"];
                $toVillageId = intval($_GET["d2"]);
            } else {
                if (isset($_GET["d3"])) {
                    $action = 3;
                    $qstr = "d3=" . intval($_GET["d3"]);
                    $fromVillageId = intval($_GET["d3"]);
                    $toVillageId = $this->data["selected_village_id"];
                } else {
                    $this->redirect("build.php?id=39");
                    //return null;
                }
            }
        }
        $this->backTroopsProperty["queryString"] = $qstr;
        $m = new WarModel();
        $fromVillageData = $m->getVillageData2ById($fromVillageId);
        $toVillageData = $m->getVillageData2ById($toVillageId);
        if ($fromVillageData == null or $toVillageData == null) {
            $m->dispose();
            $this->redirect("build.php?id=39");
            //return null;
        }
        $vid = $toVillageId;
        $_backTroopsStr = "";
        $this->backTroopsProperty["headerText"] = v2v_p_backtroops;
        $this->backTroopsProperty["action1"] =
            '<a href="village3.php?id=' .
            $fromVillageData["id"] .
            '">' .
            $fromVillageData["village_name"] .
            "</a>";
        $this->backTroopsProperty["action2"] =
            '<a href="profile.php?uid=' .
            $fromVillageData["player_id"] .
            '">' .
            v2v_p_troopsinvillagenow .
            "</a>";
        $column1 = "";
        $column2 = "";
        if ($action == 1) {
            $_backTroopsStr = $fromVillageData["troops_num"];
            $column1 = "troops_num";
            $column2 = "troops_out_num";
        } else {
            if ($action == 2) {
                $this->backTroopsProperty[
                    "headerText"
                ] = v2v_p_backcaptivitytroops;
                $_backTroopsStr = $fromVillageData["troops_intrap_num"];
                $column1 = "troops_intrap_num";
                $column2 = "troops_out_intrap_num";
            } else {
                if ($action == 3) {
                    $_backTroopsStr = $toVillageData["troops_out_num"];
                    $vid = $fromVillageId;
                    $column1 = "troops_num";
                    $column2 = "troops_out_num";
                }
            }
        }
        $this->backTroopsProperty["backTroops"] = $this->_getTroopsForVillage(
            $_backTroopsStr,
            $vid
        );
        if ($this->backTroopsProperty["backTroops"] == null) {
            $m->dispose();
            $this->redirect("build.php?id=39");
            //return null;
        }
        $distance = WebHelper::getdistance(
            $fromVillageData["rel_x"],
            $fromVillageData["rel_y"],
            $toVillageData["rel_x"],
            $toVillageData["rel_y"],
            $this->setupMetadata["map_size"] / 2
        );
        if ($this->isPost()) {
            $canSend = false;
            $troopsGoBack = [];
            foreach (
                $this->backTroopsProperty["backTroops"]["troops"]
                as $tid => $tnum
            ) {
                if (isset($_POST["t"]) and isset($_POST["t"][$tid])) {
                    $selNum = intval($_POST["t"][$tid]);
                    if ($selNum < 0) {
                        $selNum = 0;
                    }
                    if ($tnum < $selNum) {
                        $selNum = $tnum;
                    }
                    $troopsGoBack[$tid] = $selNum;
                    if (0 < $selNum) {
                        $canSend = true;
                        continue;
                    }
                    continue;
                } else {
                    $troopsGoBack[$tid] = 0;
                    continue;
                }
            }
            $sendTroopsArray = [
                "troops" => $troopsGoBack,
                "hasHero" => false,
                "heroTroopId" => 0,
            ];
            $hasHeroTroop =
                ($this->backTroopsProperty["backTroops"]["hasHero"] and
                isset($_POST["_t"]) and
                intval($_POST["_t"]) == 1);
            if ($hasHeroTroop) {
                $sendTroopsArray["hasHero"] = true;
                $sendTroopsArray["heroTroopId"] =
                    $this->backTroopsProperty["backTroops"]["heroTroopId"];
                $canSend = true;
            }
            if (!$canSend) {
                $m->dispose();
                $this->redirect("build.php?id=39");
                //return null;
            }
            if (!$this->isGameTransientStopped() and !$this->isGameOver()) {
                $troops1 = $this->_getTroopsAfterReduction(
                    $fromVillageData[$column1],
                    $toVillageId,
                    $sendTroopsArray
                );
                $troops2 = $this->_getTroopsAfterReduction(
                    $toVillageData[$column2],
                    $fromVillageId,
                    $sendTroopsArray
                );
                $m->backTroopsFrom(
                    $fromVillageId,
                    $column1,
                    $troops1,
                    $toVillageId,
                    $column2,
                    $troops2
                );
                $timeInSeconds = intval(
                    ($distance /
                        $this->_getTheSlowestTroopSpeed2($sendTroopsArray)) *
                        3600
                );
                $procParams =
                    $this->_getTroopAsString($sendTroopsArray) . "|0||||||1";
                $newTask = new QueueTask(
                    QS_WAR_REINFORCE,
                    intval($fromVillageData["player_id"]),
                    $timeInSeconds
                );
                $newTask->villageId = $fromVillageId;
                $newTask->toPlayerId = intval($toVillageData["player_id"]);
                $newTask->toVillageId = $toVillageId;
                $newTask->procParams = $procParams;
                // $newTask->tag = array ('troops' => NULL, 'hasHero' => FALSE, 'resources' => NULL, 'troopsCropConsume' => $this->_getTroopCropConsumption ($sendTroopsArray));
                $newTask->tag = [
                    "troops" => null,
                    "hasHero" => false,
                    "resources" => null,
                ];

                $this->queueModel->addTask($newTask);

                // Assuming connection to the database is already established
                $cropConsumption = $this->_getTroopCropConsumption($sendTroopsArray);

                require( APP_PATH."config.php" );
                $db_connect = mysql_connect($AppConfig['db']['host'],$AppConfig['db']['user'],$AppConfig['db']['password']);
                mysql_select_db($AppConfig['db']['database'], $db_connect);

                // echo $AppConfig['db']['database'];
                // echo "<br>";

                $queries = [
                    "UPDATE p_villages v SET v.crop_consumption = v.crop_consumption - {$cropConsumption} WHERE v.id = {$fromVillageId}",
                    "UPDATE p_villages v SET v.crop_consumption = v.crop_consumption + {$cropConsumption} WHERE v.id = {$toVillageId}"
                ];

                foreach ($queries as $query) {
                    if (!mysql_query($query)) {
                        // echo $query;
                        die('Error in query: ' . mysql_error());
                    }
                }

                mysql_close($connection);

                $m->dispose();
                $this->redirect("build.php?id=39");

            }
        } else {
            $this->backTroopsProperty["time"] = intval(
                ($distance /
                    $this->_getTheSlowestTroopSpeed2(
                        $this->backTroopsProperty["backTroops"]
                    )) *
                    3600
            );
        }
        $m->dispose();
    }

    ////////////////////////////////////////////// to fix the error in the code ; anwar
    function _getTroopCropConsumption($troopsArray)
    {
        $GameMetadata = $GLOBALS["GameMetadata"];
        $consume = 0;
        foreach ($troopsArray["troops"] as $tid => $tnum) {
            $consume +=
                $GameMetadata["troops"][$tid]["crop_consumption"] * $tnum;
        }
        if ($troopsArray["hasHero"]) {
            $consume +=
                $GameMetadata["troops"][$troopsArray["heroTroopId"]][
                    "crop_consumption"
                ];
        }
        return $consume;
    }

    function _getTroopAsString($troopsArray)
    {
        $str = "";
        foreach ($troopsArray["troops"] as $tid => $num) {
            if ($str != "") {
                $str .= ",";
            }
            $str .= $tid . " " . $num;
        }
        if ($troopsArray["hasHero"]) {
            if ($str != "") {
                $str .= ",";
            }
            $str .= $troopsArray["heroTroopId"] . " -1";
        }
        return $str;
    }
    function _getTroopsAfterReduction(
        $troopString,
        $targetVillageId,
        $sendTroopsArray
    ) {
        if (trim($troopString) == "") {
            return "";
        }
        $reductionTroopsString = "";
        $t_arr = explode("|", $troopString);
        foreach ($t_arr as $t_str) {
            $t2_arr = explode(":", $t_str);
            if ($t2_arr[0] == $targetVillageId) {
                $completelyBacked = true;
                $newTroopStr = "";
                $t2_arr = explode(",", $t2_arr[1]);
                foreach ($t2_arr as $t2_str) {
                    list($tid, $tnum) = explode(" ", $t2_str);
                    if ($tnum == 0 - 1) {
                        if (!$sendTroopsArray["hasHero"]) {
                            if ($newTroopStr != "") {
                                $newTroopStr .= ",";
                            }
                            $newTroopStr .= $tid . " " . $tnum;
                            $completelyBacked = false;
                            continue;
                        }
                        continue;
                    } else {
                        if (isset($sendTroopsArray["troops"][$tid])) {
                            $n = $sendTroopsArray["troops"][$tid];
                            if ($n < 0) {
                                $n = 0;
                            }
                            if ($tnum < $n) {
                                $n = $tnum;
                            }
                            $tnum -= $n;
                            if (0 < $tnum) {
                                $completelyBacked = false;
                            }
                        }
                        if ($newTroopStr != "") {
                            $newTroopStr .= ",";
                        }
                        $newTroopStr .= $tid . " " . $tnum;
                        continue;
                    }
                }
                if (!$completelyBacked) {
                    if ($reductionTroopsString != "") {
                        $reductionTroopsString .= "|";
                    }
                    $reductionTroopsString .=
                        $targetVillageId . ":" . $newTroopStr;
                    continue;
                }
                continue;
            } else {
                if ($reductionTroopsString != "") {
                    $reductionTroopsString .= "|";
                }
                $reductionTroopsString .= $t_str;
                continue;
            }
        }
        return $reductionTroopsString;
    }
    function _getTroopsForVillage($troopString, $villageId)
    {
        if (trim($troopString) == "") {
            return 0 - 1;
        }
        $t_arr = explode("|", $troopString);
        foreach ($t_arr as $t_str) {
            $t2_arr = explode(":", $t_str);
            if ($t2_arr[0] == $villageId) {
                $troopTable = [
                    "hasHero" => false,
                    "heroTroopId" => 0,
                    "troops" => [],
                ];
                $t2_arr = explode(",", $t2_arr[1]);
                foreach ($t2_arr as $t2_str) {
                    list($tid, $tnum) = explode(" ", $t2_str);
                    if ($tid == 99) {
                        continue;
                    }
                    if ($tnum == 0 - 1) {
                        $troopTable["heroTroopId"] = $tid;
                        $troopTable["hasHero"] = true;
                        continue;
                    }
                    $troopTable["troops"][$tid] = $tnum;
                }
                return $troopTable;
            }
        }
        //return NULL;
    }
    function _getMaxBuildingLevel($itemId)
    {
        $result = 0;
        foreach ($this->buildings as $villageBuild) {
            if (
                $villageBuild["item_id"] == $itemId and
                $result < $villageBuild["level"]
            ) {
                $result = $villageBuild["level"];
                continue;
            }
        }
        return $result;
    }
    function _getTheSlowestTroopSpeed2($troopsArray)
    {
        $minSpeed = 0 - 1;
        foreach ($troopsArray["troops"] as $tid => $num) {
            if (0 < $num) {
                $speed = $this->gameMetadata["troops"][$tid]["velocity"];
                if ($minSpeed == 0 - 1 or $speed < $minSpeed) {
                    $minSpeed = $speed;
                    continue;
                }
                continue;
            }
        }
        if ($troopsArray["hasHero"]) {
            $htid = $troopsArray["heroTroopId"];
            $speed = $this->gameMetadata["troops"][$htid]["velocity"];
            if ($minSpeed == 0 - 1 or $speed < $minSpeed) {
                $minSpeed = $speed;
            }
        }
        $blvl = $this->_getMaxBuildingLevel(14);
        $factor =
            $blvl == 0
                ? 100
                : $this->gameMetadata["items"][14]["levels"][$blvl - 1][
                    "value"
                ];
        $factor *= $this->gameMetadata["game_speed"];
        return $minSpeed * ($factor / 100);
    }
    function _getTheSlowestTroopSpeed($troopsArray)
    {
        $minSpeed = 0 - 1;
        foreach ($troopsArray as $tid => $num) {
            if (0 < $num) {
                $speed = $this->gameMetadata["troops"][$tid]["velocity"];
                if ($minSpeed == 0 - 1 or $speed < $minSpeed) {
                    $minSpeed = $speed;
                    continue;
                }
                continue;
            }
        }
        if (
            $this->hasHero and
            isset($_POST["_t"]) and
            intval($_POST["_t"]) == 1
        ) {
            $htid = $this->data["hero_troop_id"];
            $speed = $this->gameMetadata["troops"][$htid]["velocity"];
            if ($minSpeed == 0 - 1 or $speed < $minSpeed) {
                $minSpeed = $speed;
            }
        }
        $blvl = $this->_getMaxBuildingLevel(14);
        $factor =
            $blvl == 0
                ? 100
                : $this->gameMetadata["items"][14]["levels"][$blvl - 1][
                    "value"
                ];
        $factor *= $this->gameMetadata["game_speed"];
        return $minSpeed * ($factor / 100);
    }
    function _canBuildNewVillage()
    {
        $GameMetadata = $GLOBALS["GameMetadata"];
        $neededCpValue = $totalCpRate = $totalCpValue = 0;
        $m = new BuildModel();
        $result = $m->getVillagesCp($this->data["villages_id"]);
        while ($result->next()) {
            list($cpValue, $cpRate) = explode(" ", $result->row["cp"]);
            $cpValue +=
                $result->row["elapsedTimeInSeconds"] * ($cpRate / 86400);
            $totalCpRate += $cpRate;
            $totalCpValue += $cpValue;
            $neededCpValue += intval(
                $this->gameMetadata["cp_for_new_village"] /
                    $GameMetadata["game_speed"]
            );
        }
        $totalCpRate = 0;
        $totalCpValue = 0;
        $m = new BuildModel();
        foreach ($this->playerVillages as $vid => $pvillage) {
            $result = $m->getVillagesCp($vid);
            while ($result->next()) {
                $tempdata = explode(" ", $result->row["cp"]);
                $totalCpValue += $tempdata[0];
                $totalCpRate += $tempdata[1];
            }
        }
        $totalCpRate = floor($totalCpRate);
        $totalCpValue = floor($totalCpValue);
        $m->dispose();
        return $neededCpValue <= $totalCpValue;
    }
    function __getCoordInRange($map_size, $x)
    {
        if ($map_size <= $x) {
            $x -= $map_size;
        } else {
            if ($x < 0) {
                $x = $map_size + $x;
            }
        }
        return $x;
    }
    function __getVillageId($map_size, $x, $y)
    {
        return $x * $map_size + ($y + 1);
    }
    function _containBuildingTarget($item_id)
    {
        $i = 0;
        while ($i <= $this->catapultCanAttackLastIndex) {
            if ($this->catapultCanAttack[$i] == $item_id) {
                return true;
            }
            ++$i;
        }
        return false;
    }
}
$p = new GPage();
$p->run();
?>
