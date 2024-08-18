<?php 
include("t5rg/config.php"); 
$link = mysql_connect($AppConfig['db']['host'],$AppConfig['db']['user'],$AppConfig['db']['password']) or die(mysql_error()); 
mysql_select_db($AppConfig['db']['database'],$link) or die(mysql_error()); 

if ($link) 
{echo "تمام  يا معلم";} 
else 
{echo "فشل الاتصال";}; 

$sbktres= mysql_query("DELETE FROM  `p_queue` WHERE  `p_queue`.`proc_type` =1"); 

echo "<br>"; 

if ($sbktres) 
{echo "ياعسل هههه تم الغاء حذف جميع الاعبين";} 
else 
{echo "لم يتم الغاء حذف الاعبين";}; 

?>