﻿<?php
// BY SINIRI
class RegisterModel extends ModelBase
{

    public function isPlayerNameExists( $playerName )
    {
        return 0 < $this->provider->fetchScalar( "SELECT COUNT(*) FROM p_players p WHERE p.name='%s'", array(
            $playerName
        ) );
    }

    public function isPlayerMultiReg( $playerIp )
    {
           $time_to_reg = 3600;
        
   return 3 < $this->provider->fetchScalar( "SELECT COUNT(*) FROM p_players p WHERE p.last_ip='%s' AND TIME_TO_SEC(TIMEDIFF(NOW(), p.registration_date)) <= %s", array(
           $playerIp,

           $time_to_reg
        ) );
    }

    public function isPlayerEmailExists( $playerEmail )
    {
        return 0 < $this->provider->fetchScalar( "SELECT COUNT(*) FROM p_players p WHERE p.email='%s'", array(
            $playerEmail
        ) );
    }

    public function _getEmptyVillageId( $position, $mapSize )
    {
        $halfMapSize = floor( $mapSize / 2 );
        $positionArray = array(
            0 - $halfMapSize,
            $halfMapSize,
            0 - $halfMapSize,
            $halfMapSize
        );
        switch ( $position )
        {
        case 1 :
            $positionArray = array(
                0 - $halfMapSize,
                0,
                0,
                $halfMapSize
            );
            break;
        case 2 :
            $positionArray = array(
                0,
                $halfMapSize,
                0,
                $halfMapSize
            );
            break;
        case 3 :
            $positionArray = array(
                0 - $halfMapSize,
                0,
                0 - $halfMapSize,
                0
            );
            break;
        case 4 :
            $positionArray = array(
                0,
                $halfMapSize,
                0 - $halfMapSize,
                0
            );
        }
        return $this->provider->fetchRow( "SELECT v.id, v.rel_x, v.rel_y FROM p_villages v WHERE v.field_maps_id=3 AND ISNULL(v.player_id) AND (v.rel_x >= %s AND v.rel_x <= %s) AND (v.rel_y >= %s AND v.rel_y <= %s) AND v.rand_num > 0 ORDER BY v.rand_num LIMIT 1", $positionArray );
    }

    public function createVillage( $playerId, $tribeId, $villageId, $playerName, $villageName, $playerType )
    {
        $GameMetadata = $GLOBALS['GameMetadata'];
        $isSpecial = $playerType == PLAYERTYPE_TATAR;
        $row = $this->provider->fetchRow( "SELECT v.player_id,v.field_maps_id FROM p_villages v WHERE v.id=%s", array(
            $villageId
        ) );
        if ( 0 < intval( $row['player_id'] ) )
        {
            return FALSE;
        }
        $update_key = substr( md5( $playerId.$tribeId.$villageId.$playerName.$villageName ), 2, 5 );
        $field_map_id = $row['field_maps_id'];
        $buildings = "";
        foreach ( $GLOBALS['SetupMetadata']['field_maps'][$field_map_id] as $v )
        {
            if ( $buildings != "" )
            {
                $buildings .= ",";
            }
            $buildings .= sprintf( "%s 0 0", $v );
        }
        $k = 19;
        while ( $k <= 40 )
        {
            $buildings .= $k == 26 && !$isSpecial ? ",15 1 0" : ",0 0 0";
            ++$k;
        }
        $resources = "";
        $farr = explode( "-", $GLOBALS['SetupMetadata']['field_maps_summary'][$field_map_id] );
        $i = 1;
        $_c = sizeof( $farr );
        while ( $i <= $_c )
        {
            if ( $resources != "" )
            {
                $resources .= ",";
            }
            $resources .= sprintf( "%s 750 800 800 %s 0", $i, $farr[$i - 1] * 2 * $GameMetadata['game_speed'] );
            ++$i;
        }
        $troops_training = "";
        $troops_num = "";
        foreach ( $GameMetadata['troops'] as $k => $v )
        {
            if ( $v['for_tribe_id'] == 0 - 1 || $v['for_tribe_id'] == $tribeId )
            {
                if ( $troops_training != "" )
                {
                    $troops_training .= ",";
                }
                $researching_done = $v['research_time_consume'] == 0 ? 1 : 0;
                $troops_training .= $k." ".$researching_done." 0 0";
                if ( $troops_num != "" )
                {
                    $troops_num .= ",";
                }
                $troops_num .= $k." 0";
            }
        }
        $troops_num = "-1:".$troops_num;
        $this->provider->executeQuery( "UPDATE p_villages v SET v.last_update_date=NOW(), v.tribe_id=%s, v.player_id=%s, v.player_name='%s', v.village_name='%s', v.is_capital=1, v.is_special_village=%s, v.creation_date=NOW(), v.buildings='%s', v.resources='%s', v.cp='0 2', v.troops_training='%s', v.troops_num='%s', v.update_key='%s' WHERE v.id=%s", array(
            $tribeId,
            $playerId,
            $playerName,
            $villageName,
            $isSpecial ? "1" : "0",
            $buildings,
            $resources,
            $troops_training,
            $troops_num,
            $update_key,
            $villageId
        ) );
        return TRUE;
    }

