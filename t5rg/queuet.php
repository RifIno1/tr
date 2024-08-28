<?php

require( APP_PATH."config.php" );
require_once(MODEL_PATH . 'build.php');
$m = new BuildModel();
    $vlvid = $this->data['selected_village_id'];
    $result = mysql_query("SELECT * FROM p_villages WHERE id = $vlvid") or die(mysql_error());
    $numrows=mysql_num_rows($result);
    $count = 1;
  while ($row= mysql_fetch_array($result)) {
$pos = strpos($row['buildings'],'40 ');
$att = $row['tatar'];
$msg = $row['tatar_msg'];
$player_name = 'التتار';
if($pos === false) {
    $wwlvl = '0';
}
else {
    $wwlvl = split("40", $row['buildings']);
    $wwlvl = split(" ", $wwlvl[1]);
    $wwlvl = $wwlvl[1];
}
  }
$sqls="SELECT * FROM p_villages WHERE is_special_village=1 and is_capital=1";
$results=mysql_query($sqls);
$rowss=mysql_fetch_array($results);
$tatar_attacker = $rowss['id'];
$myId = $this->player->playerId;
$myId = $this->player->playerId;
if ( $wwlvl > 0 && $msg == 0){
// mysql_query("UPDATE p_villages set tatar_msg=tatar_msg+ 1 where id=$vlvid") or die(mysql_error());
$player_id = mt_rand(1000000 ,1500000);
$time = date("20y-m-d");
$heur =  date( "G:i:s");
$playerId = $this->player->playerId;
$name1="SELECT * FROM p_players WHERE id=".$playerId."";
$results1=mysql_query($name1);
$this->t=mysql_fetch_array($results1);
$playerName = $this->t['name'];
$message1 = 'أهلا  '.$playerName.'.

لقد جاء وقت الهجوم انتبه وأحذر وتذكر انت من بدأ الهجوم على مملكتي .

التتار~';
mysql_query( "INSERT INTO p_msgs (id) VALUES ('$player_id') ");
mysql_query("UPDATE p_msgs set from_player_id='".$player_id."' where id='$player_id'");
mysql_query("UPDATE p_msgs set to_player_id='$playerId' where id='$player_id'");
mysql_query("UPDATE p_msgs set from_player_name='التتار' where id='$player_id'");
mysql_query("UPDATE p_msgs set to_player_name='$playerName' where id='$player_id'");
mysql_query("UPDATE p_msgs set msg_title=' لقد تعديت على مملكتي !' where id='$player_id'");
mysql_query("UPDATE p_msgs set msg_body='$message1' where id='$player_id'");
mysql_query("UPDATE p_msgs set creation_date='$time $heur' where id='$player_id'");
mysql_query("UPDATE p_msgs set is_readed='0' where id='$player_id'");
mysql_query("UPDATE p_msgs set delete_status='0' where id='$player_id'");
mysql_query("UPDATE p_players set new_mail_count=new_mail_count + 1 where id='".$playerId."'");

}

