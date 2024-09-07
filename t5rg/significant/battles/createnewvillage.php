<?php

class NewVillageBattleModel extends BattleModel
{
    public function _getResourcesString($resources)
    {
        $result = "";
        foreach ($resources as $k => $v) {
            if ($result != "") {
                $result .= ",";
            }
            $result .=
                $k .
                " " .
                $v["current_value"] .
                " " .
                $v["store_max_limit"] .
                " " .
                $v["store_init_limit"] .
                " " .
                $v["prod_rate"] .
                " " .
                $v["prod_rate_percentage"];
        }
        return $result;
    }

    public function _getResourcesArray(
        $resourceString,
        $elapsedTimeInSeconds,
        $crop_consumption,
        $plus_queue_result
    ) {
        $resources = [];
        $r_arr = explode(",", $resourceString);
    
        $resourceTypes = [
            1 => in_array(19, $plus_queue_result),
            2 => in_array(20, $plus_queue_result),
            3 => in_array(21, $plus_queue_result),
            4 => in_array(22, $plus_queue_result),
        ];
    
        foreach ($r_arr as $r_str) {
            list($type, $init_value, $max_value, $init_limit, $prod_rate, $prod_bonus) = explode(" ", $r_str);
            $prate = floor($prod_rate * (1 + $prod_bonus / 100)) - ($type == 4 ? $crop_consumption : 0);
            $current_value = min(floor($init_value + $elapsedTimeInSeconds * ($prate / 3600)), $max_value);
            $plus = $resourceTypes[$type] ? 25 : 0;
    
            $resources[$type] = [
                "current_value" => $current_value,
                "store_max_limit" => $max_value,
                "store_init_limit" => $init_limit,
                "prod_rate" => $prod_rate,
                "prod_rate_percentage" => $prod_bonus + $plus,
            ];
        }
        return ["resources" => $resources];
    }
    
    
    public function handleCreateNewVillage(
        $taskRow,
        $toVillageRow,
        $fromVillageRow,
        $cropConsumption
    ) {
        $GameMetadata = $GLOBALS["GameMetadata"];
        $SetupMetadata = $GLOBALS["SetupMetadata"];

        // get the sum number village of the player
        $villages_count = $this->provider->fetchScalar(
            "SELECT COUNT(v.id) FROM p_villages v WHERE v.player_id=%s AND v.is_oasis=0",
            [intval($fromVillageRow["player_id"])]
        );


        if (
            intval(
                $this->provider->fetchScalar(
                    "SELECT p.id FROM p_players p WHERE p.id=%s",
                    [intval($fromVillageRow["player_id"])]
                )
            ) == 0
        ) {
            return false;
        }
         // villageName is new_village_name then space then the number of the village
        $villageName = new_village_name . " " . ($villages_count + 1);
        $update_key = substr(
            md5(
                $fromVillageRow["player_id"] .
                    $fromVillageRow["tribe_id"] .
                    $toVillageRow["id"] .
                    $fromVillageRow["player_name"] .
                    $villageName
            ),
            2,
            5
        );
        $field_map_id = $toVillageRow["field_maps_id"];
        $buildings = "";
        foreach ($SetupMetadata["field_maps"][$field_map_id] as $v) {
            if ($buildings != "") {
                $buildings .= ",";
            }
            $buildings .= sprintf("%s 0 0", $v);
        }
        $k = 19;
        while ($k <= 40) {
            $buildings .= $k == 26 ? ",15 1 0" : ",0 0 0";
            ++$k;
        }
        $resources = "";
        $farr = explode(
            "-",
            $SetupMetadata["field_maps_summary"][$field_map_id]
        );
        $i = 1;
        $_c = sizeof($farr);
        while ($i <= $_c) {
            if ($resources != "") {
                $resources .= ",";
            }
            $resources .= sprintf(
                "%s 1000 8000 8000 %s 0",
                $i,
                $farr[$i - 1] * 2 * $GameMetadata["game_speed"]
            );
            ++$i;
        }
        // here to change recources if the player has a oasis
        // get village_oases_id of fromVillageRow
        $village_oases_id = $fromVillageRow["village_oases_id"];

        // insert village_oases_id of fromVillageRow to toVillageRow
        $this->provider->executeQuery(
            "UPDATE p_villages v\r\n\t\t\tSET\r\n\t\t\t\tv.village_oases_id='%s'\r\n\t\t\tWHERE v.id=%s",
            [$village_oases_id, intval($toVillageRow["id"])]
        );

        $troops_training = "";
        $troops_num = "";
        foreach ($GameMetadata["troops"] as $k => $v) {
            if (
                $v["for_tribe_id"] == 0 - 1 ||
                $v["for_tribe_id"] == $fromVillageRow["tribe_id"]
            ) {
                if ($troops_training != "") {
                    $troops_training .= ",";
                }
                $researching_done = $v["research_time_consume"] == 0 ? 1 : 0;
                $troops_training .= $k . " " . $researching_done . " 0 0";
                if ($troops_num != "") {
                    $troops_num .= ",";
                }
                $troops_num .= $k . " 0";
            }
        }
        $troops_num = "-1:" . $troops_num;
        $this->provider->executeQuery(
            "UPDATE p_villages v\r\n\t\t\tSET\r\n\t\t\t\tv.parent_id=%s,\r\n\t\t\t\tv.tribe_id=%s,\r\n\t\t\t\tv.player_id=%s,\r\n\t\t\t\tv.alliance_id=%s,\r\n\t\t\t\tv.player_name='%s',\r\n\t\t\t\tv.village_name='%s',\r\n\t\t\t\tv.alliance_name='%s',\r\n\t\t\t\tv.is_capital=0,\r\n\t\t\t\tv.buildings='%s',\r\n\t\t\t\tv.resources='%s',\r\n\t\t\t\tv.cp='0 2',\r\n\t\t\t\tv.troops_training='%s',\r\n\t\t\t\tv.troops_num='%s',\r\n\t\t\t\tv.update_key='%s',\r\n\t\t\t\tv.creation_date=NOW(),\r\n\t\t\t\tv.last_update_date=NOW()\r\n\t\t\tWHERE v.id=%s",
            [
                intval($fromVillageRow["id"]),
                intval($fromVillageRow["tribe_id"]),
                intval($fromVillageRow["player_id"]),
                0 < intval($fromVillageRow["alliance_id"])
                    ? intval($fromVillageRow["alliance_id"])
                    : "NULL",
                $fromVillageRow["player_name"],
                $villageName,
                $fromVillageRow["alliance_name"],
                $buildings,
                $resources,
                $troops_training,
                $troops_num,
                $update_key,
                intval($toVillageRow["id"]),
            ]
        );
        $child_villages_id = trim($fromVillageRow["child_villages_id"]);
        if ($child_villages_id != "") {
            $child_villages_id .= ",";
        }
        $child_villages_id .= $toVillageRow["id"];
        $this->provider->executeQuery(
            "UPDATE p_villages v\r\n\t\t\tSET\r\n\t\t\t\tv.crop_consumption=v.crop_consumption-%s,\r\n\t\t\t\tv.child_villages_id='%s'\r\n\t\t\tWHERE v.id=%s",
            [
                $cropConsumption,
                $child_villages_id,
                intval($fromVillageRow["id"]),
            ]
        );
        $prow = $this->provider->fetchRow(
            "SELECT p.villages_id, p.villages_data FROM p_players p WHERE p.id=%s",
            [intval($fromVillageRow["player_id"])]
        );
        $villages_id = trim($prow["villages_id"]);
        if ($villages_id != "") {
            $villages_id .= ",";
        }
        $villages_id .= $toVillageRow["id"];
        $villages_data = trim($prow["villages_data"]);
        if ($villages_data != "") {
            $villages_data .= "\n";
        }
        $villages_data .=
            $toVillageRow["id"] .
            " " .
            $toVillageRow["rel_x"] .
            " " .
            $toVillageRow["rel_y"] .
            " " .
            $villageName;
            $this->provider->executeQuery(
                "UPDATE p_players p\r\n\t\t\tSET\r\n\t\t\t\tp.total_people_count=p.total_people_count+2,\r\n\t\t\t\tp.villages_count=p.villages_count+1,\r\n\t\t\t\tp.selected_village_id=%s,\r\n\t\t\t\tp.villages_id='%s',\r\n\t\t\t\tp.villages_data='%s',\r\n\t\t\t\tp.create_nvil=1\r\n\t\t\tWHERE\r\n\t\t\t\tp.id=%s",
                [
                    intval($toVillageRow["id"]),
                    $villages_id,
                    $villages_data,
                    intval($fromVillageRow["player_id"]),
                ]
        );

        ////////////////////////////////////////////////////////////////////////////////////////


        $villages_count = $this->provider->fetchScalar(
            "SELECT COUNT(v.id) FROM p_villages v WHERE v.player_id=%s AND v.is_oasis=0",
            [intval($fromVillageRow["player_id"])]
        );

        $cp = ($villages_count-1) * 5000;


        // get the old cp of the village
        $old_cp = $fromVillageRow["cp"];
        // the cp is like number then space then number, so we need to split it
        $old_cp_arr = explode(" ", $old_cp);
        // get the old cp value
        $old_cp_value = intval($old_cp_arr[0]);
        // new cp value
        $new_cp_value = $old_cp_value - $cp;
        // concatenate the new cp value with the old cp rate
        $new_cp = $new_cp_value . " " . $old_cp_arr[1];

        // update fromVillageRow with new cp
        $this->provider->executeQuery(
            "UPDATE p_villages v\r\n\t\t\tSET\r\n\t\t\t\tv.cp='%s'\r\n\t\t\tWHERE v.id=%s",
            [$new_cp, intval($fromVillageRow["id"])]
        );


     // //////////////////////////////////////////////////////////////////////////////////////////////////////////


        $villageRow = $this->provider->fetchRow("SELECT\r\n\t\t\t\tv.player_id,\r\n\t\t\t\tv.tribe_id,\r\n\t\t\t\tv.alliance_id,\r\n\t\t\t\tv.player_name,\r\n\t\t\t\tv.alliance_name,\r\n\t\t\t\tv.resources,\r\n\t\t\t\tv.cp,\r\n\t\t\t\tv.crop_consumption,\r\n\t\t\t\tv.village_oases_id,\r\n\t\t\t\tTIME_TO_SEC(TIMEDIFF(NOW(), v.last_update_date)) elapsedTimeInSeconds \r\n\t\t\tFROM p_villages v\r\n\t\t\tWHERE v.id=%s", array(
            intval($toVillageRow['id'])
        ));

        $playerId = intval($fromVillageRow['player_id']);
        $plus_queue = mysql_query("SELECT q.proc_type FROM p_queue q WHERE q.player_id=$playerId");

        $plus_queue_result = [];
        while ($row = mysql_fetch_array($plus_queue)) {
            $plus_queue_result[] = intval($row['proc_type']);
        }

        $resultArr = $this->_getResourcesArray(
            $villageRow["resources"],
            $villageRow["elapsedTimeInSeconds"],
            $villageRow["crop_consumption"],
            $plus_queue_result
        );

        // split oasis_id from village_oases_id by ,
        $oasisIds = explode(",", $village_oases_id);

        foreach ($oasisIds as $oId) {
            $oasisIndex = $this->provider->fetchScalar(
                "SELECT v.image_num FROM p_villages v WHERE v.id=%s",
                [intval($oId)]
            );
            // Get the oasis resources metadata
            $oasisRes = $GLOBALS["SetupMetadata"]["oasis"][$oasisIndex];

            // Adjust the production rate percentage based on the oasis resources
            foreach ($oasisRes as $k => $v) {
                $resultArr["resources"][$k]["prod_rate_percentage"] += $v;
                if ($resultArr["resources"][$k]["prod_rate_percentage"] < 0) {
                    $resultArr["resources"][$k]["prod_rate_percentage"] = 0;
                }
            }

            // Update the village with the new resources and other data
            $this->provider->executeQuery(
                "UPDATE p_villages v 
                SET
                    v.resources='%s',
                    v.cp='%s',
                    v.last_update_date=NOW()
                WHERE v.id=%s",
                    [
                        $this->_getResourcesString($resultArr["resources"]),
                        $resultArr["cp"]["cpValue"] . " " . $resultArr["cp"]["cpRate"], 
                        intval($toVillageRow["id"]),
                    ]
                );
        }

        return false;
    }
}

?>
