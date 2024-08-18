<?php
	if(!isset($_GET['s'])) {
	$_GET['s'] = ""; }
	if ($_GET['s'] == "") {
	include("Tutorial/1.php"); }
	if ($_GET['s'] == "1") {
	include("Tutorial/1.php"); }
	if ($_GET['s'] == "2") {
	include("Tutorial/2.php"); }
	if ($_GET['s'] == "3") {
	include("/Tutorial/3.php"); }
	if ($_GET['s'] == "4") {
	include("Tutorial/4.php"); }
	if ($_GET['s'] == "5") {
	include("Tutorial/5.php"); }
?>