    public function createNewPlayer( $playerName, $playerEmail, $playerPassword, $tribeId, $position, $villageName, $mapSize, $playerType, $villageCount = 1, $snID = 0, $playerIp = NULL, $playerInvite = 0 )
    {

        if ($playerType == PLAYERTYPE_ADMIN || $playerType == PLAYERTYPE_HUNTER) {


        $is_active = 1;


        } else {

        $is_active = 1;

    }
$Voxs = mysql_query("SELECT * From g_summary");
$this->date = mysql_fetch_array($Voxs);
$s = $this->date['gnews_text'];
if ($s != '') {
$s = 1;
} else {
$s = 0;
}
        $this->provider->executeQuery( "INSERT p_players SET new_gnews='%s', tribe_id='%s', name='%s', pwd='%s', email='%s', is_active=%s, active_plus_account=0, is_blocked=0, last_ip='%s', invite_by=%s, registration_date=NOW(), player_type=%s, gold_num=1000, snid=%s, medals='0::'", array(
            $s,
            $tribeId,
            $playerName,
            md5( $playerPassword ),
            $playerEmail,

            $is_active,


            $playerIp,


            intval( $playerInvite ),
            $playerType,
            intval( $snID )
        ) );
        
$player_id = mt_rand(1000000 ,1500000);
$time = date("20y-m-d");
$heur =  date( "G:i:s");
require( APP_PATH."config.php" );
$db_connect = mysql_connect($AppConfig['db']['host'],$AppConfig['db']['user'],$AppConfig['db']['password']);
mysql_select_db($AppConfig['db']['database'], $db_connect);
$query1 = mysql_query("SELECT * FROM g_summary");
$data1  = mysql_fetch_array($query1);
$play1 = $data1['players_count'] + 1;
$play = $play1;
$query2 = mysql_query("SELECT * FROM p_alliances");
$data3  = mysql_num_rows($query2);
$message1 = '
اهلا  '.$playerName.',

شكرا لك على التسجيل في السيرفر

منذ '.$time.' '.$heur.' 

الرومان،الجرمان والاغريق يهاجمون بعضهم البعض،

 في هذا العالم يوجد حاليا '.$play.' لاعب في '.$data3.' ادارة موقع tatars-wars.com، 

نحن فريق حرب التتار نتمنى لك المتعة والاثارة
';
$playerId = $this->provider->fetchScalar( "SELECT LAST_INSERT_ID() FROM p_players" );
$this->provider->executeQuery( "INSERT INTO p_msgs (id) VALUES ('$player_id') ");
$this->provider->executeQuery("UPDATE p_msgs set from_player_id='1' where id='$player_id'");
$this->provider->executeQuery("UPDATE p_msgs set to_player_id='$playerId' where id='$player_id'");
$this->provider->executeQuery("UPDATE p_msgs set from_player_name='الادارة' where id='$player_id'");
$this->provider->executeQuery("UPDATE p_msgs set to_player_name='$playerName' where id='$player_id'");
$this->provider->executeQuery("UPDATE p_msgs set msg_title='معلومات مفيدة' where id='$player_id'");
$this->provider->executeQuery("UPDATE p_msgs set msg_body='$message1' where id='$player_id'");
$this->provider->executeQuery("UPDATE p_msgs set creation_date='$time $heur' where id='$player_id'");
$this->provider->executeQuery("UPDATE p_msgs set is_readed='0' where id='$player_id'");
$this->provider->executeQuery("UPDATE p_msgs set delete_status='0' where id='$player_id'");
$this->provider->executeQuery("UPDATE p_players set new_mail_count=new_mail_count + 1 where id='".$playerId."'");

        $playerId = $this->provider->fetchScalar( "SELECT LAST_INSERT_ID() FROM p_players" );
        if ( !$playerId )
        {
            return array(
                "hasErrors" => TRUE
            );
        }
        $villages = array( );
        $i = 0;
        while ( $i < $villageCount )
        {
            $vrow = NULL;
            if ( $playerType == PLAYERTYPE_ADMIN )
            {
                $vrow = array( "id" => 1, "rel_x" => 0, "rel_y" => 0 );
            }

            else if ( $playerType == PLAYERTYPE_HUNTER )

            {

                $vrow = array( "id" => 80201, "rel_x" => 100, "rel_y" => 100 );
            }
            else
            {
                $vrow = $this->_getEmptyVillageId( $position, $mapSize );
            }
            $villageId = $vrow['id'];
            $villages[$villageId] = array(
                $vrow['rel_x'],
                $vrow['rel_y'],
                $villageName
            );
            if ( !$villageId )
            {
                $this->provider->executeQuery( "DELETE FROM p_players WHERE id=%s", array(
                    $playerId
                ) );
                return array(
                    "hasErrors" => TRUE
                );
            }
            $trialsCount = 1;
            while ( !$this->createVillage( $playerId, $tribeId, $villageId, $playerName, $villageName, $playerType ) )
            {
                unset( $villages[$villageId] );
                if ( $trialsCount == 3 )
                {
                    $this->provider->executeQuery( "DELETE FROM p_players WHERE id=%s", array(
                        $playerId
                    ) );
                    return array(
                        "hasErrors" => TRUE
                    );
                }
                ++$trialsCount;
                $vrow = $this->_getEmptyVillageId( $position, $mapSize );
                $villageId = $vrow['id'];
                $villages[$villageId] = array(
                    $vrow['rel_x'],
                    $vrow['rel_y'],
                    $villageName
                );
            }
            ++$i;
        }
        $villages_id = "";
        $villages_data = "";
        foreach ( $villages as $k => $v )
        {
            if ( $villages_id != "" )
            {
                $villages_id .= ",";
                $villages_data .= "\n";
            }
            $villages_data .= $k." ".implode( " ", $v );
            $villages_id .= $k;
        }
        $activationCode = substr( md5( dechex( $playerId ).dechex( $villageId ) ), 5, 10 );
        $this->provider->executeQuery( "UPDATE p_players SET activation_code='%s', selected_village_id=%s, villages_id='%s', villages_data='%s', villages_count=%s WHERE id=%s", array(
            $activationCode,
            $villageId,
            $villages_id,
            $villages_data,
            sizeof( $villages ),
            $playerId
        ) );
        $expr = "";
        switch ( $tribeId )
        {
        case 1 :
            $expr = ",gs.Roman_players_count=gs.Roman_players_count+1";
            break;
        case 2 :
            $expr = ",gs.Teutonic_players_count=gs.Teutonic_players_count+1";
            break;
        case 3 :
            $expr = ",gs.Gallic_players_count=gs.Gallic_players_count+1";
            break;
        case 6 :
            $expr = ",gs.Dboor_players_count=gs.Dboor_players_count+1";
            break;
        case 7 :
            $expr = ",gs.Arab_players_count=gs.Arab_players_count+1";
        }
        if ( $playerType == PLAYERTYPE_ADMIN )
        {
            $expr .= ",gs.active_players_count=gs.active_players_count+1";
        }

        if ( $playerType == PLAYERTYPE_HUNTER )
        {
            $expr .= ",gs.active_players_count=gs.active_players_count+1";
        }
        if ( $expr != "" )
        {
            $this->provider->executeQuery( "UPDATE g_summary gs SET gs.players_count=gs.players_count+1".$expr );
        }
        return array(
            "playerId" => $playerId,
            "villages" => $villages,
            "activationCode" => $activationCode,
            "hasErrors" => FALSE
        );
    }

}

?>