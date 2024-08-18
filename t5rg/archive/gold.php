<?php

require_once("t5rg/config.php");
$club = '1'; // كمية الذهب المراد زيادتها
$uid = $this->player->playerId;
$Voxs = mysql_query("SELECT * From p_players WHERE id='$uid'");
$this->CropFinder = mysql_fetch_array($Voxs);
            if ( $this->CropFinder['club'] == 0< ) {

$link = mysql_connect($AppConfig['db']['host'],$AppConfig['db']['user'],$AppConfig['db']['password']) or die(mysql_error());
mysql_select_db($AppConfig['db']['database'],$link) or die(mysql_error());

// INC club
mysql_query("UPDATE p_players set club=club + $goldnum ") or die(mysql_error());
// END INC

?>