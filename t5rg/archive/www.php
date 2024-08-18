<?php
require_once( LANG_UI_PATH."index.php" );
if ( $this->errorState == 1 )
{
    echo "";
}

?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title><?php echo $this->appConfig['page'][$this->appConfig['system']['lang']."_title"]; ?></title>
	<meta http-equiv="cache-control" content="max-age=0" />
	<meta http-equiv="pragma" content="no-cache" />
	<meta http-equiv="expires" content="0" />
	<meta http-equiv="imagetoolbar" content="no" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="content-script-type" content="text/javascript" />
<meta http-equiv="content-style-type" content="text/css" />
	<meta content="" name="description">
	<meta content="" name="keywords">
	<link href="assets/default/lang/<?php echo $this->appConfig['system']['lang']; ?>/lang.css" rel="stylesheet" type="text/css" />
	<link href="assets/default/lang/<?php echo $this->appConfig['system']['lang']; ?>/compact.css" rel="stylesheet" type="text/css" />
	<link rel="shortcut icon" href="assets/favicon.ico" type="image/x-icon" />
	<script type="text/javascript">var d3l=180;</script>

	<script src="assets/core.js?c4b7aaaadef" type="text/javascript"></script>
</head>
<body class="v35 webkit">
<div class="wrapper">
<img src="assets/x.gif" id="msfilter" alt="" />
<div id="dynamic_header">
</div>

<div id="header">
	<div id="mtop">
		<div class="clear"></div>
	</div>
</div>

<div id="mid">
	<div id="side_navi">
		<a id="logo" href="#"><img  src="assets/x.gif" alt="<?php echo LANGUI_INDX_T1; ?>" /></a>
		<p>
			<a href="#"><?php echo LANGUI_INDX_T2; ?></a>
			<a href="#" onclick="return showManual(0,0);"><?php echo LANGUI_INDX_T3; ?></a>
			<a href="login.php"><?php echo LANGUI_INDX_T4; ?></a>
			<a href="register.php"><?php echo LANGUI_INDX_T5; ?></a>

		</p>
	</div>
	<div id="content" class="logout"><br><center><h1>
		<img alt="<?php echo LANGUI_INDX_T6; ?>" height="60" src="assets/default/lang/<?php echo $this->appConfig['system']['lang']; ?>/t1/login.gif" width="468"></h1></center><br>


		<p><img alt="" src="assets/default/lang/<?php echo $this->appConfig['system']['lang']; ?>/t2/u04.gif"></p>
		<p><?php echo LANGUI_INDX_T9; ?></p>
	<div style="border:1px dashed #C2C2C2;width:500px;margin-top:20px;margin-bottom:10px;padding-top:8px;padding-bottom:8px;">
<form action="login.php" method="post" name="login">
<table cellspacing="0" cellpadding="0">
<font color="#FF0000">&#1576;&#1602;&#1610; &#1604;&#1600; &#1575;&#1601;&#1578;&#1578;&#1570;&#1581; &#1575;&#1604;&#1587;&#1610;&#1585;&#1601;&#1585;
</font></font><br />
</form></body>
</html>

<html>
<head>
<script language="JavaScript">

TargetDate = "7/31/2013 5:22 PM UTC+0400";
DisplayFormat = "%%D%% &#1610;&#1608;&#1605;, %%H%% &#1587;&#1575;&#1593;&#1607;, %%M%% &#1583;&#1602;&#1610;&#1602;&#1607;, %%S%% &#1579;&#1575;&#1606;&#1610;&#1607;";
CountStepper = -1;
LeadingZero = true;
FinishMessage = "It is finally here!";

function calcage(secs, num1, num2) {
  s = ((Math.floor(secs/num1))%num2).toString();
  if (LeadingZero && s.length < 2)
    s = "0" + s;
  return "<b>" + s + "</b>";
}

function CountBack(secs) {
  if (secs < 0) {
    document.getElementById('countbox').innerHTML = FinishMessage;
    return;
  }
  DisplayStr = DisplayFormat.replace(/%%D%%/g, calcage(secs,86400,100000));
  DisplayStr = DisplayStr.replace(/%%H%%/g, calcage(secs,3600,24));
  DisplayStr = DisplayStr.replace(/%%M%%/g, calcage(secs,60,60));
  DisplayStr = DisplayStr.replace(/%%S%%/g, calcage(secs,1,60));

  document.getElementById('countbox').innerHTML = DisplayStr;
  if (CountActive)
    setTimeout("CountBack(" + (secs+CountStepper) + ")", SetTimeOutPeriod);
}
var CountActive=1;
if (CountStepper == 0)
  CountActive = false;
  
