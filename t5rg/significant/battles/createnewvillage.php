<?php

class NewVillageBattleModel extends BattleModel
{


     public function _getResourcesString($resources)
        {
        $result = "";
        foreach ($resources as $k => $v)
            {
            if ($result != "")
                {
                $result .= ",";
                }
            $result .= $k . " " . $v['current_value'] . " " . $v['store_max_limit'] . " " . $v['store_init_limit'] . " " . $v['prod_rate'] . " " . $v['prod_rate_percentage'];
            }
        return $result;
        }

    
    public function _getResourcesArray($resourceString, $elapsedTimeInSeconds, $crop_consumption, $cp)
        {
        $resources = array();
        $r_arr     = explode(",", $resourceString);
        foreach ($r_arr as $r_str)
            {
            $r2            = explode(" ", $r_str);
            $prate         = floor($r2[4] * (1 + $r2[5] / 100)) - ($r2[0] == 4 ? $crop_consumption : 0);
            $current_value = floor($r2[1] + $elapsedTimeInSeconds * ($prate / 3600));
            if ($r2[2] < $current_value)
                {
                $current_value = $r2[2];
                }
            $resources[$r2[0]] = array(
                "current_value" => $current_value,
                "store_max_limit" => $r2[2],
                "store_init_limit" => $r2[3],
                "prod_rate" => $r2[4],
                "prod_rate_percentage" => $r2[5]
            );
            }
            
        return array(
            "resources" => $resources
        );
        }

    public function handleCreateNewVillage( $taskRow, $toVillageRow, $fromVillageRow, $cropConsumption )
    {
        $GameMetadata = $GLOBALS['GameMetadata'];
        $SetupMetadata = $GLOBALS['SetupMetadata'];
        if ( intval( $this->provider->fetchScalar( "SELECT p.id FROM p_players p WHERE p.id=%s", array(
            intval( $fromVillageRow['player_id'] )
        ) ) ) == 0 )
        {
            return FALSE;
        }
        $villageName = new_village_name;
        $update_key = substr( md5( $fromVillageRow['player_id'].$fromVillageRow['tribe_id'].$toVillageRow['id'].$fromVillageRow['player_name'].$villageName ), 2, 5 );
        $field_map_id = $toVillageRow['field_maps_id'];
        $buildings = "";
        foreach ( $SetupMetadata['field_maps'][$field_map_id] as $v )
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
            $buildings .= $k == 26 ? ",15 1 0" : ",0 0 0";
            ++$k;
        }
        $resources = "";
        $farr = explode( "-", $SetupMetadata['field_maps_summary'][$field_map_id] );
        $i = 1;
        $_c = sizeof( $farr );
        while ( $i <= $_c )
        {
            if ( $resources != "" )
            {
                $resources .= ",";
            }
            $resources .= sprintf( "%s 1000 8000 8000 %s 0", $i, $farr[$i - 1] * 2 * $GameMetadata['game_speed'] );
            ++$i;
        }
        // here to change recources if the player has a oasis
        // get village_oases_id of fromVillageRow
        $village_oases_id = $fromVillageRow['village_oases_id'];
        
        // insert village_oases_id of fromVillageRow to toVillageRow
        $this->provider->executeQuery( "UPDATE p_villages v\r\n\t\t\tSET\r\n\t\t\t\tv.village_oases_id='%s'\r\n\t\t\tWHERE v.id=%s", array(
            $village_oases_id,
            intval( $toVillageRow['id'] )
        ) );

////////////////////////////////////////////////////////////////////////////////////////
        
        // split oasis_id from village_oases_id by ,
        $oasisIds = explode(",", $village_oases_id);

        

        foreach($oasisIds as $oId){

            $villageId = intval($toVillageRow['id']);
            $query = "SELECT v.player_id, v.resources, v.cp, v.crop_consumption, TIME_TO_SEC(TIMEDIFF(NOW(), v.last_update_date)) AS elapsedTimeInSeconds FROM p_villages v WHERE v.id='$villageId'";
            $villageRow = $this->provider->executeQuery($query);    

            echo "village row -------------------------------y";

            echo $villageRow['resources'];
            echo "<br>";
    
            $resultArr  = $this->_getResourcesArray($villageRow['resources'], $villageRow['elapsedTimeInSeconds'], $villageRow['crop_consumption'], $villageRow['cp']);
    
            echo "resultArr -------------------------------y";
            print_r($resultArr);

        $oasisIndex = $this->provider->fetchScalar("SELECT v.image_num FROM p_villages v WHERE v.id=%s", array(intval($oId)));
// Get the oasis resources metadata
$oasisRes   = $GLOBALS['SetupMetadata']['oasis'][$oasisIndex];
echo "<br>";
echo "oasisRes -------------------------------y";
print_r($oasisRes);
echo "<br>";


$factor     = 1;
    
    // Adjust the production rate percentage based on the oasis resources
    foreach ($oasisRes as $k => $v) {
        $resultArr['resources'][$k]['prod_rate_percentage'] += $v * $factor;
        if ($resultArr['resources'][$k]['prod_rate_percentage'] < 0) {
            $resultArr['resources'][$k]['prod_rate_percentage'] = 0;
        }
        echo $resultArr['resources']['k']['prod_rate_percentage'];
        echo "<br>";
    }

    echo "<br>";
    echo $this->_getResourcesString($resultArr['resources']);

// Update the village with the new resources and other data
$this->provider->executeQuery( "UPDATE p_villages v\r\n\t\t\tSET\r\n\t\t\t\tv.resources='%s'\r\n\t\t\tWHERE v.id=%s", array(
    $this->_getResourcesString($resultArr['resources']),

    intval($toVillageRow['id'])
) );

        }










