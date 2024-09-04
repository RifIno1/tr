<?php
require(".".DIRECTORY_SEPARATOR."t5rg".DIRECTORY_SEPARATOR."boot.php");
class GPage extends securegamepage{

        public $chats = NULL;
        public $Filter = NULL;

        public function GPage(){
                parent::securegamepage();
                $this->viewFile = "buy_cp.phtml";
                $this->contentCssClass = "player";
        }

        public function load(){
                parent::load();
               
        }
}
$p = new GPage();
$p->run();
?>