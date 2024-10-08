<?php


require( ".".DIRECTORY_SEPARATOR."t5rg".DIRECTORY_SEPARATOR."boot.php" );
require_once( MODEL_PATH."register.php" );
require_once(MODEL_PATH."advertising.php");
class GPage extends GamePage
{
    public $banner = array();
    public $err = array
    (
        0 => "",
        1 => "",
        2 => "",
        3 => "",
        4 => "",
        5 => ""
    );
    public $success = NULL;
    public $SNdata = NULL;
    public $UserID = 0;

    public function GPage( )
    {
        parent::gamepage( );
        $this->viewFile = "register.phtml";
        $this->contentCssClass = "signup";
    }

    public function load( )
    {
        parent::load( );
        $this->SNdata = 0;
        $bannerModel = new AdvertisingModel();
        $this->banner = $bannerModel->GetBanner(1);
        $this->success = FALSE;

        if ( $this->isPost( ) )
        {
            if ( $this->globalModel->isGameOver( ) )
            {
                $this->redirect( "over.php" );
            }
            else
            {
                $name = trim( $_POST['name'] );
                $email = trim( $_POST['email'] );
                $pwd = trim( $_POST['pwd'] );

                $Ip = WebHelper::getclientip( );

                if (isset($_GET['ref'])) {
                $Invite = $_GET['ref'];

                } else {

                $Invite = 0;

                } 

                $this->err[0] = strlen( $name ) < 3 ? register_player_txt_notless3 : "";
                if ( $this->err[0] == "" )
                {
                    $this->err[0] = preg_match( "/[:,\\. \\<\\>\\n\\r\\t\\s]+/", $name ) ? register_player_txt_invalidchar : "";
                }
                if ( $name == "[tatar]" || $name == "admin" || $name == "Admin" || $name == "administrator" || $name == "Administrator" || $name == "multihunter" || $name == "Multihunter" || $name == "tatar" || $name == "Tatar" || $name == "?I??" || $name == "الادارة" || $name == "الاداره" || $name == "الدعم" || $name == "الادمن" || $name == $this->appConfig['system']['adminName'] || $name == tatar_tribe_player )
                {
                    $this->err[0] = register_player_txt_reserved;
                }

                                if (strlen($name) > 15)
                                {
                    $this->err[0] = register_player_txt_invalidchar;
                }

                if ( $name != htmlspecialchars($name) )
                {
                    $this->err[0] = register_player_txt_invalidchar;
                }
                $this->err[1] = !preg_match( "/^[^@]+@[a-zA-Z0-9._-]+\\.[a-zA-Z]+\$/", $email ) ? register_player_txt_invalidemail : "";

                $this->err[2] = strlen( $pwd ) < 4 ? register_player_txt_notless4 : "";

                $this->err[3] = !isset( $_POST['tid'] ) || $_POST['tid'] != 1 && $_POST['tid'] != 2 && $_POST['tid'] != 3 ? "<li>".register_player_txt_choosetribe."</li>" : "";
                $this->err[3] .= !isset( $_POST['kid'] ) || !is_numeric( $_POST['kid'] ) || $_POST['kid'] < 0 || 4 < $_POST['kid'] ? "<li>".register_player_txt_choosestart."</li>" : "";

                foreach ($this->err as $error) {
                    if (strlen($error) > 0) {
                        return;
                    }
                }
                
                $m = new RegisterModel( );
                $this->err[0] = $m->isPlayerNameExists( $name ) ? register_player_txt_usedname : "";
                $this->err[1] = $m->isPlayerEmailExists( $email ) ? register_player_txt_usedemail : "";

                if ( $m->isPlayerMultiReg( $Ip ) ) {

                $this->err[0] = register_player_txt_invalidchar;

                $this->err[1] = register_player_txt_invalidemail;

                $this->err[2] = register_player_txt_notless4;
                }

                if ( 0 < strlen( $this->err[0] ) || 0 < strlen( $this->err[1] ) )
                {
                    $m->dispose( );
                }
                else
                {
                    $villageName = new_village_name_prefix." ".$name;
                    $result = $m->createNewPlayer( $name, $email, $pwd, $_POST['tid'], $_POST['kid'], $villageName, $this->setupMetadata['map_size'], PLAYERTYPE_NORMAL, 1, $this->SNdata, $Ip, $Invite );
                    if ( $result['hasErrors'] )
                    {
                        $this->err[3] = register_player_txt_fullserver;
                        $m->dispose( );
                    }
                    else
                    {
                        $m->dispose( );
                        $link = WebHelper::getbaseurl( )."activate.php?id=".$result['activationCode'];
                        $to = $email;
                        $from = $this->appConfig['system']['email'];
                        $subject = register_player_txt_regmail_sub;
                        $message = sprintf( register_player_txt_regmail_body, $name, $name, $pwd, $link, $link );
                        WebHelper::sendmail( $to, $from, $subject, $message );
                        $this->success = TRUE;
                    }
                }
            }
        }
    }

}

$p = new GPage( );
$p->run( );
?>
