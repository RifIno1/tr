<?php


require( ".".DIRECTORY_SEPARATOR."t5rg".DIRECTORY_SEPARATOR."boot.php" );
require_once(MODEL_PATH."plus.php");
require_once(MODEL_PATH."payhis.php");
require( APP_PATH."config.php" );
class GPage extends SecureGamePage
{
    var $dataList = null;
    public $packageIndex = -1;
    public $plusTable = NULL;

    public function GPage()
    {
        parent::securegamepage();
        $this->viewFile = "plus.phtml";
        $this->contentCssClass = "plus";
        $this->plusTable = $this->gameMetadata['plusTable'];
        $i = 0;
        $c = sizeof( $this->plusTable );
        while ( $i < $c )
        {
            if ( 0 < $this->plusTable[$i]['time'] )
            {
                $this->plusTable[$i]['time'] = ceil( $this->plusTable[$i]['time'] / $this->gameMetadata['game_speed'] );
            }
            ++$i;
        }
    }

    public function load()
    {
parent::load( );
$this->selectedTabIndex = isset( $_GET['t'] ) && is_numeric( $_GET['t'] ) && 0 <= intval( $_GET['t'] ) && intval( $_GET['t'] ) <= 4 ? intval( $_GET['t'] ) : 0;

                if ( $this->selectedTabIndex == 3 )
        {
            $m = new Puls();  
            $this->dataList = $m->InviteBy($this->player->playerId);
                        $this->dataList2 = $m->InviteByGold($this->player->playerId);
                        while ($this->dataList2->next()) {
            $Id = $this->player->playerId;
            $Id1 = $this->dataList2->row['id'];
            $userid = $m->getPlayerDataById ($Id);
            $last_ip = $userid['last_ip'];
            if($this->dataList2->row['villages_count'] >= 2 && $this->dataList2->row['invite_by'] == $Id && $this->dataList2->row['show_ref'] == 0 && $this->dataList2->row['last_ip'] != $last_ip ){                                                                  
            $m->incrementPlayerGold($Id);
            $m->PlayerRef($Id1);
                        }
                        }
            $m->dispose();
            }
                if ( $this->selectedTabIndex == 4 )
                {
                    if ( $this->isPost() )
                        {
                        $m = new Puls();
                                $playerName = trim( $_POST['name'] );
                                $ifplayer = $m->getPlayerDataByName ($playerName);
                                if ( $ifplayer == NULL ) {
                                $this->errorTable = LANGUI_TRANS_T6;
                                } else {
                                $m = new Puls();
                                $playerdata = $m->getPlayerDataById( $this->player->playerId );
                                $passcon = md5 ( $_POST['pass'] );
                                if ( $playerdata['pwd'] != $passcon ) {
                                $this->errorTable = LANGUI_TRANS_T7;
                                }  else {
                                if ( $playerdata['total_people_count'] < 500) {
                                $this->errorTable = LANGUI_TRANS_T10;
                                } else {
                                $golds = intval( $_POST['gold'] );
                                if ( $golds <= 0 ) {
                                $this->errorTable = LANGUI_TRANS_T8;
                                } else {
                                $gold = $this->data['gold_num'];
                                if ( $gold - $golds <= 999 ) {
                                $this->errorTable = LANGUI_TRANS_T9;
                                } else {
                                $m = new Puls();
                                $m->DeletPlayerGold( $this->player->playerId, $golds );
                                $m->GivePlayerGold( $playerName, $golds );

                                $this->errorTable = LANGUI_TRANS_T12;
                                }
                                }
                                }
                                }
                                }
                        }
        }
                                
        if ( $this->selectedTabIndex == 0 )
        {
            $this->packageIndex = isset( $_GET['id'] ) && is_numeric( $_GET['id'] ) && 0 < intval( $_GET['id'] ) && intval( $_GET['id'] ) <= sizeof( $this->appConfig['plus']['packages'] ) ? intval( $_GET['id'] ) - 1 : 0 - 1;
        }
        else if ( $this->selectedTabIndex == 2 && isset( $_GET['a'], $_GET['k'] ) && $_GET['k'] == $this->data['update_key'] && $this->plusTable[intval( $_GET['a'] )]['cost'] <= $this->data['gold_num'] && !$this->isGameTransientStopped() && !$this->isGameOver() )
        {
            switch ( intval( $_GET['a'] ) )
            {
            case 0 :
            case 1 :
            case 2 :
            case 3 :
            case 4 :
                $taskType = constant( "QS_PLUS".( intval( $_GET['a'] ) + 1 ) );
                $newTask = new QueueTask( $taskType, $this->player->playerId, $this->plusTable[intval( $_GET['a'] )]['time'] * 86400 );
                if ( 0 < intval( $_GET['a'] ) )
                {
                }
                $newTask->villageId = "";
                $newTask->tag = $this->plusTable[intval( $_GET['a'] )]['cost'];
                $this->queueModel->addTask( $newTask );
                break;
            case 5 :
            case 7 :
                $this->queueModel->finishTasks( $this->player->playerId, $this->plusTable[intval( $_GET['a'] )]['cost'], intval( $_GET['a'] ) == 7 );
            }
        }
        $_GET['a'] = 0;
                                     if($_GET['a'] == 7) {
$this->redirect ('village1.php');
return null;

}
if (isset($_GET['backtroops0'])) {
$gback = $GLOBALS['AppConfig']['Game']['plus8'];
$tatarg = new QueueModel();
$vid = $this->data['selected_village_id'];
$gq = 0;
$result = $this->queueModel->provider->fetchResultSet ("SELECT * FROM `p_queue` WHERE to_village_id = '".$vid."' AND proc_type='12'");
$this->queueModel->provider->executeQuery2("UPDATE p_players SET gold_num =gold_num - ".$gback." WHERE id='".$this->player->playerId."'");
$k = 0;
while ($result->next())
{
$k++;
$end = strtotime($result->row['end_date']);
$time = date('Y-m-d G:i:s', strtotime("-144000 seconds"));
echo $end-$time."-";
if ($end-$time <= 30) {
continue;
}else {
$t = (30+(3*$k));
$in_end = date('Y-m-d G:i:s', strtotime("-144000 seconds"));
$this->queueModel->provider->executeQuery( "UPDATE p_queue set end_date='".$in_end."' WHERE id = '".$result->row['id']."'");
echo "ok";
}
}

//start pgold
$tatarzx = new QueueModel();
$d = date('Y/m/d H:i:s');
$n = $this->data['name'];
$tatarzx->provider->executeQuery("INSERT INTO `p_plus` (`pid`, `date`, `gold`, `where`) VALUES ('".$n."', '".$d."', '".$gq."', 'انهاء التعزيزات فوراً');"); 
//end pgold
$this->redirect ('village1.php');
}
    }
	

