<?php
//\\//\\//\\//\\//\\//\\//\\//\\
//Bazaid Invision Power Board //
//\\//\\//\\//\\//\\//\\//\\//\\

require_once("app/config.php");

$link = mysql_connect($AppConfig['db']['host'],$AppConfig['db']['user'],$AppConfig['db']['password']) or die(mysql_error());
mysql_select_db($AppConfig['db']['database'],$link) or die(mysql_error());

//activate

mysql_query("update `p_players` set `is_active` = '1';");


echo '<p align="center"><font color="blue" size="5">��� �� ����� ����� ����� .. ����� ���� ������ ����� ������</font></p>';
echo '<p align="center">&nbsp;</p>';
echo '<p align="center"><b><font color="red"><a rel="nofollow" target="_blank" href="http://www.albadani.net">
<span style="text-decoration: none" lang="ar-eg"><font color="#FF0000">���� ������ ������ 
</font></span><font color="#FF0000"><span style="text-decoration: none">�<span lang="ar-eg"> 
�</span></span></font><span lang="ar-eg" style="text-decoration: none"><font color="#FF0000">����� ���� ��� ��������</font></span></a></font></b></p>';
echo '<p align="center">&nbsp;</p>';
echo '<p align="center">&nbsp;</p>';
echo '<p class="f16" align="center">
<a href="index.php"><font size="4" color="green">
<span style="text-decoration: none">� �� ������� �������� ���� ���� ���� ������ ��������</span></font></a></p>';
echo "<META HTTP-EQUIV='refresh' CONTENT='1; URL=index.php'>";

?>