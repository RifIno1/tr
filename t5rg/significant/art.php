<?php
//Id To Village
$villages_id1 = mt_rand( 30000 , 60000);
$villages_id2 = mt_rand( 30000 , 60000);
$villages_id3 = mt_rand( 30000 , 60000);
$villages_id4 = mt_rand( 30000 , 60000);
$villages_id5 = mt_rand( 30000 , 60000);
$villages_id6 = mt_rand( 30000 , 60000);
$villages_id7 = mt_rand( 30000 , 60000);
$villages_id8 = mt_rand( 30000 , 60000);
//END Id To Village
//Troops Village
$troops_training = '99 1 0 0,100 1 0 0,101 0 0 0,102 1 4 5,103 1 0 1,104 1 0 0,105 0 0 0,106 0 0 0,107 0 0 0,108 1 0 0,109 1 0 0';
$troop1 = mt_rand( 100000 , 120000);
$troop2 = mt_rand( 60000 , 65000);
$troop3 = mt_rand( 60000 , 65000);
$troop4 = mt_rand( 1000 , 2000);
$troop5 = mt_rand( 1000 , 2000);
$k1 = '-1:99 0,100 '.$troop1.',101 '.$troop2.',102 '.$troop3.',103 0,104 '.$troop4.',105 '.$troop5.',106 0,107 0,108 0,109 0';

$troop1 = mt_rand( 100000 , 120000);
$troop2 = mt_rand( 60000 , 65000);
$troop3 = mt_rand( 60000 , 65000);
$troop4 = mt_rand( 1000 , 2000);
$troop5 = mt_rand( 1000 , 2000);
$k2 = '-1:99 0,100 '.$troop11.',101 '.$troop12.',102 '.$troop13.',103 0,104 '.$troop14.',105 '.$troop15.',106 0,107 0,108 0,109 0';

$troop1 = mt_rand( 100000 , 120000);
$troop2 = mt_rand( 60000 , 65000);
$troop3 = mt_rand( 60000 , 65000);
$troop4 = mt_rand( 1000 , 2000);
$troop5 = mt_rand( 1000 , 2000);
$k2 = '-1:99 0,100 '.$troop111.',101 '.$troop122.',102 '.$troop133.',103 0,104 '.$troop144.',105 '.$troop155.',106 0,107 0,108 0,109 0';

