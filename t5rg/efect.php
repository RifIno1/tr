require( APP_PATH."config.php" );
$link = mysql_connect($AppConfig['db']['host'],$AppConfig['db']['user'],$AppConfig['db']['password']) or die(mysql_error());
mysql_select_db($AppConfig['db']['database'],$link) or die(mysql_error());
//is artefact Done name=2
$query1 = "select * from  p_villages where is_artefact=1 AND artefact_name=2 AND player_id='".$this->player->playerId."'";
$query2 = "select * from  p_players where id='".$this->player->playerId."'";
$result1 = mysql_num_rows(mysql_query($query1));
$result3 = mysql_query($query2);
if ($result1 >= 1) {
$result2 = mysql_query($query1);
$name1 = mysql_fetch_array($result2);
$name2 = mysql_fetch_array($result3);
if ($name1[type] == 1 && $name2['used'] == 0) {
mysql_query("update `p_villages` set `crop_consumption` =crop_consumption / 4 where player_id='".$this->player->playerId."'");
mysql_query("update `p_players` set `used` = 1 where id=".$this->player->playerId."");
}else if ($name2['used'] == 0){
mysql_query("update `p_villages` set `crop_consumption` =crop_consumption / 2 where parent_id='".$this->data['selected_village_id']."'");
mysql_query("update `p_players` set `used` = 1 where id=".$this->player->playerId."");
}
} else if ($result1 == 0)  {
$query2 = "select * from  p_players where id='".$this->player->playerId."'";
$result3 = mysql_query($query2);
$name2 = mysql_fetch_array($result3);
if ($name2['used'] == 1) {
mysql_query("update `p_villages` set `crop_consumption` =crop_consumption * 3 where player_id='".$this->player->playerId."'");
mysql_query("update `p_players` set `used` = 0 where id=".$this->player->playerId."");
}
}
//end artefact
//is artefact Done name=4
$query11 = "select * from  p_villages where is_artefact=1 AND artefact_name=4 AND player_id='".$this->player->playerId."'";
$query12 = "select * from  p_players where id='".$this->player->playerId."'";
$result11 = mysql_num_rows(mysql_query($query11));
$result13 = mysql_query($query12);
if ($result11 >= 1) {
$result12 = mysql_query($query11);
$name11 = mysql_fetch_array($result12);
$name12 = mysql_fetch_array($result13);
if ($name11[type] == 1 && $name12['used1'] == 0) {
mysql_query("update `p_villages` set `time_consume_percent` =time_consume_percent - 20 where player_id='".$this->player->playerId."'");
mysql_query("update `p_players` set `used1` = 1 where id=".$this->player->playerId."");
}else if ($name12['used1'] == 0){
mysql_query("update `p_villages` set `time_consume_percent` =time_consume_percent - 10 where player_id='".$this->player->playerId."'");
mysql_query("update `p_players` set `used1` = 1 where id=".$this->player->playerId."");
}
} else if ($result11 == 0)  {
$query12 = "select * from  p_players where id='".$this->player->playerId."'";
$result13 = mysql_query($query12);
$name12 = mysql_fetch_array($result13);
if ($name12['used1'] == 1) {
mysql_query("update `p_villages` set `time_consume_percent` =time_consume_percent + 30 where parent_id='".$this->data['selected_village_id']."'");
mysql_query("update `p_players` set `used1` = 0 where id=".$this->player->playerId."");
}
}
//end artefact