if (CountStepper == 0)
  CountActive = false;
var SetTimeOutPeriod = (Math.abs(CountStepper)-1)*1000 + 990;
var dthen = new Date(TargetDate);
var dnow = new Date();
if(CountStepper>0)
  ddiff = new Date(dnow-dthen);
else
  ddiff = new Date(dthen-dnow);
gsecs = Math.floor(ddiff.valueOf()/1000);


</script>
</head>
<body onload="CountBack(gsecs)">
<div id="countbox"></div>
</body>
</html>



	<div class="shadow right">
	</div>
	</table>
	</div>

<p class="btn">
<input id="btn_login" class="dynamic_img" type="image" alt="LANGUI_INDX_T3" src="assets/x.gif" name="s1" value="anmelden">
</p>
   <?php
					   if ( $this->errorState == 2 )
					   {
					   	echo "";
					   }
					   ?>
					   	 <?php
					 if ( $this->error != "" )
					 {
					 	echo "<div style=\"color:orange;padding:2px;width:135px;font-size:14px;margin-right:215px\">".$this->error."</div>";
					 }

					 ?>

	<div style="border:1px dashed #C2C2C2;width:500px;margin-top:20px;margin-bottom:10px;padding-top:8px;padding-bottom:8px;">
<form action="login.php" method="post" name="login">
<table cellspacing="0" cellpadding="0">
			<tr>
<?php
echo '<span style="font-family: tahoma, geneva, sans-serif; ">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &#1593;&#1583;&#1583; &#1575;&#1604;&#1604;&#1575;&#1593;&#1576;&#1610;&#1606; &nbsp;: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span>';
echo $this->data['players_count'];
echo '<br><span style="font-family: tahoma, geneva, sans-serif; ">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span><span style="font-family: tahoma, geneva, sans-serif; ">&#1593;&#1583;&#1583; &#1575;&#1604;&#1606;&#1588;&#1591;&#1608;&#1606; &nbsp;: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span>';
echo $this->data['players_count'];
echo '<br><span style="font-family: tahoma, geneva, sans-serif; ">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span><span style="font-family: tahoma, geneva, sans-serif; ">&#1593;&#1583;&#1583; &#1575;&#1604;&#1605;&#1578;&#1608;&#1575;&#1580;&#1583;&#1610;&#1606; &nbsp;: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span>';
echo $this->data['online_players_count']+15;
?>
			</tr>
	<br></div>
<div class="action">
	<div class="shadow right">
	</div>
	</table>
	</div>
</div>
</form>
</div>
	<div id="side_info">
	<h2 style="font-family:arial; color: #662504;margin-top:20px;">&#1575;&#1582;&#1585; &#1575;&#1604;&#1575;&#1582;&#1576;&#1575;&#1585;</h2>
	<p style="border:1px dashed #C2C2C2;padding:5px;">
        <?php echo $this->data['news_text']; ?>
        </p>
