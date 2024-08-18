<?php


require( ".".DIRECTORY_SEPARATOR."t5rg".DIRECTORY_SEPARATOR."boot.php" );
require_once( MODEL_PATH."news.php" );
class GPage extends SecureGamePage
{

    public $saved = NULL;
    public $siteNews = NULL;

    public function GPage()
    {
        parent::securegamepage();
        $this->layoutViewFile = "layout".DIRECTORY_SEPARATOR."form.phtml";
        $this->viewFile = "shownew.phtml";
        $this->contentCssClass = "messages";
        $this->checkForGlobalMessage = FALSE;
        $this->checkForNewVillage = FALSE;
    }

    public function load()
    {
        parent::load();
        if ( intval( $this->data['new_gnews'] ) == 0 || $this->player->isSpy )
        {
            $this->redirect( "village1.php" );
        }
        else
        {
            $m = new NewsModel();
            $this->siteNews = $m->getGlobalSiteNews();
            $m->dispose();
        }
    }

}

$p = new GPage();
$p->run();
?>
