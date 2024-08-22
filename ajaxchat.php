<?php
/**
* @   PROJECT WAS MADE FOR SMART SERVS
* @   WHATS APP : 00966501494220 
* @   VISIT : WWW.REDSEA-H.COM
* @   ALL COPY RIGHTS RESERVED PROGRAMMED BY RED SEA HOST 
* @   THIS PROJECT WAS MADE BY THE REGISTERED RED SEA HOST UNDER THE NAME OF WWW.REDSEA-H.COM
**/
require(".".DIRECTORY_SEPARATOR."t5rg".DIRECTORY_SEPARATOR."boot.php");
require_once(MODEL_PATH."chat.php");
class GPage  extends securegamepage{

        public $chats = NULL;
        public $Filter = NULL;

        public function GPage(){
                $this->customLogoutAction = TRUE;
                parent::securegamepage();
                if($this->player == NULL ) exit(0);
                $this->layoutViewFile = $this->viewFile = NULL;
                $GLOBALS['_GET']['_a1_'] = "";
    }

    public function load(){
                parent::load();
                $m = new ChatModel();
                $this->chats = $m->GetFromChat();
                $storCtat = array();
                while($this->chats->next()){
                        $storCtat[$this->chats->row['ID']] = array(date("d/m H:i", $this->chats->row['date']),$this->chats->row['username'],$this->chats->row['text'],$this->chats->row['userid']);
                }
                ksort($storCtat);
                foreach($storCtat as $ChatLine){
                        echo '
                        <div class="msgln">
                                <span>' . $ChatLine[2] . '</span> :
                                <b>
                                <a href="profile.php?uid="'. $ChatLine[1] .'" target="_blank">
                                        '. $ChatLine[1] .'
                                </a>
                                </b> 
                                <span style="position: absolute;left:0;top:0;border-bottom: 1px solid green; color: green; font-size: 12px;">'. $ChatLine[0] .'</span>
                                <br>
                        </div>';
                }
                $m->dispose();
        }
}
$p = new GPage();
$p->run();
?>