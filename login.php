<?php

require(".".DIRECTORY_SEPARATOR."t5rg".DIRECTORY_SEPARATOR."boot.php");
require_once(MODEL_PATH."index.php");
require_once(MODEL_PATH."advertising.php");
class GPage extends DefaultPage{

        public $data = NULL;
        public $error = NULL;
        public $errorState = -1;
        public $name = NULL;
        public $password = NULL;
        public $banner = array();
        public $contentCssClass = "login";
        public $err = array(
                0 => "",
                1 => "",
                2 => "",
                3 => "",
                4 => "",
                5 => ""
        );

        public function GPage(){
                parent::defaultpage();
                $this->viewFile = "login.phtml";
                $this->layoutViewFile = "layout".DIRECTORY_SEPARATOR."form.phtml";
        }

        public function load(){
                $cookie = ClientData::getinstance();
                $m = new IndexModel();
                $bannerModel = new AdvertisingModel();
                $this->banner = $bannerModel->GetBanner(1);
                $this->data = $m->getIndexSummary();
                if($this->isPost()){
                session_start();
                        if(!isset($_POST['name']) || trim($_POST['name'] ) == ""){
                                 $this->err[0] = login_result_msg_noname;

                        }
                        else{
                                $this->name = trim($_POST['name']);
                                if(!isset($_POST['password'] ) || $_POST['password'] == ""){
                                 $this->err[1] = login_result_msg_nopwd;
                                }
                                else{
                                        $this->password = $_POST['password'];
                                        $result = $m->getLoginResult($this->name, $this->password, WebHelper::getclientip());
                                        if($result == NULL){
                                               $this->err[0] = login_result_msg_notexists.' <a href="register.php">>الـتسجـيل<</a>';
}
                                        elseif($result['hasError']){
                                 $this->err[1] = login_result_msg_wrongpwd;

       $this->setError($m, '<p class="error_box"><span class="error">نسيت كلمة السر؟</span><br />
                فضلاً أدخل بريدك الإلكتروني لكي نرسل لك كلمة سر جديدة.<br />
                <a href="password.php?id='.$result['playerId'].'">إنشاء كلمة سر جديدة!</a>
        </p>',2);
                                        }
                                        elseif(!$result['data']['is_active']){
                                        $this->err[0] = login_result_msg_notactive;
                                        $this->setError($m, '<p class="error_box"><span class="error">لم يتم تفعيل العضوية الى الان؟</span><br />
                فضلاً لم تفعل عضويتك الى الان اضغط على !.<br />
                <a href="activate.php?uid='.$result['playerId'].'" style="color: #red;">المشاكل الممكنه والحلول ؟!</a>
        </p>');
                                        }
                                        else{
                                                $this->player = new Player();
                                                $this->player->playerId = $result['playerId'];
                                                $this->player->isAgent = $result['data']['is_agent'];
                                                $this->player->gameStatus = $result['gameStatus'];
                                                $this->player->save();
                                                $cookie->uname = $this->name;
                                                $cookie->upwd = $this->password;
                                                $cookie->save();
                                                $m->dispose();
                                                $this->redirect("village1.php");


         }
                                }
                        }
                }
                else{
                        if(isset($_GET['dcookie'])){
                                $cookie->clear();
                        }
                        else{
                                $this->name = $cookie->uname;
                                $this->password = $cookie->upwd;
                        }
                        $m->dispose();
                }
        }

        public function setError($m, $errorMessage, $errorState = -1){
                $this->error = $errorMessage;
                $this->errorState = $errorState;
                $m->dispose();
        }
}
$p = new GPage();
$p->run();
