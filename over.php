<?php


require( ".".DIRECTORY_SEPARATOR."t5rg".DIRECTORY_SEPARATOR."boot.php" );
require_once( MODEL_PATH."over.php" );
class GPage extends gamepage
{

    public $playerData = NULL;

    public function GPage( )
    {
        parent::gamepage( );
        $this->viewFile = "over.phtml";
        $this->contentCssClass = "messages";
    }

    public function load( )
    {
        parent::load( );
        if ( !$this->globalModel->isGameOver( ) )
        {
            exit( 0 );
        }
        else
        {
            $m = new OverGameModel( );
            $this->playerData = $m->getWinnerPlayer( );
            $this->Wine = $m->getWine( );
            $this->TopOff = $m->getTopsAttacker( );
            $this->TopDef = $m->getTopsDeffer( );
            $this->TopPop = $m->getTopsPop( );
            $m->dispose( );
        }
    }

}


$p = new GPage( );
$p->run( );
?>
