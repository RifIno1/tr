<?php

require('.' . DIRECTORY_SEPARATOR . 't5rg' . DIRECTORY_SEPARATOR . 'boot.php');
require_once(MODEL_PATH . 'farm.php'); 

class GPage extends SecureGamePage {
        var $error;
        var $troops;
        
        function GPage() {
                parent::SecureGamePage();

                $this->viewFile                                 = 'farm.phtml';
                $this->contentCssClass = 'player';
        }
        
        function load() {
                parent::load();
                
                $m = new FarmList ();
                if(isset($_GET['del'])){
                        if(isset($_GET['id']) && is_numeric($_GET['id']) && intval($_GET['id']) > 0 && $m->hasThisFarm($_GET['id'], $this->player->playerId) > 0){
                                $m->DeleteThisFarm($_GET['id']);
                        }
                }
                if(isset($_GET['add'])){

                        // get only my troops
                        $t_arr = explode( '|', $this->data['troops_num'] );
                        foreach( $t_arr as $t_str ) {
                                $t2_arr = explode( ':', $t_str );
                                if ( $t2_arr[0] == -1 ) {
                                        $t2_arr = explode( ',', $t2_arr[1] );
                                        foreach( $t2_arr as $t2_str ) {
                                                $t = explode( ' ', $t2_str );
                                                
                                                if ( $t[0] == 4 || $t[0] == 7 || $t[0] == 8 || $t[0] == 9 || $t[0] == 10 
                                                  || $t[0] == 14 || $t[0] == 17 || $t[0] == 18 || $t[0] == 19 || $t[0] == 20 
                                                  || $t[0] == 23 || $t[0] == 27 || $t[0] == 28 || $t[0] == 29 || $t[0] == 30 || $t[0] == 99
                                                  || $t[0] == 54 || $t[0] == 57 || $t[0] == 58 || $t[0] == 59 || $t[0] == 60 ){
                                                        continue;
                                                }
                                                        $this->troops [ $t[0] ] = $t[1];
                                        }
                                }
                        }
                }
                if($this->isPost ()){
                        $villageRow = '';
                        switch($this->data['tribe_id']){
                                case 1:
                                $farmTroops = array(1,2,3,5,6);
                                break;
                        case 2:
                                $farmTroops = array(11,12,13,15,16);
                                break;
                        case 3:
                                $farmTroops = array(21,22,24,25,26);
                                break;
                        case 6:
                                $farmTroops = array(51,52,53,55,56);
                        break;
                         case 7:
                                $farmTroops = array(100,101,102,104,105);
                        break;
                        }
                        if (isset ($_POST['vid'])) {
                                $vid = intval ($_POST['vid']);
                                $villageRow = $m->getVillageDataById ($vid);
                        } else if (isset ($_POST['dname']) && trim ($_POST['dname']) != '') {
                                $villageRow = $m->getVillageDataByName (trim ($_POST['dname']));
                        } else if (isset ($_POST['x']) && isset ($_POST['y']) && trim ($_POST['x']) != '' && trim ($_POST['y']) != '') {
                                $vid = $m->__getVillageId ($this->setupMetadata['map_size'], $m->__getCoordInRange($this->setupMetadata['map_size'], intval ($_POST['x'])), $m->__getCoordInRange($this->setupMetadata['map_size'], intval ($_POST['y'])));
                                $villageRow = $m->getVillageDataById ($vid);
                        }
                        
                        $tid = isset($_POST['tid']) && is_numeric($_POST['tid']) ? intval($_POST['tid']) : 0;
                        $tnum = isset($_POST['tnum']) && is_numeric($_POST['tnum']) ? intval($_POST['tnum']) : 0;
                        if($villageRow == NULL || $villageRow['id'] == $this->data['selected_village_id']){
                                $this->error = 'يرجى ادخال معلومات القرية بشكلة صحيح.';
                                return;
                        }else if($villageRow['player_id'] == 0 && !$villageRow['is_oasis']){
                                $this->error = 'لا يمكن اضافة هذه القرية.';
                                return;
                        }else if(!in_array($tid,$farmTroops)){
                                $this->error = 'يرجى اختيار احدى القوات.';
                                return;
                        }else if($tnum == 0){
                                $this->error = 'يرجى اختيار عدد القوات.';
                                return;
                        } else if($m->isFarmFull($this->player->playerId) >= 250) {
                                $this->error = 'لا يمكنك اضافة المزيد من المزارع.';
                                return;
                        } else {
                                $m->addFarm($this->player->playerId, $this->data['selected_village_id'], $villageRow['id'], $tid. ' ' .$tnum);
                                $this->error = 'تم اضافة المزرعة بنجاح.';
                        }
                }

                        $this->dataList = $m->getFarmList($this->player->playerId, $this->data['selected_village_id']);
                $m->dispose();
        }

}
$p = new GPage();
$p->run();
?>
