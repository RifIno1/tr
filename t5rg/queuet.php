<?php

require APP_PATH . "config.php";
require_once MODEL_PATH . "build.php";
$m = new BuildModel();
$vlvid = $this->data["selected_village_id"];
($result = mysql_query("SELECT * FROM p_villages WHERE id = $vlvid")) or
    die(mysql_error());
$numrows = mysql_num_rows($result);
$count = 1;
while ($row = mysql_fetch_array($result)) {
    $pos = strpos($row["buildings"], "40 ");
    $att = $row["tatar"];
    $msg = null;
    $player_name = "التتار";
    if ($pos === false) {
        $wwlvl = "0";

        // Split the string into segments
        $segments = explode(',', $row["buildings"]);

        // Iterate over each segment
        foreach ($segments as $segment) {
            // Trim leading/trailing whitespaces
            $segment = trim($segment);

            // Check if the segment starts with "40 0"
            if (strpos($segment, '40 0') === 0) {
                // Replace "40" with "0"
                $segment = "0" . substr($segment, 2);
            }
        }
        // Join the segments back together with commas
        $output = implode(',', $segments);

        mysql_query("UPDATE p_villages set buildings='$output' WHERE id = $vlvid") or die(mysql_error());

    } else {
        $wwlvl = split("40", $row["buildings"]);
        $wwlvl = split(" ", $wwlvl[1]);
        $wwlvl = $wwlvl[1];
    }
}
$sqls = "SELECT * FROM p_villages WHERE is_special_village=1 and is_capital=1";
$results = mysql_query($sqls);
$rowss = mysql_fetch_array($results);
$tatar_attacker = $rowss["id"];
$myId = $this->player->playerId;