        $troops_training = "";
        $troops_num = "";
        foreach ( $GameMetadata['troops'] as $k => $v )
        {
            if ( $v['for_tribe_id'] == 0 - 1 || $v['for_tribe_id'] == $fromVillageRow['tribe_id'] )
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
        $this->provider->executeQuery( "UPDATE p_villages v\r\n\t\t\tSET\r\n\t\t\t\tv.parent_id=%s,\r\n\t\t\t\tv.tribe_id=%s,\r\n\t\t\t\tv.player_id=%s,\r\n\t\t\t\tv.alliance_id=%s,\r\n\t\t\t\tv.player_name='%s',\r\n\t\t\t\tv.village_name='%s',\r\n\t\t\t\tv.alliance_name='%s',\r\n\t\t\t\tv.is_capital=0,\r\n\t\t\t\tv.buildings='%s',\r\n\t\t\t\tv.resources='%s',\r\n\t\t\t\tv.cp='0 2',\r\n\t\t\t\tv.troops_training='%s',\r\n\t\t\t\tv.troops_num='%s',\r\n\t\t\t\tv.update_key='%s',\r\n\t\t\t\tv.creation_date=NOW(),\r\n\t\t\t\tv.last_update_date=NOW()\r\n\t\t\tWHERE v.id=%s", array(
            intval( $fromVillageRow['id'] ),
            intval( $fromVillageRow['tribe_id'] ),
            intval( $fromVillageRow['player_id'] ),
            0 < intval( $fromVillageRow['alliance_id'] ) ? intval( $fromVillageRow['alliance_id'] ) : "NULL",
            $fromVillageRow['player_name'],
            $villageName,
            $fromVillageRow['alliance_name'],
            $buildings,
            $resources,
            $troops_training,
            $troops_num,
            $update_key,
            intval( $toVillageRow['id'] )
        ) );
        $child_villages_id = trim( $fromVillageRow['child_villages_id'] );
        if ( $child_villages_id != "" )
        {
            $child_villages_id .= ",";
        }
        $child_villages_id .= $toVillageRow['id'];
        $this->provider->executeQuery( "UPDATE p_villages v\r\n\t\t\tSET\r\n\t\t\t\tv.crop_consumption=v.crop_consumption-%s,\r\n\t\t\t\tv.child_villages_id='%s'\r\n\t\t\tWHERE v.id=%s", array(
            $cropConsumption,
            $child_villages_id,
            intval( $fromVillageRow['id'] )
        ) );
        $prow = $this->provider->fetchRow( "SELECT p.villages_id, p.villages_data FROM p_players p WHERE p.id=%s", array(
            intval( $fromVillageRow['player_id'] )
        ) );
        $villages_id = trim( $prow['villages_id'] );
        if ( $villages_id != "" )
        {
            $villages_id .= ",";
        }
        $villages_id .= $toVillageRow['id'];
        $villages_data = trim( $prow['villages_data'] );
        if ( $villages_data != "" )
        {
            $villages_data .= "\n";
        }
        $villages_data .= $toVillageRow['id']." ".$toVillageRow['rel_x']." ".$toVillageRow['rel_y']." ".$villageName;
        $this->provider->executeQuery( "UPDATE p_players p\r\n\t\t\tSET\r\n\t\t\t\tp.total_people_count=p.total_people_count+2,\r\n\t\t\t\tp.villages_count=p.villages_count+1,\r\n\t\t\t\tp.selected_village_id=%s,\r\n\t\t\t\tp.villages_id='%s',\r\n\t\t\t\tp.villages_data='%s',\r\n\t\t\t\tp.create_nvil=1\r\n\t\t\tWHERE\r\n\t\t\t\tp.id=%s", array(
            intval( $toVillageRow['id'] ),
            $villages_id,
            $villages_data,
            intval( $fromVillageRow['player_id'] )
        ) );
        return FALSE;
    }

}

?>