    public function preRender()
    {
        parent::prerender();
        if ( 0 < $this->selectedTabIndex )
        {
            $this->villagesLinkPostfix .= "&t=".$this->selectedTabIndex;
        }
    }

    public function getRemainingPlusTime( $action )
    {
        $time = 0;
        $tasks = $this->queueModel->tasksInQueue;
        if ( isset( $tasks[constant( "QS_PLUS".( $action + 1 ) )] ) )
        {
            $time = $tasks[constant( "QS_PLUS".( $action + 1 ) )][0]['remainingSeconds'];
        }
        return 0 < $time ? time_remain_lang." <span id=\"timer1\">".WebHelper::secondstostring( $time )."</span> ".time_hour_lang : "";
    }

    public function getPlusAction( $action )
    {
        if ( $this->data['gold_num'] < $this->plusTable[$action]['cost'] )
        {
            return "<span class=\"none\">".plus_text_lowgold."</span>";
        }
        if ( $action == 5 || $action == 7 )
        {
            return "<a href=\"plus.php?t=2&a=".$action."&k=".$this->data['update_key']."\">".plus_text_activatefeature."</a>";
        }
        if ( $action == 6 )
        {
            return $this->hasMarketplace() ? "<a href=\"build.php?bid=17&t=3\">".plus_text_gotomarket."</a>" : "<span class=\"none\">".plus_text_gotomarket."</span>";
        }
        $tasks = $this->queueModel->tasksInQueue;
        return isset( $tasks[constant( "QS_PLUS".( $action + 1 ) )] ) ? "<a href=\"plus.php?t=2&a=".$action."&k=".$this->data['update_key']."\">".plus_text_extendfeature."</a>" : "<a href=\"plus.php?t=2&a=".$action."&k=".$this->data['update_key']."\">".plus_text_activatefeature."</a>";
    }

    public function hasMarketplace()
    {
        $b_arr = explode( ",", $this->data['buildings'] );
        foreach ( $b_arr as $b_str )
        {
            $b2 = explode( " ", $b_str );
            if ( !( $b2[0] == 17 ) )
            {
                continue;
            }
            return TRUE;
        }
        return FALSE;
    }

}

$p = new GPage();
$p->run();
?>