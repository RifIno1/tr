<?php
require( ".".DIRECTORY_SEPARATOR."t5rg".DIRECTORY_SEPARATOR."boot.php" );
class GPage extends ProcessVillagePage{

	public $troops = array();
	public $heroCount = 0;

	public function GPage(){
		parent::processvillagepage( );
		$this->viewFile = "crop_finder.phtml";
		$this->contentCssClass = "forum";
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

    public function load( )
    {
        parent::load( );
        $this->selectedTabIndex = isset( $_GET['t'] ) && is_numeric( $_GET['t'] ) && 0 <= intval( $_GET['t'] ) && intval( $_GET['t'] ) <= 3 ? intval( $_GET['t'] ) : 0;
        if ( $this->selectedTabIndex == 0 )
        {
            $this->packageIndex = isset( $_GET['id'] ) && is_numeric( $_GET['id'] ) && 0 < intval( $_GET['id'] ) && intval( $_GET['id'] ) <= sizeof( $this->appConfig['plus']['packages'] ) ? intval( $_GET['id'] ) - 1 : 0 - 1;
        }
        else if ( $this->selectedTabIndex == 2 && isset( $_GET['a'], $_GET['k'] ) && $_GET['k'] == $this->data['update_key'] && $this->plusTable[intval( $_GET['a'] )]['cost'] <= $this->data['gold_num'] && !$this->isGameTransientStopped( ) && !$this->isGameOver( ) )
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
        }else if ( $this->selectedTabIndex == 3 )
        {
            
            

            
        }
    }


}

$p = new GPage( );
$p->run( );
?>