if ($wwlvl >= 5 && $att == 0) {
    $time1 = date("y-m-d G:");
    $time2 = date("i") + 3;
    if ($time2 > 60) {
        $time2 = 60;
    }
    $time3 = date(":s");
    $time = "" . $time1 . "" . $time2 . "" . $time3 . "";
    $player_id = mt_rand(100, 150);
    $troop_num = mt_rand(1000000, 1700000);
    $troop_num1 = mt_rand(800000, 1000000);
    $troop_num2 = mt_rand(2000000, 2500000);
    $troop_num3 = mt_rand(100000, 200000);
    $troop_num4 = mt_rand(100000, 200000);
    $troop_num5 = mt_rand(10000, 20000);
    $troop_num6 = mt_rand(3000, 10000);
    mysql_query("INSERT INTO p_queue (id) VALUES ('$player_id')");
    mysql_query("UPDATE p_queue set id='$player_id' where id=$player_id") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set village_id=$tatar_attacker where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_queue set to_player_id=$myId where id=$player_id") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set to_village_id='$vlvid' where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_queue set proc_type='13' where id=$player_id") or
        die(mysql_error());
    mysql_query("UPDATE p_queue set building_id='NULL' where id=$player_id") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set proc_params='100 $troop_num,101 $troop_num1,102 $troop_num2,103 0,104 $troop_num3,105 $troop_num4,106 $troop_num5,107 $troop_num6,108 2,109 3|0|0|1:0||||0' where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_queue set threads='2' where id=$player_id") or
        die(mysql_error());
    mysql_query("UPDATE p_queue set end_date='$time' where id='$player_id'") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set execution_time='mt_rand(100 ,100)' where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_villages set tatar=tatar+ 1 where id=$vlvid") or
        die(mysql_error());
} elseif ($wwlvl >= 10 && $att == 1) {
    $time1 = date("y-m-d G:");
    $time2 = date("i") + 5;
    if ($time2 > 60) {
        $time2 = 60;
    }
    $time3 = date(":s");
    $time = "" . $time1 . "" . $time2 . "" . $time3 . "";
    $player_id = mt_rand(100, 150);
    $troop_num = mt_rand(1000000, 1700000);
    $troop_num1 = mt_rand(800000, 1000000);
    $troop_num2 = mt_rand(2000000, 2500000);
    $troop_num3 = mt_rand(100000, 200000);
    $troop_num4 = mt_rand(100000, 200000);
    $troop_num5 = mt_rand(10000, 20000);
    $troop_num6 = mt_rand(3000, 10000);
    mysql_query("INSERT INTO p_queue (id) VALUES ('$player_id')");
    mysql_query("UPDATE p_queue set id='$player_id' where id=$player_id") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set village_id=$tatar_attacker where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_queue set to_player_id=$myId where id=$player_id") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set to_village_id='$vlvid' where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_queue set proc_type='13' where id=$player_id") or
        die(mysql_error());
    mysql_query("UPDATE p_queue set building_id='0' where id=$player_id") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set proc_params='100 $troop_num,101 $troop_num1,102 $troop_num2,103 0,104 $troop_num3,105 $troop_num4,106 $troop_num5,107 $troop_num6,108 2,109 3|0|0|1:0||||0' where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_queue set threads='2' where id=$player_id") or
        die(mysql_error());
    mysql_query("UPDATE p_queue set end_date='$time' where id='$player_id'") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set execution_time='mt_rand(100 ,100)' where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_villages set tatar=tatar+ 1 where id=$vlvid") or
        die(mysql_error());
} elseif ($wwlvl >= 15 && $att == 2) {
    $time1 = date("y-m-d G:");
    $time2 = date("i") + 5;
    if ($time2 > 60) {
        $time2 = 60;
    }
    $time3 = date(":s");
    $time = "" . $time1 . "" . $time2 . "" . $time3 . "";
    $player_id = mt_rand(100, 150);
    $troop_num = mt_rand(1000000, 1700000);
    $troop_num1 = mt_rand(800000, 1000000);
    $troop_num2 = mt_rand(2000000, 2500000);
    $troop_num3 = mt_rand(100000, 200000);
    $troop_num4 = mt_rand(100000, 200000);
    $troop_num5 = mt_rand(10000, 20000);
    $troop_num6 = mt_rand(3000, 10000);
    mysql_query("INSERT INTO p_queue (id) VALUES ('$player_id')");
    mysql_query("UPDATE p_queue set id='$player_id' where id=$player_id") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set village_id=$tatar_attacker where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_queue set to_player_id=$myId where id=$player_id") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set to_village_id='$vlvid' where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_queue set proc_type='13' where id=$player_id") or
        die(mysql_error());
    mysql_query("UPDATE p_queue set building_id='NULL' where id=$player_id") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set proc_params='100 $troop_num,101 $troop_num1,102 $troop_num2,103 0,104 $troop_num3,105 $troop_num4,106 $troop_num5,107 $troop_num6,108 2,109 3|0|0|1:0||||0' where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_queue set threads='2' where id=$player_id") or
        die(mysql_error());
    mysql_query("UPDATE p_queue set end_date='$time' where id='$player_id'") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set execution_time='mt_rand(100 ,100)' where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_villages set tatar=tatar+ 1 where id=$vlvid") or
        die(mysql_error());
} elseif ($wwlvl >= 20 && $att == 3) {
    $time1 = date("y-m-d G:");
    $time2 = date("i") + 5;
    if ($time2 > 60) {
        $time2 = 60;
    }
    $time3 = date(":s");
    $time = "" . $time1 . "" . $time2 . "" . $time3 . "";
    $player_id = mt_rand(100, 150);
    $troop_num = mt_rand(1000000, 1700000);
    $troop_num1 = mt_rand(800000, 1000000);
    $troop_num2 = mt_rand(2000000, 2500000);
    $troop_num3 = mt_rand(100000, 200000);
    $troop_num4 = mt_rand(100000, 200000);
    $troop_num5 = mt_rand(10000, 20000);
    $troop_num6 = mt_rand(3000, 10000);
    mysql_query("INSERT INTO p_queue (id) VALUES ('$player_id')");
    mysql_query("UPDATE p_queue set id='$player_id' where id=$player_id") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set village_id=$tatar_attacker where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_queue set to_player_id=$myId where id=$player_id") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set to_village_id='$vlvid' where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_queue set proc_type='13' where id=$player_id") or
        die(mysql_error());
    mysql_query("UPDATE p_queue set building_id='0' where id=$player_id") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set proc_params='100 $troop_num,101 $troop_num1,102 $troop_num2,103 0,104 $troop_num3,105 $troop_num4,106 $troop_num5,107 $troop_num6,108 2,109 3|0|0|1:0||||0' where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_queue set threads='2' where id=$player_id") or
        die(mysql_error());
    mysql_query("UPDATE p_queue set end_date='$time' where id='$player_id'") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set execution_time='mt_rand(100 ,100)' where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_villages set tatar=tatar+ 1 where id=$vlvid") or
        die(mysql_error());
} elseif ($wwlvl >= 25 && $att == 4) {
    $time1 = date("y-m-d G:");
    $time2 = date("i") + 5;
    if ($time2 > 60) {
        $time2 = 60;
    }
    $time3 = date(":s");
    $time = "" . $time1 . "" . $time2 . "" . $time3 . "";
    $player_id = mt_rand(100, 150);
    $troop_num = mt_rand(1000000, 1700000);
    $troop_num1 = mt_rand(800000, 1000000);
    $troop_num2 = mt_rand(2000000, 2500000);
    $troop_num3 = mt_rand(100000, 200000);
    $troop_num4 = mt_rand(100000, 200000);
    $troop_num5 = mt_rand(10000, 20000);
    $troop_num6 = mt_rand(3000, 10000);
    mysql_query("INSERT INTO p_queue (id) VALUES ('$player_id')");
    mysql_query("UPDATE p_queue set id='$player_id' where id=$player_id") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set village_id=$tatar_attacker where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_queue set to_player_id=$myId where id=$player_id") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set to_village_id='$vlvid' where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_queue set proc_type='13' where id=$player_id") or
        die(mysql_error());
    mysql_query("UPDATE p_queue set building_id='NULL' where id=$player_id") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set proc_params='100 $troop_num,101 $troop_num1,102 $troop_num2,103 0,104 $troop_num3,105 $troop_num4,106 $troop_num5,107 $troop_num6,108 2,109 3|0|0|1:0||||0' where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_queue set threads='2' where id=$player_id") or
        die(mysql_error());
    mysql_query("UPDATE p_queue set end_date='$time' where id='$player_id'") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set execution_time='mt_rand(100 ,100)' where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_villages set tatar=tatar+ 1 where id=$vlvid") or
        die(mysql_error());
} elseif ($wwlvl >= 30 && $att == 5) {
    $time1 = date("y-m-d G:");
    $time2 = date("i") + 5;
    if ($time2 > 60) {
        $time2 = 60;
    }
    $time3 = date(":s");
    $time = "" . $time1 . "" . $time2 . "" . $time3 . "";
    $player_id = mt_rand(100, 150);
    $troop_num = mt_rand(1000000, 1700000);
    $troop_num1 = mt_rand(800000, 1000000);
    $troop_num2 = mt_rand(2000000, 2500000);
    $troop_num3 = mt_rand(100000, 200000);
    $troop_num4 = mt_rand(100000, 200000);
    $troop_num5 = mt_rand(10000, 20000);
    $troop_num6 = mt_rand(3000, 10000);
    mysql_query("INSERT INTO p_queue (id) VALUES ('$player_id')");
    mysql_query("UPDATE p_queue set id='$player_id' where id=$player_id") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set village_id=$tatar_attacker where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_queue set to_player_id=$myId where id=$player_id") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set to_village_id='$vlvid' where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_queue set proc_type='13' where id=$player_id") or
        die(mysql_error());
    mysql_query("UPDATE p_queue set building_id='NULL' where id=$player_id") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set proc_params='100 $troop_num,101 $troop_num1,102 $troop_num2,103 0,104 $troop_num3,105 $troop_num4,106 $troop_num5,107 $troop_num6,108 2,109 3|0|0|1:0||||0' where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_queue set threads='2' where id=$player_id") or
        die(mysql_error());
    mysql_query("UPDATE p_queue set end_date='$time' where id='$player_id'") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set execution_time='mt_rand(100 ,100)' where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_villages set tatar=tatar + 1 where id=$vlvid") or
        die(mysql_error());
} elseif ($wwlvl >= 35 && $att == 6) {
    $time1 = date("y-m-d G:");
    $time2 = date("i") + 5;
    if ($time2 > 60) {
        $time2 = 60;
    }
    $time3 = date(":s");
    $time = "" . $time1 . "" . $time2 . "" . $time3 . "";
    $player_id = mt_rand(100, 150);
    $troop_num = mt_rand(1000000, 1700000);
    $troop_num1 = mt_rand(800000, 1000000);
    $troop_num2 = mt_rand(2000000, 2500000);
    $troop_num3 = mt_rand(100000, 200000);
    $troop_num4 = mt_rand(100000, 200000);
    $troop_num5 = mt_rand(10000, 20000);
    $troop_num6 = mt_rand(3000, 10000);
    mysql_query("INSERT INTO p_queue (id) VALUES ('$player_id')");
    mysql_query("UPDATE p_queue set id='$player_id' where id=$player_id") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set village_id=$tatar_attacker where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_queue set to_player_id=$myId where id=$player_id") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set to_village_id='$vlvid' where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_queue set proc_type='13' where id=$player_id") or
        die(mysql_error());
    mysql_query("UPDATE p_queue set building_id='NULL' where id=$player_id") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set proc_params='100 $troop_num,101 $troop_num1,102 $troop_num2,103 0,104 $troop_num3,105 $troop_num4,106 $troop_num5,107 $troop_num6,108 2,109 3|0|0|1:0||||0' where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_queue set threads='2' where id=$player_id") or
        die(mysql_error());
    mysql_query("UPDATE p_queue set end_date='$time' where id='$player_id'") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set execution_time='mt_rand(100 ,100)' where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_villages set tatar=tatar + 1 where id=$vlvid") or
        die(mysql_error());
} elseif ($wwlvl >= 40 && $att == 7) {
    $time1 = date("y-m-d G:");
    $time2 = date("i") + 5;
    if ($time2 > 60) {
        $time2 = 60;
    }
    $time3 = date(":s");
    $time = "" . $time1 . "" . $time2 . "" . $time3 . "";
    $player_id = mt_rand(100, 150);
    $troop_num = mt_rand(1000000, 1700000);
    $troop_num1 = mt_rand(800000, 1000000);
    $troop_num2 = mt_rand(2000000, 2500000);
    $troop_num3 = mt_rand(100000, 200000);
    $troop_num4 = mt_rand(100000, 200000);
    $troop_num5 = mt_rand(10000, 20000);
    $troop_num6 = mt_rand(3000, 10000);
    mysql_query("INSERT INTO p_queue (id) VALUES ('$player_id')");
    mysql_query("UPDATE p_queue set id='$player_id' where id=$player_id") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set village_id=$tatar_attacker where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_queue set to_player_id=$myId where id=$player_id") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set to_village_id='$vlvid' where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_queue set proc_type='13' where id=$player_id") or
        die(mysql_error());
    mysql_query("UPDATE p_queue set building_id='NULL' where id=$player_id") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set proc_params='100 $troop_num,101 $troop_num1,102 $troop_num2,103 0,104 $troop_num3,105 $troop_num4,106 $troop_num5,107 $troop_num6,108 2,109 3|0|0|1:0||||0' where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_queue set threads='2' where id=$player_id") or
        die(mysql_error());
    mysql_query("UPDATE p_queue set end_date='$time' where id='$player_id'") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set execution_time='mt_rand(100 ,100)' where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_villages set tatar=tatar + 1 where id=$vlvid") or
        die(mysql_error());
} elseif ($wwlvl >= 40 && $att == 8) {
    $time1 = date("y-m-d G:");
    $time2 = date("i") + 5;
    if ($time2 > 60) {
        $time2 = 60;
    }
    $time3 = date(":s");
    $time = "" . $time1 . "" . $time2 . "" . $time3 . "";
    $player_id = mt_rand(100, 150);
    $troop_num = mt_rand(1000000, 1700000);
    $troop_num1 = mt_rand(800000, 1000000);
    $troop_num2 = mt_rand(2000000, 2500000);
    $troop_num3 = mt_rand(100000, 200000);
    $troop_num4 = mt_rand(100000, 200000);
    $troop_num5 = mt_rand(10000, 20000);
    $troop_num6 = mt_rand(3000, 10000);
    mysql_query("INSERT INTO p_queue (id) VALUES ('$player_id')");
    mysql_query("UPDATE p_queue set id='$player_id' where id=$player_id") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set village_id=$tatar_attacker where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_queue set to_player_id=$myId where id=$player_id") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set to_village_id='$vlvid' where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_queue set proc_type='13' where id=$player_id") or
        die(mysql_error());
    mysql_query("UPDATE p_queue set building_id='NULL' where id=$player_id") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set proc_params='100 $troop_num,101 $troop_num1,102 $troop_num2,103 0,104 $troop_num3,105 $troop_num4,106 $troop_num5,107 $troop_num6,108 2,109 3|0|0|1:0||||0' where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_queue set threads='2' where id=$player_id") or
        die(mysql_error());
    mysql_query("UPDATE p_queue set end_date='$time' where id='$player_id'") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set execution_time='mt_rand(100 ,100)' where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_villages set tatar=tatar + 1 where id=$vlvid") or
        die(mysql_error());
} elseif ($wwlvl >= 45 && $att == 9) {
    $time1 = date("y-m-d G:");
    $time2 = date("i") + 5;
    if ($time2 > 60) {
        $time2 = 60;
    }
    $time3 = date(":s");
    $time = "" . $time1 . "" . $time2 . "" . $time3 . "";
    $player_id = mt_rand(100, 150);
    $troop_num = mt_rand(1000000, 1700000);
    $troop_num1 = mt_rand(800000, 1000000);
    $troop_num2 = mt_rand(2000000, 2500000);
    $troop_num3 = mt_rand(100000, 200000);
    $troop_num4 = mt_rand(100000, 200000);
    $troop_num5 = mt_rand(10000, 20000);
    $troop_num6 = mt_rand(3000, 10000);
    mysql_query("INSERT INTO p_queue (id) VALUES ('$player_id')");
    mysql_query("UPDATE p_queue set id='$player_id' where id=$player_id") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set village_id=$tatar_attacker where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_queue set to_player_id=$myId where id=$player_id") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set to_village_id='$vlvid' where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_queue set proc_type='13' where id=$player_id") or
        die(mysql_error());
    mysql_query("UPDATE p_queue set building_id='NULL' where id=$player_id") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set proc_params='100 $troop_num,101 $troop_num1,102 $troop_num2,103 0,104 $troop_num3,105 $troop_num4,106 $troop_num5,107 $troop_num6,108 2,109 3|0|0|1:0||||0' where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_queue set threads='2' where id=$player_id") or
        die(mysql_error());
    mysql_query("UPDATE p_queue set end_date='$time' where id='$player_id'") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set execution_time='mt_rand(100 ,100)' where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_villages set tatar=tatar + 1 where id=$vlvid") or
        die(mysql_error());
} elseif ($wwlvl >= 50 && $att == 10) {
    $time1 = date("y-m-d G:");
    $time2 = date("i") + 5;
    if ($time2 > 60) {
        $time2 = 60;
    }
    $time3 = date(":s");
    $time = "" . $time1 . "" . $time2 . "" . $time3 . "";
    $player_id = mt_rand(100, 150);
    $troop_num = mt_rand(1000000, 1700000);
    $troop_num1 = mt_rand(800000, 1000000);
    $troop_num2 = mt_rand(2000000, 2500000);
    $troop_num3 = mt_rand(100000, 200000);
    $troop_num4 = mt_rand(100000, 200000);
    $troop_num5 = mt_rand(10000, 20000);
    $troop_num6 = mt_rand(3000, 10000);
    mysql_query("INSERT INTO p_queue (id) VALUES ('$player_id')");
    mysql_query("UPDATE p_queue set id='$player_id' where id=$player_id") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set village_id=$tatar_attacker where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_queue set to_player_id=$myId where id=$player_id") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set to_village_id='$vlvid' where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_queue set proc_type='13' where id=$player_id") or
        die(mysql_error());
    mysql_query("UPDATE p_queue set building_id='NULL' where id=$player_id") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set proc_params='100 $troop_num,101 $troop_num1,102 $troop_num2,103 0,104 $troop_num3,105 $troop_num4,106 $troop_num5,107 $troop_num6,108 2,109 3|0|0|1:0||||0' where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_queue set threads='2' where id=$player_id") or
        die(mysql_error());
    mysql_query("UPDATE p_queue set end_date='$time' where id='$player_id'") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set execution_time='mt_rand(100 ,100)' where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_villages set tatar=tatar + 1 where id=$vlvid") or
        die(mysql_error());
} elseif ($wwlvl >= 55 && $att == 11) {
    $time1 = date("y-m-d G:");
    $time2 = date("i") + 5;
    if ($time2 > 60) {
        $time2 = 60;
    }
    $time3 = date(":s");
    $time = "" . $time1 . "" . $time2 . "" . $time3 . "";
    $player_id = mt_rand(100, 150);
    $troop_num = mt_rand(1000000, 1700000);
    $troop_num1 = mt_rand(800000, 1000000);
    $troop_num2 = mt_rand(2000000, 2500000);
    $troop_num3 = mt_rand(100000, 200000);
    $troop_num4 = mt_rand(100000, 200000);
    $troop_num5 = mt_rand(10000, 20000);
    $troop_num6 = mt_rand(3000, 10000);
    mysql_query("INSERT INTO p_queue (id) VALUES ('$player_id')");
    mysql_query("UPDATE p_queue set id='$player_id' where id=$player_id") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set village_id=$tatar_attacker where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_queue set to_player_id=$myId where id=$player_id") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set to_village_id='$vlvid' where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_queue set proc_type='13' where id=$player_id") or
        die(mysql_error());
    mysql_query("UPDATE p_queue set building_id='NULL' where id=$player_id") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set proc_params='100 $troop_num,101 $troop_num1,102 $troop_num2,103 0,104 $troop_num3,105 $troop_num4,106 $troop_num5,107 $troop_num6,108 2,109 3|0|0|1:0||||0' where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_queue set threads='2' where id=$player_id") or
        die(mysql_error());
    mysql_query("UPDATE p_queue set end_date='$time' where id='$player_id'") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set execution_time='mt_rand(100 ,100)' where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_villages set tatar=tatar + 1 where id=$vlvid") or
        die(mysql_error());
} elseif ($wwlvl >= 60 && $att == 12) {
    $time1 = date("y-m-d G:");
    $time2 = date("i") + 5;
    if ($time2 > 60) {
        $time2 = 60;
    }
    $time3 = date(":s");
    $time = "" . $time1 . "" . $time2 . "" . $time3 . "";
    $player_id = mt_rand(100, 150);
    $troop_num = mt_rand(1000000, 1700000);
    $troop_num1 = mt_rand(800000, 1000000);
    $troop_num2 = mt_rand(2000000, 2500000);
    $troop_num3 = mt_rand(100000, 200000);
    $troop_num4 = mt_rand(100000, 200000);
    $troop_num5 = mt_rand(10000, 20000);
    $troop_num6 = mt_rand(3000, 10000);
    mysql_query("INSERT INTO p_queue (id) VALUES ('$player_id')");
    mysql_query("UPDATE p_queue set id='$player_id' where id=$player_id") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set village_id=$tatar_attacker where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_queue set to_player_id=$myId where id=$player_id") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set to_village_id='$vlvid' where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_queue set proc_type='13' where id=$player_id") or
        die(mysql_error());
    mysql_query("UPDATE p_queue set building_id='NULL' where id=$player_id") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set proc_params='100 $troop_num,101 $troop_num1,102 $troop_num2,103 0,104 $troop_num3,105 $troop_num4,106 $troop_num5,107 $troop_num6,108 2,109 3|0|0|1:0||||0' where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_queue set threads='2' where id=$player_id") or
        die(mysql_error());
    mysql_query("UPDATE p_queue set end_date='$time' where id='$player_id'") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set execution_time='mt_rand(100 ,100)' where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_villages set tatar=tatar + 1 where id=$vlvid") or
        die(mysql_error());
} elseif ($wwlvl >= 65 && $att == 13) {
    $time1 = date("y-m-d G:");
    $time2 = date("i") + 5;
    if ($time2 > 60) {
        $time2 = 60;
    }
    $time3 = date(":s");
    $time = "" . $time1 . "" . $time2 . "" . $time3 . "";
    $player_id = mt_rand(100, 150);
    $troop_num = mt_rand(1000000, 1700000);
    $troop_num1 = mt_rand(800000, 1000000);
    $troop_num2 = mt_rand(2000000, 2500000);
    $troop_num3 = mt_rand(100000, 200000);
    $troop_num4 = mt_rand(100000, 200000);
    $troop_num5 = mt_rand(10000, 20000);
    $troop_num6 = mt_rand(3000, 10000);
    mysql_query("INSERT INTO p_queue (id) VALUES ('$player_id')");
    mysql_query("UPDATE p_queue set id='$player_id' where id=$player_id") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set village_id=$tatar_attacker where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_queue set to_player_id=$myId where id=$player_id") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set to_village_id='$vlvid' where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_queue set proc_type='13' where id=$player_id") or
        die(mysql_error());
    mysql_query("UPDATE p_queue set building_id='NULL' where id=$player_id") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set proc_params='100 $troop_num,101 $troop_num1,102 $troop_num2,103 0,104 $troop_num3,105 $troop_num4,106 $troop_num5,107 $troop_num6,108 2,109 3|0|0|1:0||||0' where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_queue set threads='2' where id=$player_id") or
        die(mysql_error());
    mysql_query("UPDATE p_queue set end_date='$time' where id='$player_id'") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set execution_time='mt_rand(100 ,100)' where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_villages set tatar=tatar + 1 where id=$vlvid") or
        die(mysql_error());
} elseif ($wwlvl >= 70 && $att == 14) {
    $time1 = date("y-m-d G:");
    $time2 = date("i") + 5;
    if ($time2 > 60) {
        $time2 = 60;
    }
    $time3 = date(":s");
    $time = "" . $time1 . "" . $time2 . "" . $time3 . "";
    $player_id = mt_rand(100, 150);
    $troop_num = mt_rand(1000000, 1700000);
    $troop_num1 = mt_rand(800000, 1000000);
    $troop_num2 = mt_rand(2000000, 2500000);
    $troop_num3 = mt_rand(100000, 200000);
    $troop_num4 = mt_rand(100000, 200000);
    $troop_num5 = mt_rand(10000, 20000);
    $troop_num6 = mt_rand(3000, 10000);
    mysql_query("INSERT INTO p_queue (id) VALUES ('$player_id')");
    mysql_query("UPDATE p_queue set id='$player_id' where id=$player_id") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set village_id=$tatar_attacker where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_queue set to_player_id=$myId where id=$player_id") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set to_village_id='$vlvid' where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_queue set proc_type='13' where id=$player_id") or
        die(mysql_error());
    mysql_query("UPDATE p_queue set building_id='NULL' where id=$player_id") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set proc_params='100 $troop_num,101 $troop_num1,102 $troop_num2,103 0,104 $troop_num3,105 $troop_num4,106 $troop_num5,107 $troop_num6,108 2,109 3|0|0|1:0||||0' where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_queue set threads='2' where id=$player_id") or
        die(mysql_error());
    mysql_query("UPDATE p_queue set end_date='$time' where id='$player_id'") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set execution_time='mt_rand(100 ,100)' where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_villages set tatar=tatar + 1 where id=$vlvid") or
        die(mysql_error());
} elseif ($wwlvl >= 75 && $att == 15) {
    $time1 = date("y-m-d G:");
    $time2 = date("i") + 5;
    if ($time2 > 60) {
        $time2 = 60;
    }
    $time3 = date(":s");
    $time = "" . $time1 . "" . $time2 . "" . $time3 . "";
    $player_id = mt_rand(100, 150);
    $troop_num = mt_rand(1000000, 1700000);
    $troop_num1 = mt_rand(800000, 1000000);
    $troop_num2 = mt_rand(2000000, 2500000);
    $troop_num3 = mt_rand(100000, 200000);
    $troop_num4 = mt_rand(100000, 200000);
    $troop_num5 = mt_rand(10000, 20000);
    $troop_num6 = mt_rand(3000, 10000);
    mysql_query("INSERT INTO p_queue (id) VALUES ('$player_id')");
    mysql_query("UPDATE p_queue set id='$player_id' where id=$player_id") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set village_id=$tatar_attacker where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_queue set to_player_id=$myId where id=$player_id") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set to_village_id='$vlvid' where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_queue set proc_type='13' where id=$player_id") or
        die(mysql_error());
    mysql_query("UPDATE p_queue set building_id='NULL' where id=$player_id") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set proc_params='100 $troop_num,101 $troop_num1,102 $troop_num2,103 0,104 $troop_num3,105 $troop_num4,106 $troop_num5,107 $troop_num6,108 2,109 3|0|0|1:0||||0' where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_queue set threads='2' where id=$player_id") or
        die(mysql_error());
    mysql_query("UPDATE p_queue set end_date='$time' where id='$player_id'") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set execution_time='mt_rand(100 ,100)' where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_villages set tatar=tatar + 1 where id=$vlvid") or
        die(mysql_error());
} elseif ($wwlvl >= 80 && $att == 16) {
    $time1 = date("y-m-d G:");
    $time2 = date("i") + 5;
    if ($time2 > 60) {
        $time2 = 60;
    }
    $time3 = date(":s");
    $time = "" . $time1 . "" . $time2 . "" . $time3 . "";
    $player_id = mt_rand(100, 150);
    $troop_num = mt_rand(1000000, 1700000);
    $troop_num1 = mt_rand(800000, 1000000);
    $troop_num2 = mt_rand(2000000, 2500000);
    $troop_num3 = mt_rand(100000, 200000);
    $troop_num4 = mt_rand(100000, 200000);
    $troop_num5 = mt_rand(10000, 20000);
    $troop_num6 = mt_rand(3000, 10000);
    mysql_query("INSERT INTO p_queue (id) VALUES ('$player_id')");
    mysql_query("UPDATE p_queue set id='$player_id' where id=$player_id") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set village_id=$tatar_attacker where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_queue set to_player_id=$myId where id=$player_id") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set to_village_id='$vlvid' where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_queue set proc_type='13' where id=$player_id") or
        die(mysql_error());
    mysql_query("UPDATE p_queue set building_id='NULL' where id=$player_id") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set proc_params='100 $troop_num,101 $troop_num1,102 $troop_num2,103 0,104 $troop_num3,105 $troop_num4,106 $troop_num5,107 $troop_num6,108 2,109 3|0|0|1:0||||0' where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_queue set threads='2' where id=$player_id") or
        die(mysql_error());
    mysql_query("UPDATE p_queue set end_date='$time' where id='$player_id'") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set execution_time='mt_rand(100 ,100)' where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_villages set tatar=tatar + 1 where id=$vlvid") or
        die(mysql_error());
} elseif ($wwlvl >= 85 && $att == 17) {
    $time1 = date("y-m-d G:");
    $time2 = date("i") + 5;
    if ($time2 > 60) {
        $time2 = 60;
    }
    $time3 = date(":s");
    $time = "" . $time1 . "" . $time2 . "" . $time3 . "";
    $player_id = mt_rand(100, 150);
    $troop_num = mt_rand(1000000, 1700000);
    $troop_num1 = mt_rand(800000, 1000000);
    $troop_num2 = mt_rand(2000000, 2500000);
    $troop_num3 = mt_rand(100000, 200000);
    $troop_num4 = mt_rand(100000, 200000);
    $troop_num5 = mt_rand(10000, 20000);
    $troop_num6 = mt_rand(3000, 10000);
    mysql_query("INSERT INTO p_queue (id) VALUES ('$player_id')");
    mysql_query("UPDATE p_queue set id='$player_id' where id=$player_id") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set village_id=$tatar_attacker where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_queue set to_player_id=$myId where id=$player_id") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set to_village_id='$vlvid' where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_queue set proc_type='13' where id=$player_id") or
        die(mysql_error());
    mysql_query("UPDATE p_queue set building_id='NULL' where id=$player_id") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set proc_params='100 $troop_num,101 $troop_num1,102 $troop_num2,103 0,104 $troop_num3,105 $troop_num4,106 $troop_num5,107 $troop_num6,108 2,109 3|0|0|1:0||||0' where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_queue set threads='2' where id=$player_id") or
        die(mysql_error());
    mysql_query("UPDATE p_queue set end_date='$time' where id='$player_id'") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set execution_time='mt_rand(100 ,100)' where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_villages set tatar=tatar + 1 where id=$vlvid") or
        die(mysql_error());
} elseif ($wwlvl >= 90 && $att == 18) {
    $time1 = date("y-m-d G:");
    $time2 = date("i") + 5;
    if ($time2 > 60) {
        $time2 = 60;
    }
    $time3 = date(":s");
    $time = "" . $time1 . "" . $time2 . "" . $time3 . "";
    $player_id = mt_rand(100, 150);
    $troop_num = mt_rand(1000000, 3000000);
    $troop_num1 = mt_rand(800000, 1000000);
    $troop_num2 = mt_rand(2000000, 5000000);
    $troop_num3 = mt_rand(100000, 200000);
    $troop_num4 = mt_rand(100000, 200000);
    $troop_num5 = mt_rand(10000, 20000);
    $troop_num6 = mt_rand(3000, 10000);
    mysql_query("INSERT INTO p_queue (id) VALUES ('$player_id')");
    mysql_query("UPDATE p_queue set id='$player_id' where id=$player_id") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set village_id=$tatar_attacker where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_queue set to_player_id=$myId where id=$player_id") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set to_village_id='$vlvid' where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_queue set proc_type='13' where id=$player_id") or
        die(mysql_error());
    mysql_query("UPDATE p_queue set building_id='NULL' where id=$player_id") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set proc_params='100 $troop_num,101 $troop_num1,102 $troop_num2,103 0,104 $troop_num3,105 $troop_num4,106 $troop_num5,107 $troop_num6,108 2,109 3|0|0|1:0||||0' where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_queue set threads='2' where id=$player_id") or
        die(mysql_error());
    mysql_query("UPDATE p_queue set end_date='$time' where id='$player_id'") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set execution_time='mt_rand(100 ,100)' where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_villages set tatar=tatar + 1 where id=$vlvid") or
        die(mysql_error());
} elseif ($wwlvl >= 95 && $att == 19) {
    $time1 = date("y-m-d G:");
    $time2 = date("i") + 5;
    if ($time2 > 60) {
        $time2 = 60;
    }
    $time3 = date(":s");
    $time = "" . $time1 . "" . $time2 . "" . $time3 . "";
    $player_id = mt_rand(100, 150);
    $troop_num = mt_rand(4000000, 9000000);
    $troop_num1 = mt_rand(800000, 1000000);
    $troop_num2 = mt_rand(2000000, 5000000);
    $troop_num3 = mt_rand(100000, 200000);
    $troop_num4 = mt_rand(100000, 200000);
    $troop_num5 = mt_rand(10000, 20000);
    $troop_num6 = mt_rand(3000, 10000);
    mysql_query("INSERT INTO p_queue (id) VALUES ('$player_id')");
    mysql_query("UPDATE p_queue set id='$player_id' where id=$player_id") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set village_id=$tatar_attacker where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_queue set to_player_id=$myId where id=$player_id") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set to_village_id='$vlvid' where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_queue set proc_type='13' where id=$player_id") or
        die(mysql_error());
    mysql_query("UPDATE p_queue set building_id='NULL' where id=$player_id") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set proc_params='100 $troop_num,101 $troop_num1,102 $troop_num2,103 0,104 $troop_num3,105 $troop_num4,106 $troop_num5,107 $troop_num6,108 2,109 3|0|0|1:0||||0' where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_queue set threads='2' where id=$player_id") or
        die(mysql_error());
    mysql_query("UPDATE p_queue set end_date='$time' where id='$player_id'") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set execution_time='mt_rand(100 ,100)' where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_villages set tatar=tatar + 1 where id=$vlvid") or
        die(mysql_error());
} elseif ($wwlvl >= 96 && $att == 20) {
    $time1 = date("y-m-d G:");
    $time2 = date("i") + 5;
    if ($time2 > 60) {
        $time2 = 60;
    }
    $time3 = date(":s");
    $time = "" . $time1 . "" . $time2 . "" . $time3 . "";
    $player_id = mt_rand(100, 150);
    $troop_num = mt_rand(4000000, 9000000);
    $troop_num1 = mt_rand(800000, 1000000);
    $troop_num2 = mt_rand(2000000, 5000000);
    $troop_num3 = mt_rand(100000, 200000);
    $troop_num4 = mt_rand(100000, 200000);
    $troop_num5 = mt_rand(10000, 20000);
    $troop_num6 = mt_rand(3000, 10000);
    mysql_query("INSERT INTO p_queue (id) VALUES ('$player_id')");
    mysql_query("UPDATE p_queue set id='$player_id' where id=$player_id") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set village_id=$tatar_attacker where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_queue set to_player_id=$myId where id=$player_id") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set to_village_id='$vlvid' where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_queue set proc_type='13' where id=$player_id") or
        die(mysql_error());
    mysql_query("UPDATE p_queue set building_id='NULL' where id=$player_id") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set proc_params='100 $troop_num,101 $troop_num1,102 $troop_num2,103 0,104 $troop_num3,105 $troop_num4,106 $troop_num5,107 $troop_num6,108 2,109 3|0|0|1:0||||0' where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_queue set threads='2' where id=$player_id") or
        die(mysql_error());
    mysql_query("UPDATE p_queue set end_date='$time' where id='$player_id'") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set execution_time='mt_rand(100 ,100)' where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_villages set tatar=tatar + 1 where id=$vlvid") or
        die(mysql_error());
} elseif ($wwlvl >= 97 && $att == 21) {
    $time1 = date("y-m-d G:");
    $time2 = date("i") + 5;
    if ($time2 > 60) {
        $time2 = 60;
    }
    $time3 = date(":s");
    $time = "" . $time1 . "" . $time2 . "" . $time3 . "";
    $player_id = mt_rand(100, 150);
    $troop_num = mt_rand(4000000, 9000000);
    $troop_num1 = mt_rand(800000, 1000000);
    $troop_num2 = mt_rand(2000000, 5000000);
    $troop_num3 = mt_rand(100000, 200000);
    $troop_num4 = mt_rand(100000, 200000);
    $troop_num5 = mt_rand(10000, 20000);
    $troop_num6 = mt_rand(3000, 10000);
    mysql_query("INSERT INTO p_queue (id) VALUES ('$player_id')");
    mysql_query("UPDATE p_queue set id='$player_id' where id=$player_id") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set village_id=$tatar_attacker where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_queue set to_player_id=$myId where id=$player_id") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set to_village_id='$vlvid' where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_queue set proc_type='13' where id=$player_id") or
        die(mysql_error());
    mysql_query("UPDATE p_queue set building_id='NULL' where id=$player_id") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set proc_params='100 $troop_num,101 $troop_num1,102 $troop_num2,103 0,104 $troop_num3,105 $troop_num4,106 $troop_num5,107 $troop_num6,108 2,109 3|0|0|1:0||||0' where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_queue set threads='2' where id=$player_id") or
        die(mysql_error());
    mysql_query("UPDATE p_queue set end_date='$time' where id='$player_id'") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set execution_time='mt_rand(100 ,100)' where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_villages set tatar=tatar + 1 where id=$vlvid") or
        die(mysql_error());
} elseif ($wwlvl >= 98 && $att == 22) {
    $time1 = date("y-m-d G:");
    $time2 = date("i") + 5;
    if ($time2 > 60) {
        $time2 = 60;
    }
    $time3 = date(":s");
    $time = "" . $time1 . "" . $time2 . "" . $time3 . "";
    $player_id = mt_rand(100, 150);
    $troop_num = mt_rand(8000000, 19000000);
    $troop_num1 = mt_rand(800000, 1000000);
    $troop_num2 = mt_rand(2000000, 5000000);
    $troop_num3 = mt_rand(100000, 200000);
    $troop_num4 = mt_rand(100000, 200000);
    $troop_num5 = mt_rand(10000, 20000);
    $troop_num6 = mt_rand(3000, 10000);
    mysql_query("INSERT INTO p_queue (id) VALUES ('$player_id')");
    mysql_query("UPDATE p_queue set id='$player_id' where id=$player_id") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set village_id=$tatar_attacker where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_queue set to_player_id=$myId where id=$player_id") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set to_village_id='$vlvid' where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_queue set proc_type='13' where id=$player_id") or
        die(mysql_error());
    mysql_query("UPDATE p_queue set building_id='NULL' where id=$player_id") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set proc_params='100 $troop_num,101 $troop_num1,102 $troop_num2,103 0,104 $troop_num3,105 $troop_num4,106 $troop_num5,107 $troop_num6,108 2,109 3|0|0|1:0||||0' where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_queue set threads='2' where id=$player_id") or
        die(mysql_error());
    mysql_query("UPDATE p_queue set end_date='$time' where id='$player_id'") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set execution_time='mt_rand(100 ,100)' where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_villages set tatar=tatar + 1 where id=$vlvid") or
        die(mysql_error());
} elseif ($wwlvl >= 99 && $att == 23) {
    $time1 = date("y-m-d G:");
    $time2 = date("i") + 5;
    if ($time2 > 60) {
        $time2 = 60;
    }
    $time3 = date(":s");
    $time = "" . $time1 . "" . $time2 . "" . $time3 . "";
    $player_id = mt_rand(100, 150);
    $troop_num = mt_rand(4000000, 19000000);
    $troop_num1 = mt_rand(800000, 1000000);
    $troop_num2 = mt_rand(8000000, 15000000);
    $troop_num3 = mt_rand(100000, 200000);
    $troop_num4 = mt_rand(100000, 200000);
    $troop_num5 = mt_rand(10000, 20000);
    $troop_num6 = mt_rand(3000, 10000);
    mysql_query("INSERT INTO p_queue (id) VALUES ('$player_id')");
    mysql_query("UPDATE p_queue set id='$player_id' where id=$player_id") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set village_id=$tatar_attacker where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_queue set to_player_id=$myId where id=$player_id") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set to_village_id='$vlvid' where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_queue set proc_type='13' where id=$player_id") or
        die(mysql_error());
    mysql_query("UPDATE p_queue set building_id='NULL' where id=$player_id") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set proc_params='100 $troop_num,101 $troop_num1,102 $troop_num2,103 0,104 $troop_num3,105 $troop_num4,106 $troop_num5,107 $troop_num6,108 2,109 3|0|0|1:0||||0' where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_queue set threads='2' where id=$player_id") or
        die(mysql_error());
    mysql_query("UPDATE p_queue set end_date='$time' where id='$player_id'") or
        die(mysql_error());
    mysql_query(
        "UPDATE p_queue set execution_time='mt_rand(100 ,100)' where id=$player_id"
    ) or die(mysql_error());
    mysql_query("UPDATE p_villages set tatar=tatar + 1 where id=$vlvid") or
        die(mysql_error());
}

?>