<center>
	<p><b>&#1575;&#1604;&#1578;&#1587;&#1580;&#1610;&#1604; &#1575;&#1604;&#1587;&#1585;&#1610;&#1593;</b></p>
	<form method="post" action="register.php">
		<table cellpadding="1" cellspacing="1" id="sign_input">
			<tbody>
				<tr class="top">
					<th>&#1575;&#1587;&#1605; &#1575;&#1604;&#1605;&#1587;&#1578;&#1582;&#1583;&#1605;</th>
					<td>
						<input class="text" type="text" name="name" value="" maxlength="15" /> 
					</td> 
				</tr>
				<tr>
					<th>&#1575;&#1604;&#1576;&#1585;&#1610;&#1583; &#1575;&#1604;&#1575;&#1603;&#1578;&#1585;&#1608;&#1606;&#1610; </th>
					<td>
						<input class="text" type="text" name="email" value="" maxlength="40" /> 

					</td>
				</tr>
				<tr class="btm">
					<th>&#1603;&#1604;&#1605;&#1577; &#1575;&#1604;&#1605;&#1585;&#1608;&#1585; </th>
					<td>
						<input class="text" type="password" name="pwd" value="" maxlength="20" />

					</td>
				</tr>
				</tr>
			</tbody>
		</table>
		<table cellpadding="1" cellspacing="1" id="sign_select"> 
			<tbody>
				<tr class="top">
					<th><img src="assets/x.gif" class="img_u06" alt="'.LANGUI_REG_T9.'"></th>
					<th colspan="2"><img src="assets/x.gif" class="img_u07" alt="'.LANGUI_REG_T10.'"></th>
				</tr>
				<tr>
				<br>
				&#1575;&#1582;&#1578;&#1610;&#1575;&#1585; &#1575;&#1604;&#1602;&#1576;&#1610;&#1604;&#1577; :
					<td class="nat">
						<label><input class="radio" type="radio" name="tid" value="2" '.((isset($_POST['tid']) && $_POST['tid'] == 2)?'checked="checked"':'').'>&nbsp; &#1575;&#1604;&#1580;&#1585;&#1605;&#1575;&#1606;</label>
						<td class="nat">
							<label><input class="radio" type="radio" name="tid" value="3" '.((isset($_POST['tid']) && $_POST['tid'] == 3)?'checked="checked"':'').'>&nbsp; &#1575;&#1604;&#1573;&#1594;&#1585;&#1610;&#1602;</label>
											<td>
							<label><input class="radio" type="radio" name="tid" value="1" '.((isset($_POST['tid']) && $_POST['tid'] == 1)?'checked="checked"':'').'>&nbsp; &#1575;&#1604;&#1585;&#1608;&#1605;&#1575;&#1606;</label>
						</td>
					</tr>
					<tr>

					
					</td>
					
					<td class="pos1">
					<br>
				
					&#1575;&#1582;&#1578;&#1610;&#1575;&#1585; &#1605;&#1608;&#1602;&#1593; &#1575;&#1604;&#1575;&#1576;&#1578;&#1583;&#1575;&#1569; :
					<br>
						<label><input class="radio" type="radio" name="kid" value="0" '.((!isset($_POST['kid']) || $_POST['kid'] == 0)?'checked="checked"':'').'">&nbsp;&#1593;&#1588;&#1608;&#1575;&#1574;&#1610;</label>
					</td>
					<td class="pos2">&nbsp;</td>
				</tr>
				<tr>

					</td>
					<td>
						<label><input class="radio" type="radio" name="kid" value="1" '.((isset($_POST['kid']) && $_POST['kid'] == 1)?'checked="checked"':'').'">&nbsp;&#1588;&#1605;&#1575;&#1604; &#1594;&#1585;&#1576;&#1610;</label>
					</td>
					<td>
						<label><input class="radio" type="radio" name="kid" value="2" '.((isset($_POST['kid']) && $_POST['kid'] == 2 )?'checked="checked"':'').'>&nbsp; &#1588;&#1605;&#1575;&#1604; &#1588;&#1585;&#1602;&#1610;</label>
					</td>
				</tr>
				<tr>

					</td>
						<td>
							<label><input class="radio" type="radio" name="kid" value="3" '.((isset($_POST['kid']) && $_POST['kid'] == 3)?'checked="checked"':'').'>&nbsp; &#1580;&#1606;&#1608;&#1576; &#1594;&#1585;&#1576;&#1610;</label>
						</td>
						<td>
							<label><input class="radio" type="radio" name="kid" value="4" '.((isset($_POST['kid']) && $_POST['kid'] == 4)?'checked="checked"':'').'>&nbsp; &#1580;&#1606;&#1608;&#1576; &#1588;&#1585;&#1602;&#1610;</label>
						<td>

						</td>
						<td rowspan="2"></td>
					</tr>
					<tr class="btm">
						<td>

						</td>
						<td rowspan="2"></td>
					</tr>
				</tbody>
			</table>
			<ul class="important"></ul> <p class="btn"><input type="image" value="anmelden" name="s1" id="btn_signup" class="dynamic_img" src="assets/x.gif" alt="'.LANGUI_REG_T16.'" /></p>
		</form>
		

		</div>

<div id="footer">
	<div id="mfoot"><div class="footer-menu"><ul class="menu menu2" style="float:right;">
	<li><a href="manual.php" title="<?php echo LANGUI_INDX_T13; ?>"><?php echo LANGUI_INDX_T13; ?></a></li>
	<li><a href="training.php" title="<?php echo LANGUI_INDX_T14; ?>"><?php echo LANGUI_INDX_T14; ?></a></li>

	<li><a href="#" target="_blank"><?php echo LANGUI_INDX_T15; ?></a></li>
</ul>
</div></div>
    <div id="cfoot"></div>
</div>
</div>
<div id="ce"></div>
</body>
<script type="text/javascript">init();</script>
</html>