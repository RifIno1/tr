<?php

require(".".DIRECTORY_SEPARATOR."t5rg".DIRECTORY_SEPARATOR."boot.php");
//$block = 1;
//require_once(MODEL_PATH."adcp.php");
class GPage extends SecureGamePage
{

        function GPage(){
                parent::securegamepage();
                $this->viewFile = "banned.phtml";
                $this->contentCssClass = "messages";
                $this->Playerblocked = FALSE;
        }
        function load()
                {
           parent::load();
    /*    if ( $this->data['blocked_time'] < time() )
    {
           $this->redirect('village1.php');
    } */
    
        }
}
$p = new GPage();
$p->run();
?>