//EnD Troops Village
//<!--    UPDATE TO Village
//Village 1
mysql_query("UPDATE p_villages set is_artefact='1' where id='$villages_id1'") or die(mysql_error());
mysql_query("UPDATE p_villages set artefact_name='1' where id='$villages_id1'") or die(mysql_error());
mysql_query("UPDATE p_villages set type=1 where id='$villages_id1'") or die(mysql_error());
mysql_query("UPDATE p_villages set troops_training='$troops_training' where id='$villages_id1'") or die(mysql_error());
mysql_query("UPDATE p_villages set troops_num='$k1' where id='$villages_id1'") or die(mysql_error());
mysql_query("UPDATE p_villages set is_oasis='1' where id='$villages_id1'") or die(mysql_error());
//Village 2
mysql_query("UPDATE p_villages set is_artefact='1' where id='$villages_id2'") or die(mysql_error());
mysql_query("UPDATE p_villages set artefact_name='1' where id='$villages_id2'") or die(mysql_error());
mysql_query("UPDATE p_villages set type=2 where id='$villages_id2'") or die(mysql_error());
mysql_query("UPDATE p_villages set troops_training='$troops_training' where id='$villages_id2'") or die(mysql_error());
mysql_query("UPDATE p_villages set troops_num='$k2' where id='$villages_id2'") or die(mysql_error());
mysql_query("UPDATE p_villages set is_oasis='1' where id='$villages_id2'") or die(mysql_error());
//Village 3
mysql_query("UPDATE p_villages set is_artefact='1' where id='$villages_id3'") or die(mysql_error());
mysql_query("UPDATE p_villages set artefact_name='2' where id='$villages_id3'") or die(mysql_error());
mysql_query("UPDATE p_villages set type=1 where id='$villages_id3'") or die(mysql_error());
mysql_query("UPDATE p_villages set troops_training='$troops_training' where id='$villages_id3'") or die(mysql_error());
mysql_query("UPDATE p_villages set troops_num='$k1' where id='$villages_id3'") or die(mysql_error());
mysql_query("UPDATE p_villages set is_oasis='1' where id='$villages_id3'") or die(mysql_error());
//Village 4
mysql_query("UPDATE p_villages set is_artefact='1' where id='$villages_id4'") or die(mysql_error());
mysql_query("UPDATE p_villages set artefact_name='2' where id='$villages_id4'") or die(mysql_error());
mysql_query("UPDATE p_villages set type=2 where id='$villages_id4'") or die(mysql_error());
mysql_query("UPDATE p_villages set troops_training='$troops_training' where id='$villages_id4'") or die(mysql_error());
mysql_query("UPDATE p_villages set troops_num='$k2' where id='$villages_id4'") or die(mysql_error());
mysql_query("UPDATE p_villages set is_oasis='1' where id='$villages_id4'") or die(mysql_error());
//Village 5
mysql_query("UPDATE p_villages set is_artefact='1' where id='$villages_id5'") or die(mysql_error());
mysql_query("UPDATE p_villages set artefact_name='3' where id='$villages_id5'") or die(mysql_error());
mysql_query("UPDATE p_villages set type=1 where id='$villages_id5'") or die(mysql_error());
mysql_query("UPDATE p_villages set troops_training='$troops_training' where id='$villages_id5'") or die(mysql_error());
mysql_query("UPDATE p_villages set troops_num='$k1' where id='$villages_id5'") or die(mysql_error());
mysql_query("UPDATE p_villages set is_oasis='1' where id='$villages_id5'") or die(mysql_error());
//Village 6
mysql_query("UPDATE p_villages set is_artefact='1' where id='$villages_id6'") or die(mysql_error());
mysql_query("UPDATE p_villages set artefact_name='3' where id='$villages_id6'") or die(mysql_error());
mysql_query("UPDATE p_villages set type=2 where id='$villages_id6'") or die(mysql_error());
mysql_query("UPDATE p_villages set troops_training='$troops_training' where id='$villages_id6'") or die(mysql_error());
mysql_query("UPDATE p_villages set troops_num='$k2' where id='$villages_id6'") or die(mysql_error());
mysql_query("UPDATE p_villages set is_oasis='1' where id='$villages_id6'") or die(mysql_error());
//Village 7
mysql_query("UPDATE p_villages set is_artefact='1' where id='$villages_id7'") or die(mysql_error());
mysql_query("UPDATE p_villages set artefact_name='4' where id='$villages_id7'") or die(mysql_error());
mysql_query("UPDATE p_villages set type=1 where id='$villages_id7'") or die(mysql_error());
mysql_query("UPDATE p_villages set troops_training='$troops_training' where id='$villages_id7'") or die(mysql_error());
mysql_query("UPDATE p_villages set troops_num='$k1' where id='$villages_id7'") or die(mysql_error());
mysql_query("UPDATE p_villages set is_oasis='1' where id='$villages_id7'") or die(mysql_error());
//Village 8
mysql_query("UPDATE p_villages set is_artefact='1' where id='$villages_id8'") or die(mysql_error());
mysql_query("UPDATE p_villages set artefact_name='4' where id='$villages_id8'") or die(mysql_error());
mysql_query("UPDATE p_villages set type=2 where id='$villages_id8'") or die(mysql_error());
mysql_query("UPDATE p_villages set troops_training='$troops_training' where id='$villages_id8'") or die(mysql_error());
mysql_query("UPDATE p_villages set troops_num='$k2' where id='$villages_id8'") or die(mysql_error());
mysql_query("UPDATE p_villages set is_oasis='1' where id='$villages_id8'") or die(mysql_error());

//Village 9
mysql_query("UPDATE p_villages set is_artefact='1' where id='$villages_id8'") or die(mysql_error());
mysql_query("UPDATE p_villages set artefact_name='5' where id='$villages_id8'") or die(mysql_error());
mysql_query("UPDATE p_villages set type=3 where id='$villages_id8'") or die(mysql_error());
mysql_query("UPDATE p_villages set troops_training='$troops_training' where id='$villages_id8'") or die(mysql_error());
mysql_query("UPDATE p_villages set troops_num='$k2' where id='$villages_id8'") or die(mysql_error());
mysql_query("UPDATE p_villages set is_oasis='1' where id='$villages_id8'") or die(mysql_error());
//UPDATE TO Village -->

//all village
mysql_query("update `p_villages` set image_num = 99 where is_artefact=1");
//End all village
?>
