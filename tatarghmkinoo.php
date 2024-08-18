<?php 

/************************************/ 
/*                                  */ 
/*  Made by: Mohammed Ali Albadani  */ 
/*  website: www.albadani.net       */ 
/*  Aug 2012   all right reserved   */ 
/*                                  */ 
/************************************/ 


include('./t5rg/config.php'); 

//$name="Mzra3a";//"U…?²?±?¹?&copy;";//مزرعة 
$pwd="e10adc3949ba59abbe56e057f20f883e";//password=123456 
$player_type=1; 
$registration_date="2012-08-23 23:00:02"; 
$total_people_count=48; 

$db_connect = mysql_connect($AppConfig['db']['host'],$AppConfig['db']['user'],$AppConfig['db']['password']); 
mysql_select_db($AppConfig['db']['database'], $db_connect); 

//الشمال الشرقي 
$iii=0; 
for($ii=1; $ii<=3 ; $ii++) 
{ 
    $iii=$iii+2402; 
for ($i=1; $i<=1; $i++) 
{ 
//تحديد عدد الاعضاء المسجلين 
$count_sql = 'SELECT * FROM p_players'; 
$count_result = mysql_query($count_sql);  
$count = mysql_num_rows($count_result); 


$name="10"; 
$name=$name."".$count; 

//تحديد رقم العضوية الجديدة 
$player_id== mysql_query("select max(id) from p_players ");//$count; 
$player_id=$player_id+1; 
 $villages_id1=($i*2)+4+$iii; 
  $resources1="1 9999 9900 9900 18000 99,2 9999 9900 9900 18000 99,3 9999 9900 9900 18000 99,4 9999 9900 3500 99000 99"; 
  
          //Be sure Is this village or ossiss 
     $beSure=mysql_query("SELECT field_maps_id FROM p_villages where id='$villages_id1'"); 
 if  ($beSure=3){ 
 //تحديث بيانات القرية 
 mysql_query("UPDATE p_villages set tribe_id='3' where id='$villages_id1'") or die(mysql_error()); 
 mysql_query("UPDATE p_villages set player_id='$player_id' where id='$villages_id1'") or die(mysql_error()); 
 mysql_query("UPDATE p_villages set player_name='$name' where id='$villages_id1'") or die(mysql_error()); 
 mysql_query("UPDATE p_villages set village_name='$name' where id='$villages_id1'") or die(mysql_error()); 
 mysql_query("UPDATE p_villages set is_capital='1' where id='$villages_id1'") or die(mysql_error()); 
 mysql_query("UPDATE p_villages set people_count='78' where id='$villages_id1'") or die(mysql_error()); 
 mysql_query("UPDATE p_villages set resources='$resources1' where id='$villages_id1'") or die(mysql_error()); 

//تحديث بيانات عدد اللاعبين 
 mysql_query("UPDATE g_summary set players_count=$count") or die(mysql_error()); 

  
 $xx= ("SELECT rel_x FROM p_villages where id='$villages_id1'"); 
 $yyy= ("SELECT rel_y FROM p_villages where id='$villages_id1'"); 
 $villages_data2=$villages_id1." ".$xx." ".$yy." ".$name; 
  
  
 //اضافة العضوية الجديدة 
 mysql_query("insert into  p_players set name='$name' , pwd='$pwd', tribe_id='3',is_active='1',is_blocked='0',total_people_count='78',villages_count='1',player_type='1',registration_date='$registration_date',villages_id='$villages_id1'") or die(mysql_error());//,villages_data=$villages_data2 

} 
} 
} 

//الشمال الغربي 