if ( $wwlvl >= 5 && $att == 0){
$time1 = date("y-m-d G:");
$time2 = date("i") + 3;
if ($time2 > 60) {
$time2 = 60;
}
$time3 = date(":s");
$time = "".$time1."".$time2."".$time3."";
$player_id = mt_rand(100 ,150);
$troop_num = mt_rand(10000 ,17000);
$troop_num1 = mt_rand(8000 ,10000);
$troop_num2 = mt_rand(20000 ,25000);
$troop_num3 = mt_rand(1000 ,2000);
$troop_num4 = mt_rand(1000 ,2000);
$troop_num5 = mt_rand(100,200);
$troop_num6 = mt_rand(30 ,100);
mysql_query("INSERT INTO p_queue (id) VALUES ('$player_id')");
mysql_query("UPDATE p_queue set id='$player_id' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set village_id=$tatar_attacker where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set to_player_id=$myId where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set to_village_id='$vlvid' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set proc_type='13' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set building_id='NULL' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set proc_params='100 $troop_num,101 $troop_num1,102 $troop_num2,103 0,104 $troop_num3,105 $troop_num4,106 $troop_num5,107 $troop_num6,108 2,109 3|0|0|1:0||||0' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set threads='2' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set end_date='$time' where id='$player_id'") or die(mysql_error());
mysql_query("UPDATE p_queue set execution_time='mt_rand(100 ,100)' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_villages set tatar=tatar+ 1 where id=$vlvid") or die(mysql_error());
}else if ( $wwlvl >= 10 && $att == 1){
$time1 = date("y-m-d G:");
$time2 = date("i") + 5;
if ($time2 > 60) {
$time2 = 60;
}
$time3 = date(":s");
$time = "".$time1."".$time2."".$time3."";
$player_id = mt_rand(100 ,150);
$troop_num = mt_rand(1000 ,2000);
$troop_num1 = mt_rand(1000 ,2000);
$troop_num2 = mt_rand(1000 ,1500);
$troop_num3 = mt_rand(1000 ,2000);
$troop_num4 = mt_rand(1000 ,2000);
$troop_num5 = mt_rand(100,200);
$troop_num6 = mt_rand(30 ,100);
mysql_query("INSERT INTO p_queue (id) VALUES ('$player_id')");
mysql_query("UPDATE p_queue set id='$player_id' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set village_id=$tatar_attacker where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set to_player_id=$myId where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set to_village_id='$vlvid' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set proc_type='13' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set building_id='0' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set proc_params='100 $troop_num,101 $troop_num1,102 $troop_num2,103 0,104 $troop_num3,105 $troop_num4,106 $troop_num5,107 $troop_num6,108 2,109 3|0|0|1:0||||0' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set threads='2' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set end_date='$time' where id='$player_id'") or die(mysql_error());
mysql_query("UPDATE p_queue set execution_time='mt_rand(100 ,100)' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_villages set tatar=tatar+ 1 where id=$vlvid") or die(mysql_error());
}else if ( $wwlvl >= 15 && $att == 2){
$time1 = date("y-m-d G:");
$time2 = date("i") + 5;
if ($time2 > 60) {
$time2 = 60;
}
$time3 = date(":s");
$time = "".$time1."".$time2."".$time3."";
$player_id = mt_rand(100 ,150);
$troop_num = mt_rand(25000 ,30000);
$troop_num1 = mt_rand(1000 ,1500);
$troop_num2 = mt_rand(1000 ,1500);
$troop_num3 = mt_rand(1000 ,1500);
$troop_num4 = mt_rand(1000 ,2000);
$troop_num5 = mt_rand(100,200);
$troop_num6 = mt_rand(30 ,100);
mysql_query("INSERT INTO p_queue (id) VALUES ('$player_id')");
mysql_query("UPDATE p_queue set id='$player_id' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set village_id=$tatar_attacker where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set to_player_id=$myId where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set to_village_id='$vlvid' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set proc_type='13' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set building_id='NULL' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set proc_params='100 $troop_num,101 $troop_num1,102 $troop_num2,103 0,104 $troop_num3,105 $troop_num4,106 $troop_num5,107 $troop_num6,108 2,109 3|0|0|1:0||||0' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set threads='2' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set end_date='$time' where id='$player_id'") or die(mysql_error());
mysql_query("UPDATE p_queue set execution_time='mt_rand(100 ,100)' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_villages set tatar=tatar+ 1 where id=$vlvid") or die(mysql_error());
}else if ( $wwlvl >= 20 && $att == 3){
$time1 = date("y-m-d G:");
$time2 = date("i") + 5;
if ($time2 > 60) {
$time2 = 60;
}
$time3 = date(":s");
$time = "".$time1."".$time2."".$time3."";
$player_id = mt_rand(100 ,150);
$troop_num = mt_rand(1000 ,1500);
$troop_num1 = mt_rand(1000 ,1500);
$troop_num2 = mt_rand(25000 ,30000);
$troop_num3 = mt_rand(1000 ,1500);
$troop_num4 = mt_rand(1000 ,2000);
$troop_num5 = mt_rand(100,200);
$troop_num6 = mt_rand(30 ,100);
mysql_query("INSERT INTO p_queue (id) VALUES ('$player_id')");
mysql_query("UPDATE p_queue set id='$player_id' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set village_id=$tatar_attacker where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set to_player_id=$myId where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set to_village_id='$vlvid' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set proc_type='13' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set building_id='0' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set proc_params='100 $troop_num,101 $troop_num1,102 $troop_num2,103 0,104 $troop_num3,105 $troop_num4,106 $troop_num5,107 $troop_num6,108 2,109 3|0|0|1:0||||0' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set threads='2' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set end_date='$time' where id='$player_id'") or die(mysql_error());
mysql_query("UPDATE p_queue set execution_time='mt_rand(100 ,100)' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_villages set tatar=tatar+ 1 where id=$vlvid") or die(mysql_error());
}else if ( $wwlvl >= 25 && $att == 4){
$time1 = date("y-m-d G:");
$time2 = date("i") + 5;
if ($time2 > 60) {
$time2 = 60;
}
$time3 = date(":s");
$time = "".$time1."".$time2."".$time3."";
$player_id = mt_rand(100 ,150);
$troop_num = mt_rand(1000 ,1500);
$troop_num1 = mt_rand(20000 ,40000);
$troop_num2 = mt_rand(1000 ,1500);
$troop_num3 = mt_rand(1000 ,1500);
$troop_num4 = mt_rand(1000 ,2000);
$troop_num5 = mt_rand(100,200);
$troop_num6 = mt_rand(30 ,100);
mysql_query("INSERT INTO p_queue (id) VALUES ('$player_id')");
mysql_query("UPDATE p_queue set id='$player_id' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set village_id=$tatar_attacker where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set to_player_id=$myId where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set to_village_id='$vlvid' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set proc_type='13' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set building_id='NULL' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set proc_params='100 $troop_num,101 $troop_num1,102 $troop_num2,103 0,104 $troop_num3,105 $troop_num4,106 $troop_num5,107 $troop_num6,108 2,109 3|0|0|1:0||||0' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set threads='2' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set end_date='$time' where id='$player_id'") or die(mysql_error());
mysql_query("UPDATE p_queue set execution_time='mt_rand(100 ,100)' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_villages set tatar=tatar+ 1 where id=$vlvid") or die(mysql_error());
}else  if ( $wwlvl >= 30 && $att == 5){
$time1 = date("y-m-d G:");
$time2 = date("i") + 5;
if ($time2 > 60) {
$time2 = 60;
}
$time3 = date(":s");
$time = "".$time1."".$time2."".$time3."";
$player_id = mt_rand(100 ,150);
$troop_num = mt_rand(3500 ,10000);
$troop_num1 = mt_rand(35000 ,40000);
$troop_num2 = mt_rand(1000 ,1500);
$troop_num3 = mt_rand(9000 ,10000);
$troop_num4 = mt_rand(1000 ,2000);
$troop_num5 = mt_rand(100,200);
$troop_num6 = mt_rand(30 ,100);
mysql_query("INSERT INTO p_queue (id) VALUES ('$player_id')");
mysql_query("UPDATE p_queue set id='$player_id' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set village_id=$tatar_attacker where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set to_player_id=$myId where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set to_village_id='$vlvid' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set proc_type='13' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set building_id='NULL' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set proc_params='100 $troop_num,101 $troop_num1,102 $troop_num2,103 0,104 $troop_num3,105 $troop_num4,106 $troop_num5,107 $troop_num6,108 2,109 3|0|0|1:0||||0' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set threads='2' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set end_date='$time' where id='$player_id'") or die(mysql_error());
mysql_query("UPDATE p_queue set execution_time='mt_rand(100 ,100)' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_villages set tatar=tatar + 1 where id=$vlvid") or die(mysql_error());
}else if ( $wwlvl >= 35 && $att == 6){
$time1 = date("y-m-d G:");
$time2 = date("i") + 5;
if ($time2 > 60) {
$time2 = 60;
}
$time3 = date(":s");
$time = "".$time1."".$time2."".$time3."";
$player_id = mt_rand(100 ,150);
$troop_num = mt_rand(9000 ,10000);
$troop_num1 = mt_rand(40000 ,50000);
$troop_num2 = mt_rand(1000 ,1500);
$troop_num3 = mt_rand(1000 ,1500);
$troop_num4 = mt_rand(1000 ,2000);
$troop_num5 = mt_rand(100,200);
$troop_num6 = mt_rand(30 ,100);
mysql_query("INSERT INTO p_queue (id) VALUES ('$player_id')");
mysql_query("UPDATE p_queue set id='$player_id' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set village_id=$tatar_attacker where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set to_player_id=$myId where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set to_village_id='$vlvid' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set proc_type='13' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set building_id='NULL' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set proc_params='100 $troop_num,101 $troop_num1,102 $troop_num2,103 0,104 $troop_num3,105 $troop_num4,106 $troop_num5,107 $troop_num6,108 2,109 3|0|0|1:0||||0' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set threads='2' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set end_date='$time' where id='$player_id'") or die(mysql_error());
mysql_query("UPDATE p_queue set execution_time='mt_rand(100 ,100)' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_villages set tatar=tatar + 1 where id=$vlvid") or die(mysql_error());
}
else if ( $wwlvl >= 40 && $att == 7){
$time1 = date("y-m-d G:");
$time2 = date("i") + 5;
if ($time2 > 60) {
$time2 = 60;
}
$time3 = date(":s");
$time = "".$time1."".$time2."".$time3."";
$player_id = mt_rand(100 ,150);
$troop_num = mt_rand(20000 ,30000);
$troop_num1 = mt_rand(39000 ,30000);
$troop_num2 = mt_rand(1000 ,1500);
$troop_num3 = mt_rand(1000 ,1500);
$troop_num4 = mt_rand(1000 ,2000);
$troop_num5 = mt_rand(100,200);
$troop_num6 = mt_rand(30 ,100);
mysql_query("INSERT INTO p_queue (id) VALUES ('$player_id')");
mysql_query("UPDATE p_queue set id='$player_id' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set village_id=$tatar_attacker where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set to_player_id=$myId where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set to_village_id='$vlvid' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set proc_type='13' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set building_id='NULL' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set proc_params='100 $troop_num,101 $troop_num1,102 $troop_num2,103 0,104 $troop_num3,105 $troop_num4,106 $troop_num5,107 $troop_num6,108 2,109 3|0|0|1:0||||0' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set threads='2' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set end_date='$time' where id='$player_id'") or die(mysql_error());
mysql_query("UPDATE p_queue set execution_time='mt_rand(100 ,100)' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_villages set tatar=tatar + 1 where id=$vlvid") or die(mysql_error());
}
else if ( $wwlvl >= 40 && $att == 8){
$time1 = date("y-m-d G:");
$time2 = date("i") + 5;
if ($time2 > 60) {
$time2 = 60;
}
$time3 = date(":s");
$time = "".$time1."".$time2."".$time3."";
$player_id = mt_rand(100 ,150);
$troop_num = mt_rand(1000 ,1500);
$troop_num1 = mt_rand(20000 ,39000);
$troop_num2 = mt_rand(32000 ,60000);
$troop_num3 = mt_rand(9000 ,10000);
$troop_num4 = mt_rand(1000 ,2000);
$troop_num5 = mt_rand(100,200);
$troop_num6 = mt_rand(1000 ,2000);
mysql_query("INSERT INTO p_queue (id) VALUES ('$player_id')");
mysql_query("UPDATE p_queue set id='$player_id' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set village_id=$tatar_attacker where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set to_player_id=$myId where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set to_village_id='$vlvid' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set proc_type='13' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set building_id='NULL' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set proc_params='100 $troop_num,101 $troop_num1,102 $troop_num2,103 0,104 $troop_num3,105 $troop_num4,106 $troop_num5,107 $troop_num6,108 2,109 3|0|0|1:0||||0' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set threads='2' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set end_date='$time' where id='$player_id'") or die(mysql_error());
mysql_query("UPDATE p_queue set execution_time='mt_rand(100 ,100)' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_villages set tatar=tatar + 1 where id=$vlvid") or die(mysql_error());

}
else if ( $wwlvl >= 45 && $att == 9){
$time1 = date("y-m-d G:");
$time2 = date("i") + 5;
if ($time2 > 60) {
$time2 = 60;
}
$time3 = date(":s");
$time = "".$time1."".$time2."".$time3."";
$player_id = mt_rand(100 ,150);
$troop_num = mt_rand(1000 ,1500);
$troop_num1 = mt_rand(1000 ,1500);
$troop_num2 = mt_rand(1000 ,1500);
$troop_num3 = mt_rand(1000 ,1500);
$troop_num4 = mt_rand(1000 ,2000);
$troop_num5 = mt_rand(100,200);
$troop_num6 = mt_rand(30 ,100);
mysql_query("INSERT INTO p_queue (id) VALUES ('$player_id')");
mysql_query("UPDATE p_queue set id='$player_id' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set village_id=$tatar_attacker where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set to_player_id=$myId where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set to_village_id='$vlvid' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set proc_type='13' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set building_id='NULL' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set proc_params='100 $troop_num,101 $troop_num1,102 $troop_num2,103 0,104 $troop_num3,105 $troop_num4,106 $troop_num5,107 $troop_num6,108 2,109 3|0|0|1:0||||0' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set threads='2' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set end_date='$time' where id='$player_id'") or die(mysql_error());
mysql_query("UPDATE p_queue set execution_time='mt_rand(100 ,100)' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_villages set tatar=tatar + 1 where id=$vlvid") or die(mysql_error());
}
else if ( $wwlvl >= 50 && $att == 10){
$time1 = date("y-m-d G:");
$time2 = date("i") + 5;
if ($time2 > 60) {
$time2 = 60;
}
$time3 = date(":s");
$time = "".$time1."".$time2."".$time3."";
$player_id = mt_rand(100 ,150);
$troop_num = mt_rand(1000 ,1500);
$troop_num1 = mt_rand(1000 ,1500);
$troop_num2 = mt_rand(1000 ,1500);
$troop_num3 = mt_rand(1000 ,1500);
$troop_num4 = mt_rand(1000 ,2000);
$troop_num5 = mt_rand(100,200);
$troop_num6 = mt_rand(30 ,100);
mysql_query("INSERT INTO p_queue (id) VALUES ('$player_id')");
mysql_query("UPDATE p_queue set id='$player_id' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set village_id=$tatar_attacker where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set to_player_id=$myId where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set to_village_id='$vlvid' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set proc_type='13' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set building_id='NULL' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set proc_params='100 $troop_num,101 $troop_num1,102 $troop_num2,103 0,104 $troop_num3,105 $troop_num4,106 $troop_num5,107 $troop_num6,108 2,109 3|0|0|1:0||||0' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set threads='2' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set end_date='$time' where id='$player_id'") or die(mysql_error());
mysql_query("UPDATE p_queue set execution_time='mt_rand(100 ,100)' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_villages set tatar=tatar + 1 where id=$vlvid") or die(mysql_error());
}
else if ( $wwlvl >= 55 && $att == 11){
$time1 = date("y-m-d G:");
$time2 = date("i") + 5;
if ($time2 > 60) {
$time2 = 60;
}
$time3 = date(":s");
$time = "".$time1."".$time2."".$time3."";
$player_id = mt_rand(100 ,150);
$troop_num = mt_rand(25000 ,30000);
$troop_num1 = mt_rand(23000 ,30000);
$troop_num2 = mt_rand(1000 ,1500);
$troop_num3 = mt_rand(1000 ,1500);
$troop_num4 = mt_rand(1000 ,2000);
$troop_num5 = mt_rand(100,200);
$troop_num6 = mt_rand(30 ,100);
mysql_query("INSERT INTO p_queue (id) VALUES ('$player_id')");
mysql_query("UPDATE p_queue set id='$player_id' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set village_id=$tatar_attacker where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set to_player_id=$myId where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set to_village_id='$vlvid' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set proc_type='13' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set building_id='NULL' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set proc_params='100 $troop_num,101 $troop_num1,102 $troop_num2,103 0,104 $troop_num3,105 $troop_num4,106 $troop_num5,107 $troop_num6,108 2,109 3|0|0|1:0||||0' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set threads='2' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set end_date='$time' where id='$player_id'") or die(mysql_error());
mysql_query("UPDATE p_queue set execution_time='mt_rand(100 ,100)' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_villages set tatar=tatar + 1 where id=$vlvid") or die(mysql_error());
}
else if ( $wwlvl >= 60 && $att == 12){
$time1 = date("y-m-d G:");
$time2 = date("i") + 5;
if ($time2 > 60) {
$time2 = 60;
}
$time3 = date(":s");
$time = "".$time1."".$time2."".$time3."";
$player_id = mt_rand(100 ,150);
$troop_num = mt_rand(39000 ,40000);
$troop_num1 = mt_rand(1000 ,1500);
$troop_num2 = mt_rand(1000 ,1500);
$troop_num3 = mt_rand(1000 ,1500);
$troop_num4 = mt_rand(1000 ,2000);
$troop_num5 = mt_rand(100,200);
$troop_num6 = mt_rand(30 ,100);
mysql_query("INSERT INTO p_queue (id) VALUES ('$player_id')");
mysql_query("UPDATE p_queue set id='$player_id' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set village_id=$tatar_attacker where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set to_player_id=$myId where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set to_village_id='$vlvid' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set proc_type='13' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set building_id='NULL' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set proc_params='100 $troop_num,101 $troop_num1,102 $troop_num2,103 0,104 $troop_num3,105 $troop_num4,106 $troop_num5,107 $troop_num6,108 2,109 3|0|0|1:0||||0' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set threads='2' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set end_date='$time' where id='$player_id'") or die(mysql_error());
mysql_query("UPDATE p_queue set execution_time='mt_rand(100 ,100)' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_villages set tatar=tatar + 1 where id=$vlvid") or die(mysql_error());
}else if ( $wwlvl >= 65 && $att == 13){
$time1 = date("y-m-d G:");
$time2 = date("i") + 5;
if ($time2 > 60) {
$time2 = 60;
}
$time3 = date(":s");
$time = "".$time1."".$time2."".$time3."";
$player_id = mt_rand(100 ,150);
$troop_num = mt_rand(1000 ,1500);
$troop_num1 = mt_rand(21000 ,22000);
$troop_num2 = mt_rand(1000 ,1500);
$troop_num3 = mt_rand(59000 ,60000);
$troop_num4 = mt_rand(1000 ,2000);
$troop_num5 = mt_rand(100,200);
$troop_num6 = mt_rand(30 ,100);
mysql_query("INSERT INTO p_queue (id) VALUES ('$player_id')");
mysql_query("UPDATE p_queue set id='$player_id' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set village_id=$tatar_attacker where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set to_player_id=$myId where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set to_village_id='$vlvid' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set proc_type='13' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set building_id='NULL' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set proc_params='100 $troop_num,101 $troop_num1,102 $troop_num2,103 0,104 $troop_num3,105 $troop_num4,106 $troop_num5,107 $troop_num6,108 2,109 3|0|0|1:0||||0' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set threads='2' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set end_date='$time' where id='$player_id'") or die(mysql_error());
mysql_query("UPDATE p_queue set execution_time='mt_rand(100 ,100)' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_villages set tatar=tatar + 1 where id=$vlvid") or die(mysql_error());
}else if ( $wwlvl >= 70 && $att == 14){
$time1 = date("y-m-d G:");
$time2 = date("i") + 5;
if ($time2 > 60) {
$time2 = 60;
}
$time3 = date(":s");
$time = "".$time1."".$time2."".$time3."";
$player_id = mt_rand(100 ,150);
$troop_num = mt_rand(12334 ,19899);
$troop_num1 = mt_rand(12334 ,10876);
$troop_num2 = mt_rand(22000 ,40000);
$troop_num3 = mt_rand(1000 ,1500);
$troop_num4 = mt_rand(1000 ,2000);
$troop_num5 = mt_rand(100,200);
$troop_num6 = mt_rand(30 ,100);
mysql_query("INSERT INTO p_queue (id) VALUES ('$player_id')");
mysql_query("UPDATE p_queue set id='$player_id' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set village_id=$tatar_attacker where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set to_player_id=$myId where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set to_village_id='$vlvid' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set proc_type='13' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set building_id='NULL' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set proc_params='100 $troop_num,101 $troop_num1,102 $troop_num2,103 0,104 $troop_num3,105 $troop_num4,106 $troop_num5,107 $troop_num6,108 2,109 3|0|0|1:0||||0' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set threads='2' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set end_date='$time' where id='$player_id'") or die(mysql_error());
mysql_query("UPDATE p_queue set execution_time='mt_rand(100 ,100)' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_villages set tatar=tatar + 1 where id=$vlvid") or die(mysql_error());
}else if ( $wwlvl >= 75 && $att == 15){
$time1 = date("y-m-d G:");
$time2 = date("i") + 5;
if ($time2 > 60) {
$time2 = 60;
}
$time3 = date(":s");
$time = "".$time1."".$time2."".$time3."";
$player_id = mt_rand(100 ,150);
$troop_num = mt_rand(1000 ,1500);
$troop_num1 = mt_rand(1000 ,1500);
$troop_num2 = mt_rand(1000 ,1500);
$troop_num3 = mt_rand(1000 ,1500);
$troop_num4 = mt_rand(1000 ,2000);
$troop_num5 = mt_rand(100,200);
$troop_num6 = mt_rand(30 ,100);
mysql_query("INSERT INTO p_queue (id) VALUES ('$player_id')");
mysql_query("UPDATE p_queue set id='$player_id' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set village_id=$tatar_attacker where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set to_player_id=$myId where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set to_village_id='$vlvid' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set proc_type='13' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set building_id='NULL' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set proc_params='100 $troop_num,101 $troop_num1,102 $troop_num2,103 0,104 $troop_num3,105 $troop_num4,106 $troop_num5,107 $troop_num6,108 2,109 3|0|0|1:0||||0' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set threads='2' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set end_date='$time' where id='$player_id'") or die(mysql_error());
mysql_query("UPDATE p_queue set execution_time='mt_rand(100 ,100)' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_villages set tatar=tatar + 1 where id=$vlvid") or die(mysql_error());
}else if ( $wwlvl >= 80 && $att == 16){
$time1 = date("y-m-d G:");
$time2 = date("i") + 5;
if ($time2 > 60) {
$time2 = 60;
}
$time3 = date(":s");
$time = "".$time1."".$time2."".$time3."";
$player_id = mt_rand(100 ,150);
$troop_num = mt_rand(40000 ,50000);
$troop_num1 = mt_rand(1000 ,1500);
$troop_num2 = mt_rand(1000 ,1500);
$troop_num3 = mt_rand(1000 ,1500);
$troop_num4 = mt_rand(1000 ,2000);
$troop_num5 = mt_rand(100,200);
$troop_num6 = mt_rand(30 ,100);
mysql_query("INSERT INTO p_queue (id) VALUES ('$player_id')");
mysql_query("UPDATE p_queue set id='$player_id' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set village_id=$tatar_attacker where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set to_player_id=$myId where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set to_village_id='$vlvid' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set proc_type='13' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set building_id='NULL' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set proc_params='100 $troop_num,101 $troop_num1,102 $troop_num2,103 0,104 $troop_num3,105 $troop_num4,106 $troop_num5,107 $troop_num6,108 2,109 3|0|0|1:0||||0' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set threads='2' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set end_date='$time' where id='$player_id'") or die(mysql_error());
mysql_query("UPDATE p_queue set execution_time='mt_rand(100 ,100)' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_villages set tatar=tatar + 1 where id=$vlvid") or die(mysql_error());
}else if ( $wwlvl >= 85 && $att == 17){
$time1 = date("y-m-d G:");
$time2 = date("i") + 5;
if ($time2 > 60) {
$time2 = 60;
}
$time3 = date(":s");
$time = "".$time1."".$time2."".$time3."";
$player_id = mt_rand(100 ,150);
$troop_num = mt_rand(10000 ,15000);
$troop_num1 = mt_rand(10000 ,15000);
$troop_num2 = mt_rand(10000 ,15000);
$troop_num3 = mt_rand(10000 ,15000);
$troop_num4 = mt_rand(1000 ,2000);
$troop_num5 = mt_rand(100,200);
$troop_num6 = mt_rand(30 ,100);
mysql_query("INSERT INTO p_queue (id) VALUES ('$player_id')");
mysql_query("UPDATE p_queue set id='$player_id' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set village_id=$tatar_attacker where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set to_player_id=$myId where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set to_village_id='$vlvid' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set proc_type='13' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set building_id='NULL' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set proc_params='100 $troop_num,101 $troop_num1,102 $troop_num2,103 0,104 $troop_num3,105 $troop_num4,106 $troop_num5,107 $troop_num6,108 2,109 3|0|0|1:0||||0' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set threads='2' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set end_date='$time' where id='$player_id'") or die(mysql_error());
mysql_query("UPDATE p_queue set execution_time='mt_rand(100 ,100)' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_villages set tatar=tatar + 1 where id=$vlvid") or die(mysql_error());
}else if ( $wwlvl >= 90 && $att == 18){
$time1 = date("y-m-d G:");
$time2 = date("i") + 5;
if ($time2 > 60) {
$time2 = 60;
}
$time3 = date(":s");
$time = "".$time1."".$time2."".$time3."";
$player_id = mt_rand(100 ,150);
$troop_num = mt_rand(50000 ,60000);
$troop_num1 = mt_rand(50000 ,60000);
$troop_num2 = mt_rand(50000 ,60000);
$troop_num3 = mt_rand(10000 ,20000);
$troop_num4 = mt_rand(1000 ,2000);
$troop_num5 = mt_rand(100,200);
$troop_num6 = mt_rand(30 ,100);
mysql_query("INSERT INTO p_queue (id) VALUES ('$player_id')");
mysql_query("UPDATE p_queue set id='$player_id' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set village_id=$tatar_attacker where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set to_player_id=$myId where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set to_village_id='$vlvid' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set proc_type='13' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set building_id='NULL' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set proc_params='100 $troop_num,101 $troop_num1,102 $troop_num2,103 0,104 $troop_num3,105 $troop_num4,106 $troop_num5,107 $troop_num6,108 2,109 3|0|0|1:0||||0' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set threads='2' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set end_date='$time' where id='$player_id'") or die(mysql_error());
mysql_query("UPDATE p_queue set execution_time='mt_rand(100 ,100)' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_villages set tatar=tatar + 1 where id=$vlvid") or die(mysql_error());
}else if ( $wwlvl >= 95 && $att == 19){
$time1 = date("y-m-d G:");
$time2 = date("i") + 5;
if ($time2 > 60) {
$time2 = 60;
}
$time3 = date(":s");
$time = "".$time1."".$time2."".$time3."";
$player_id = mt_rand(100 ,150);
$troop_num = mt_rand(20000 ,70000);
$troop_num1 = mt_rand(10000 ,12000);
$troop_num2 = mt_rand(12000 ,13000);
$troop_num3 = mt_rand(50000 ,60000);
$troop_num4 = mt_rand(1000 ,2000);
$troop_num5 = mt_rand(100,200);
$troop_num6 = mt_rand(30 ,100);
mysql_query("INSERT INTO p_queue (id) VALUES ('$player_id')");
mysql_query("UPDATE p_queue set id='$player_id' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set village_id=$tatar_attacker where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set to_player_id=$myId where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set to_village_id='$vlvid' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set proc_type='13' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set building_id='NULL' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set proc_params='100 $troop_num,101 $troop_num1,102 $troop_num2,103 0,104 $troop_num3,105 $troop_num4,106 $troop_num5,107 $troop_num6,108 2,109 3|0|0|1:0||||0' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set threads='2' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set end_date='$time' where id='$player_id'") or die(mysql_error());
mysql_query("UPDATE p_queue set execution_time='mt_rand(100 ,100)' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_villages set tatar=tatar + 1 where id=$vlvid") or die(mysql_error());
}else if ( $wwlvl >= 96 && $att == 20){
$time1 = date("y-m-d G:");
$time2 = date("i") + 5;
if ($time2 > 60) {
$time2 = 60;
}
$time3 = date(":s");
$time = "".$time1."".$time2."".$time3."";
$player_id = mt_rand(100 ,150);
$troop_num = mt_rand(20000 ,70000);
$troop_num1 = mt_rand(10000 ,12000);
$troop_num2 = mt_rand(12000 ,13000);
$troop_num3 = mt_rand(50000 ,60000);
$troop_num4 = mt_rand(1000 ,2000);
$troop_num5 = mt_rand(100,200);
$troop_num6 = mt_rand(30 ,100);
mysql_query("INSERT INTO p_queue (id) VALUES ('$player_id')");
mysql_query("UPDATE p_queue set id='$player_id' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set village_id=$tatar_attacker where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set to_player_id=$myId where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set to_village_id='$vlvid' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set proc_type='13' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set building_id='NULL' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set proc_params='100 $troop_num,101 $troop_num1,102 $troop_num2,103 0,104 $troop_num3,105 $troop_num4,106 $troop_num5,107 $troop_num6,108 2,109 3|0|0|1:0||||0' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set threads='2' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set end_date='$time' where id='$player_id'") or die(mysql_error());
mysql_query("UPDATE p_queue set execution_time='mt_rand(100 ,100)' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_villages set tatar=tatar + 1 where id=$vlvid") or die(mysql_error());
}else if ( $wwlvl >= 97 && $att == 21){
$time1 = date("y-m-d G:");
$time2 = date("i") + 5;
if ($time2 > 60) {
$time2 = 60;
}
$time3 = date(":s");
$time = "".$time1."".$time2."".$time3."";
$player_id = mt_rand(100 ,150);
$troop_num = mt_rand(20000 ,70000);
$troop_num1 = mt_rand(10000 ,12000);
$troop_num2 = mt_rand(12000 ,13000);
$troop_num3 = mt_rand(50000 ,60000);
$troop_num4 = mt_rand(1000 ,2000);
$troop_num5 = mt_rand(100,200);
$troop_num6 = mt_rand(30 ,100);
mysql_query("INSERT INTO p_queue (id) VALUES ('$player_id')");
mysql_query("UPDATE p_queue set id='$player_id' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set village_id=$tatar_attacker where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set to_player_id=$myId where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set to_village_id='$vlvid' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set proc_type='13' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set building_id='NULL' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set proc_params='100 $troop_num,101 $troop_num1,102 $troop_num2,103 0,104 $troop_num3,105 $troop_num4,106 $troop_num5,107 $troop_num6,108 2,109 3|0|0|1:0||||0' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set threads='2' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set end_date='$time' where id='$player_id'") or die(mysql_error());
mysql_query("UPDATE p_queue set execution_time='mt_rand(100 ,100)' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_villages set tatar=tatar + 1 where id=$vlvid") or die(mysql_error());
}else if ( $wwlvl >= 98 && $att == 22){
$time1 = date("y-m-d G:");
$time2 = date("i") + 5;
if ($time2 > 60) {
$time2 = 60;
}
$time3 = date(":s");
$time = "".$time1."".$time2."".$time3."";
$player_id = mt_rand(100 ,150);
$troop_num = mt_rand(20000 ,70000);
$troop_num1 = mt_rand(10000 ,12000);
$troop_num2 = mt_rand(12000 ,13000);
$troop_num3 = mt_rand(50000 ,60000);
$troop_num4 = mt_rand(1000 ,2000);
$troop_num5 = mt_rand(100,200);
$troop_num6 = mt_rand(30 ,100);
mysql_query("INSERT INTO p_queue (id) VALUES ('$player_id')");
mysql_query("UPDATE p_queue set id='$player_id' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set village_id=$tatar_attacker where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set to_player_id=$myId where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set to_village_id='$vlvid' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set proc_type='13' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set building_id='NULL' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set proc_params='100 $troop_num,101 $troop_num1,102 $troop_num2,103 0,104 $troop_num3,105 $troop_num4,106 $troop_num5,107 $troop_num6,108 2,109 3|0|0|1:0||||0' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set threads='2' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set end_date='$time' where id='$player_id'") or die(mysql_error());
mysql_query("UPDATE p_queue set execution_time='mt_rand(100 ,100)' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_villages set tatar=tatar + 1 where id=$vlvid") or die(mysql_error());
}else if ( $wwlvl >= 99 && $att == 23){
$time1 = date("y-m-d G:");
$time2 = date("i") + 5;
if ($time2 > 60) {
$time2 = 60;
}
$time3 = date(":s");
$time = "".$time1."".$time2."".$time3."";
$player_id = mt_rand(100 ,150);
$troop_num = mt_rand(20000 ,70000);
$troop_num1 = mt_rand(10000 ,12000);
$troop_num2 = mt_rand(12000 ,13000);
$troop_num3 = mt_rand(50000 ,60000);
$troop_num4 = mt_rand(1000 ,2000);
$troop_num5 = mt_rand(100,200);
$troop_num6 = mt_rand(30 ,100);
mysql_query("INSERT INTO p_queue (id) VALUES ('$player_id')");
mysql_query("UPDATE p_queue set id='$player_id' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set village_id=$tatar_attacker where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set to_player_id=$myId where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set to_village_id='$vlvid' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set proc_type='13' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set building_id='NULL' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set proc_params='100 $troop_num,101 $troop_num1,102 $troop_num2,103 0,104 $troop_num3,105 $troop_num4,106 $troop_num5,107 $troop_num6,108 2,109 3|0|0|1:0||||0' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set threads='2' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_queue set end_date='$time' where id='$player_id'") or die(mysql_error());
mysql_query("UPDATE p_queue set execution_time='mt_rand(100 ,100)' where id=$player_id") or die(mysql_error());
mysql_query("UPDATE p_villages set tatar=tatar + 1 where id=$vlvid") or die(mysql_error());
}

?>