$iii=0; 
for($ii=1; $ii<=3 ; $ii++) 
{ 
    $iii=$iii+2402; 
for ($i=1; $i<=10; $i++) 
{ 
//تحديد عدد الاعضاء المسجلين 
$count_sql = 'SELECT * FROM p_players'; 
$count_result = mysql_query($count_sql);  
$count = mysql_num_rows($count_result); 


$name="20"; 
$name=$name."".$count; 

//تحديد رقم العضوية الجديدة 
$player_id== mysql_query("select max(id) from p_players ");//$count; 
$player_id=$player_id+1; 
 $villages_id1=($i*2)+633593+$iii; 
  $resources1="1 9999 9900 9900 18000 99,2 9999 9900 9900 18000 99,3 9999 9900 9900 18000 99,4 9999 9900 3500 99000 99"; 
  
          //Be sure Is this village or ossiss 
     $beSure=mysql_query("SELECT field_maps_id FROM p_villages where id='$villages_id1'"); 
 if  ($beSure=3){ 
 //تحديث بيانات القرية 
 mysql_query("UPDATE p_villages set tribe_id='3' where id='$villages_id1'") or die(mysql_error()); 
 mysql_query("UPDATE p_villages set player_id='$player_id' where id='$villages_id1'") or die(mysql_error()); 
 mysql_query("UPDATE p_villages set player_name='$name' where id='$villages_id1'") or die(mysql_error()); 
 mysql_query("UPDATE p_villages set village_name='$name' where id='$villages_id1'") or die(mysql_error()); 
 mysql_query("UPDATE p_villages set is_capital='1' where id='$villages_id1'") or die(mysql_error()); 
 mysql_query("UPDATE p_villages set people_count='78' where id='$villages_id1'") or die(mysql_error()); 
 mysql_query("UPDATE p_villages set resources='$resources1' where id='$villages_id1'") or die(mysql_error()); 

//تحديث بيانات عدد اللاعبين 
 mysql_query("UPDATE g_summary set players_count=$count") or die(mysql_error()); 

  
 $xx= ("SELECT rel_x FROM p_villages where id='$villages_id1'"); 
 $yyy= ("SELECT rel_y FROM p_villages where id='$villages_id1'"); 
 $villages_data2=$villages_id1." ".$xx." ".$yy." ".$name; 
  
  
 //اضافة العضوية الجديدة 
 mysql_query("insert into  p_players set name='$name' , pwd='$pwd', tribe_id='3',is_active='1',is_blocked='0',total_people_count='78',villages_count='1',player_type='1',registration_date='$registration_date',villages_id='$villages_id1'") or die(mysql_error());//,villages_data=$villages_data2 

} 
} 
} 



//الجنوب الشرقي 

$iii=0; 
for($ii=1; $ii<=3 ; $ii++) 
{ 
    $iii=$iii+2402; 
for ($i=1; $i<=10; $i++) 
{ 
//تحديد عدد الاعضاء المسجلين 
$count_sql = 'SELECT * FROM p_players'; 
$count_result = mysql_query($count_sql);  
$count = mysql_num_rows($count_result); 


$name="30"; 
$name=$name."".$count; 

//تحديد رقم العضوية الجديدة 
$player_id== mysql_query("select max(id) from p_players ");//$count; 
$player_id=$player_id+1; 
 $villages_id1=($i*2)+2376+$iii; 
  $resources1="1 9999 9900 9900 18000 99,2 9999 9900 9900 18000 99,3 9999 9900 9900 18000 99,4 9999 9900 3500 99000 99"; 
  
          //Be sure Is this village or ossiss 
     $beSure=mysql_query("SELECT field_maps_id FROM p_villages where id='$villages_id1'"); 
 if  ($beSure=3){ 
 //تحديث بيانات القرية 
 mysql_query("UPDATE p_villages set tribe_id='3' where id='$villages_id1'") or die(mysql_error()); 
 mysql_query("UPDATE p_villages set player_id='$player_id' where id='$villages_id1'") or die(mysql_error()); 
 mysql_query("UPDATE p_villages set player_name='$name' where id='$villages_id1'") or die(mysql_error()); 
 mysql_query("UPDATE p_villages set village_name='$name' where id='$villages_id1'") or die(mysql_error()); 
 mysql_query("UPDATE p_villages set is_capital='1' where id='$villages_id1'") or die(mysql_error()); 
 mysql_query("UPDATE p_villages set people_count='78' where id='$villages_id1'") or die(mysql_error()); 
 mysql_query("UPDATE p_villages set resources='$resources1' where id='$villages_id1'") or die(mysql_error()); 

//تحديث بيانات عدد اللاعبين 
 mysql_query("UPDATE g_summary set players_count=$count") or die(mysql_error()); 

  
 $xx= ("SELECT rel_x FROM p_villages where id='$villages_id1'"); 
 $yyy= ("SELECT rel_y FROM p_villages where id='$villages_id1'"); 
 $villages_data2=$villages_id1." ".$xx." ".$yy." ".$name; 
  
  
 //اضافة العضوية الجديدة 
 mysql_query("insert into  p_players set name='$name' , pwd='$pwd', tribe_id='3',is_active='1',is_blocked='0',total_people_count='78',villages_count='1',player_type='1',registration_date='$registration_date',villages_id='$villages_id1'") or die(mysql_error());//,villages_data=$villages_data2 

} 
} 
} 

//الجنوب الغربي 

$iii=0; 
for($ii=1; $ii<=3 ; $ii++) 
{ 
    $iii=$iii+2402; 
for ($i=1; $i<=10; $i++) 
{ 
//تحديد عدد الاعضاء المسجلين 
$count_sql = 'SELECT * FROM p_players'; 
$count_result = mysql_query($count_sql);  
$count = mysql_num_rows($count_result); 


$name="40"; 
$name=$name."".$count; 

//تحديد رقم العضوية الجديدة 
$player_id== mysql_query("select max(id) from p_players ");//$count; 
$player_id=$player_id+1; 
 $villages_id1=($i*2)+631161+$iii; 
 $resources1="1 9999 9900 9900 18000 99,2 9999 9900 9900 18000 99,3 9999 9900 9900 18000 99,4 9999 9900 3500 99000 99"; 
      
         //Be sure Is this village or ossiss 
     $beSure=mysql_query("SELECT field_maps_id FROM p_villages where id='$villages_id1'"); 
 if  ($beSure=3){ 
  
 //تحديث بيانات القرية 
 mysql_query("UPDATE p_villages set tribe_id='3' where id='$villages_id1'") or die(mysql_error()); 
 mysql_query("UPDATE p_villages set player_id='$player_id' where id='$villages_id1'") or die(mysql_error()); 
 mysql_query("UPDATE p_villages set player_name='$name' where id='$villages_id1'") or die(mysql_error()); 
 mysql_query("UPDATE p_villages set village_name='$name' where id='$villages_id1'") or die(mysql_error()); 
 mysql_query("UPDATE p_villages set is_capital='1' where id='$villages_id1'") or die(mysql_error()); 
 mysql_query("UPDATE p_villages set people_count='78' where id='$villages_id1'") or die(mysql_error()); 
 mysql_query("UPDATE p_villages set resources='$resources1' where id='$villages_id1'") or die(mysql_error()); 

//تحديث بيانات عدد اللاعبين 
 mysql_query("UPDATE g_summary set players_count=$count") or die(mysql_error()); 

  
 $xx= mysql_query("SELECT rel_x FROM p_villages where id='$villages_id1'"); 
 $yyy= mysql_query("SELECT rel_y FROM p_villages where id='$villages_id1'"); 
 $villages_data2=$villages_id1." ".$xx." ".$yy." ".$name; 
  
  
 //اضافة العضوية الجديدة 
 mysql_query("insert into  p_players set name='$name' , pwd='$pwd', tribe_id='3',is_active='1',is_blocked='0',total_people_count='78',villages_count='1',player_type='1',registration_date='$registration_date',villages_id='$villages_id1',villages_data=$villages_data2") or die(mysql_error());// 
 } 
  
} 
} 



echo "<META HTTP-EQUIV='refresh' CONTENT='1; URL=village1.php'>"; 



?>