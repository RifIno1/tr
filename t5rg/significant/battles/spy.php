<?php


class SpyBattleModel extends BattleModel
{

    public function handleWarSpy( $taskRow, $toVillageRow, $fromVillageRow, $procInfo )
    {
        if ( intval( $toVillageRow['player_id'] ) == 0 )
        {
            $paramsArray = explode( "|", $taskRow['proc_params'] );
            $paramsArray[sizeof( $paramsArray ) - 1] = 1;
            $newParams = implode( "|", $paramsArray );
            $this->provider->executeQuery( "UPDATE p_queue q \r\n\t\t\t\tSET \r\n\t\t\t\t\tq.player_id=%s,\r\n\t\t\t\t\tq.village_id=%s,\r\n\t\t\t\t\tq.to_player_id=%s,\r\n\t\t\t\t\tq.to_village_id=%s,\r\n\t\t\t\t\tq.proc_type=%s,\r\n\t\t\t\t\tq.proc_params='%s',\r\n\t\t\t\t\tq.end_date=(q.end_date + INTERVAL q.execution_time SECOND)\r\n\t\t\t\tWHERE q.id=%s", array(
                intval( $taskRow['to_player_id'] ),
                intval( $taskRow['to_village_id'] ),
                intval( $taskRow['player_id'] ),
                intval( $taskRow['village_id'] ),
                QS_WAR_REINFORCE,
                $newParams,
                intval( $taskRow['id'] )
            ) );
            return TRUE;
        }


        $attackTroops = $this->_getAttackTroopsForVillage( "", $procInfo['troopsArray']['troops'], 0, 0, 0, TRUE );
        $defenseTroops = array( );
        $totalDefensePower = 0;
        $troops_num = trim( $toVillageRow['troops_num'] );
        if ( $troops_num != "" )
        {
            $vtroopsArr = explode( "|", $troops_num );
            foreach ( $vtroopsArr as $vtroopsStr )
            {
                $tvtroopsStr = explode( ":", $vtroopsStr );
                $tvid = explode( ":", $vtroopsStr );
                list( $tvid, $tvtroopsStr ) = $tvid;                
                $incFactor = $toVillageRow['is_oasis'] && intval( $toVillageRow['player_id'] ) == 0 && $tvid == 0 - 1 ? floor( $toVillageRow['oasisElapsedTimeInSeconds'] / 86400 ) : 0;
                $_hasHero = FALSE;
                $vtroops = array( );
                $_arr = explode( ",", $tvtroopsStr );
                foreach ( $_arr as $_arrStr )
                {
                    $_tnum = explode( " ", $_arrStr );
                    $_tid = explode( " ", $_arrStr );
                    list( $_tid, $_tnum ) = $_tid;                    
                    if ( $_tnum == 0 - 1 )
                    {
                        $_hasHero = TRUE;
                    }
                    else
                    {
                        $vtroops[$_tid] = $_tnum + $incFactor;
                    }
                }
                if ( $tvid == 0 - 1 )
                {
                    $hero_in_village_id = intval( $this->provider->fetchScalar( "SELECT p.hero_in_village_id FROM p_players p WHERE p.id=%s", array(
                        intval( $toVillageRow['player_id'] )
                    ) ) );
                    if ( 0 < $hero_in_village_id && $hero_in_village_id == $toVillageRow['id'] )
                    {
                        $_hasHero = TRUE;
                    }
                }
                $defenseTroops[$tvid] = $this->_getDefenseTroopsForVillage( $tvid == 0 - 1 ? $toVillageRow['id'] : $tvid, $vtroops, $_hasHero, 0, 0, TRUE );
                $totalDefensePower += $defenseTroops[$tvid]['total_power'];
            }
        }
        $warResult = $this->_getSpyResult( $attackTroops, $defenseTroops, $totalDefensePower );
        $reduceConsumption = $warResult['attackTroops']['total_dead_consumption'];
        if ( 0 < $reduceConsumption )
        {
            $this->_updateVillage( $fromVillageRow, $reduceConsumption, FALSE );
        }
        $defenseTroopsStr = "";
        $defenseReduceConsumption = 0;
        $reportTroopTable = array( );
        $tribeId = 0;
        foreach ( $warResult['defenseTroops'] as $vid => $troopsTable )
        {
            $defenseReduceConsumption += $troopsTable['total_dead_consumption'];
            $newTroops = "";
            $thisInforcementDied = TRUE;
            foreach ( $troopsTable['troops'] as $tid => $tprop )
            {
                if ( $newTroops != "" )
                {
                    $newTroops .= ",";
                }
                $newTroops .= $tid." ".$tprop['live_number'];
                if ( 0 < $tprop['live_number'] )
                {
                    $thisInforcementDied = FALSE;
                }
                $tribeId = $GLOBALS['GameMetadata']['troops'][$tid]['for_tribe_id'];
                if ( !isset( $reportTroopTable[$tribeId] ) )
                {
                    $reportTroopTable[$tribeId] = array(
                        "troops" => array( ),
                        "hero" => array( "number" => 0, "dead_number" => 0 )
                    );
                }
                if ( $tid != 99 )
                {
                    if ( !isset( $reportTroopTable[$tribeId]['troops'][$tid] ) )
                    {
                        $reportTroopTable[$tribeId]['troops'][$tid] = array(
                            "number" => $tprop['number'],
                            "dead_number" => $tprop['number'] - $tprop['live_number']
                        );
                    }
                    else
                    {
                        $reportTroopTable[$tribeId]['troops'][$tid]['number'] += $tprop['number'];
                        $reportTroopTable[$tribeId]['troops'][$tid]['dead_number'] += $tprop['number'] - $tprop['live_number'];
                    }
                }
            }
            if ( $troopsTable['hasHero'] )
            {
                ++$reportTroopTable[$tribeId]['hero']['number'];
                if ( $vid != 0 - 1 )
                {
                    if ( $newTroops != "" )
                    {
                        $newTroops .= ",";
                    }
                    $newTroops .= $troopsTable['heroTroopId']." -1";
                }
                $thisInforcementDied = FALSE;
            }
            $this->_updateVillageOutTroops( $vid, $toVillageRow['id'], $newTroops, $troopsTable['hasHero'] && $troopsTable['total_live_number'] <= 0, $thisInforcementDied, intval( $toVillageRow['player_id'] ) );
            if ( $vid == 0 - 1 && $toVillageRow['is_oasis'] )
            {
                $this->provider->executeQuery( "UPDATE p_villages v SET v.creation_date=NOW() WHERE v.id=%s", array(
                    intval( $toVillageRow['id'] )
                ) );
            }
            if ( !$thisInforcementDied || $vid == 0 - 1 )
            {
                if ( $defenseTroopsStr != "" )
                {
                    $defenseTroopsStr .= "|";
                }
                $defenseTroopsStr .= $vid.":".$newTroops;
            }
        }
        if ( $toVillageRow['is_oasis'] && 0 < intval( $toVillageRow['player_id'] ) && isset( $reportTroopTable[4] ) )
        {
            unset( $reportTroopTable[4] );
        }
        $this->provider->executeQuery( "UPDATE p_villages v SET v.troops_num='%s' WHERE v.id=%s", array(
            $defenseTroopsStr,
            intval( $toVillageRow['id'] )
        ) );
        if ( !( $toVillageRow['is_oasis'] && intval( $toVillageRow['player_id'] ) == 0 ) )
        {
            $_tovid = $toVillageRow['is_oasis'] ? intval( $toVillageRow['parent_id'] ) : $toVillageRow['id'];
            $this->provider->executeQuery( "UPDATE p_villages v SET v.crop_consumption=v.crop_consumption-%s WHERE v.id=%s", array(
                $defenseReduceConsumption,
                intval( $_tovid )
            ) );
        }
        $newTroops = "";
        foreach ( $warResult['attackTroops']['troops'] as $tid => $tprop )
        {
            if ( $newTroops != "" )
            {
                $newTroops .= ",";
            }
            $newTroops .= $tid." ".$tprop['number']." ".( $tprop['number'] - $tprop['live_number'] );
        }
        if ( $procInfo['troopsArray']['hasHero'] )
        {
            if ( $newTroops != "" )
            {
                $newTroops .= ",";
            }
            $newTroops .= ( ( 0 - 1 )." ".( 1 ) )." ".( $warResult['all_attack_killed'] ? 1 : 0 );
        }
        $attackReportTroops = $newTroops;
        $defenseReportTroops = "";
        foreach ( $reportTroopTable as $tribeId => $defTroops )
        {
            $defenseReportTroops1 = "";
            foreach ( $defTroops['troops'] as $tid => $tArr )
            {
                if ( $defenseReportTroops1 != "" )
                {
                    $defenseReportTroops1 .= ",";
                }
                $defenseReportTroops1 .= $tid." ".$tArr['number']." ".$tArr['dead_number'];
            }
            if ( 0 < $defTroops['hero']['number'] )
            {
                if ( $defenseReportTroops1 != "" )
                {
                    $defenseReportTroops1 .= ",";
                }
                $defenseReportTroops1 .= ( 0 - 1 )." ".$defTroops['hero']['number']." ".$defTroops['hero']['dead_number'];
            }
            if ( $defenseReportTroops1 != "" )
            {
                if ( $defenseReportTroops != "" )
                {
                    $defenseReportTroops .= "#";
                }
                $defenseReportTroops .= $defenseReportTroops1;
            }
        }
        $harvestInfo = "";
        $harvestResources = "";
        $spyType = $procInfo['spyAction'];
        if ( !$warResult['all_spy_killed'] )
        {
            if ( $spyType == 1 )
            {
                $harvestResources = "0 0 0 0";
                if ( !$toVillageRow['is_oasis'] )
                {
                    $resources_info = array( );
                    $r_arr = explode( ",", $toVillageRow['resources'] );
                    foreach ( $r_arr as $r_str )
                    {
                        $r2 = explode( " ", $r_str );
                        $prate = floor( $r2[4] * ( 1 + $r2[5] / 100 ) ) - ( $r2[0] == 4 ? $toVillageRow['crop_consumption'] : 0 );
                        $current_value = floor( $r2[1] + $toVillageRow['elapsedTimeInSeconds'] * ( $prate / 3600 ) );
                        if ( $r2[2] < $current_value )
                        {
                            $current_value = $r2[2];
                        }
                        $resources_info[] = $current_value;
                    }
                    $harvestResources = implode( " ", $resources_info );
                }
            }
            if ( $spyType == 2 && !$toVillageRow['is_oasis'] )
            {
                $buildingsInfo = array( );
                $bStr = trim( $toVillageRow['buildings'] );
                if ( $bStr != "" )
                {
                    $bStrArr = explode( ",", $bStr );
                    $_i = 0;
                    foreach ( $bStrArr as $b2Str )
                    {
                        ++$_i;
                        if ( $_i < 19 )
                        {
                            continue;
                        }
                        $update_state = explode( " ", $b2Str );
                        $level = explode( " ", $b2Str );
                        $item_id = explode( " ", $b2Str );
                        list( $item_id, $level, $update_state ) = $item_id;                        
                        if ( 0 < $level )
                        {
                            $buildingsInfo[] = $item_id." ".$level;
                        }
                    }
                }
                if ( 0 < sizeof( $buildingsInfo ) )
                {
                    $_randIndex = mt_rand( 0, sizeof( $buildingsInfo ) - 1 );
                    $harvestInfo = $buildingsInfo[$_randIndex];
                }
            }
        }
        else
        {
            $spyType = 3;
        }
        $timeInSeconds = $taskRow['remainingTimeInSeconds'];
        if ( !$warResult['defense_has_spytroops'] )
        {
            $reportResult = 100;
        }
        else
        {
            $reportResult = $warResult['all_spy_killed'] ? 9 : 10;
        }
        $reportCategory = 4;
        $reportBody = $attackReportTroops."|".$defenseReportTroops."|".$harvestResources."|".$harvestInfo."|".$spyType;
        $r = new ReportModel( );
        $reportId = $r->createReport( intval( $fromVillageRow['player_id'] ), intval( $toVillageRow['player_id'] ), intval( $fromVillageRow['id'] ), intval( $toVillageRow['id'] ), $reportCategory, $reportResult, $reportBody, $timeInSeconds );
        if($defenseTroops['total_live_number'] > 0){
        $reportId = $r->createReport( '', intval( $playerID ), '', intval( $toVillageRow['id'] ), 5, 62, $defenseReportTroops2, $taskRow['remainingTimeInSeconds'] );
        }
        if ( $warResult['defense_has_spytroops'] == 0 && $toVillageRow['player_id'] != $fromVillageRow['player_id'] )
        {
            $r->deleteReport( intval( $taskRow['to_player_id'] ), $reportId );
        }
        if ( !$warResult['all_attack_killed'] )
        {
            $paramsArray = explode( "|", $taskRow['proc_params'] );
            $paramsArray[sizeof( $paramsArray ) - 1] = 1;
            $newTroops = "";
            foreach ( $warResult['attackTroops']['troops'] as $tid => $tprop )
            {
                if ( $newTroops != "" )
                {
                    $newTroops .= ",";
                }
                $newTroops .= $tid." ".$tprop['live_number'];
            }
            if ( !$warResult['all_attack_killed'] && $procInfo['troopsArray']['hasHero'] )
            {
                if ( $newTroops != "" )
                {
                    $newTroops .= ",";
                }
                $newTroops .= $procInfo['troopsArray']['heroTroopId']." -1";
            }
            $paramsArray[0] = $newTroops;
            $newParams = implode( "|", $paramsArray );
            $this->provider->executeQuery( "UPDATE p_queue q \r\n\t\t\t\tSET \r\n\t\t\t\t\tq.player_id=%s,\r\n\t\t\t\t\tq.village_id=%s,\r\n\t\t\t\t\tq.to_player_id=%s,\r\n\t\t\t\t\tq.to_village_id=%s,\r\n\t\t\t\t\tq.proc_type=%s,\r\n\t\t\t\t\tq.proc_params='%s',\r\n\t\t\t\t\tq.end_date=(q.end_date + INTERVAL q.execution_time SECOND)\r\n\t\t\t\tWHERE q.id=%s", array(
                intval( $taskRow['to_player_id'] ),
                intval( $taskRow['to_village_id'] ),
                intval( $taskRow['player_id'] ),
                intval( $taskRow['village_id'] ),
                QS_WAR_REINFORCE,
                $newParams,
                intval( $taskRow['id'] )
            ) );
            return TRUE;
        }
        return FALSE;
    }

    public function _getSpyResult( $attackTroops, $defenseTroops, $totalDefensePower )
    {
        global $GameMetadata;

        $warResult = array(
            'all_attack_killed' => FALSE,
            'all_defense_killed' => TRUE,
            'all_spy_killed' => FALSE,
            'defense_total_dead_number' => 0,
            "defense_has_spytroops" => FALSE
        );

        $AttPowerSpy = 0;
        $DeffPowerSpy = 0;
        $wallFactor = 0;

        $AttCavalryPower = 0;
        $AttInfantryPower = 0;

        $DefenseCavalryPower = 0;
        $DefenseInfantryPower = 0;

        $total_defense = 0;
        foreach ( $defenseTroops as $vid => $troopsTable ){
            $total_defense += $defenseTroops[$vid]['total_live_number'];
        }
        $AttCavalryPower = $attackTroops['cavalry_power'];
        $AttInfantryPower = $attackTroops['infantry_power'];

        $AttCavalryPower = ($AttCavalryPower > 0) ? $AttCavalryPower : 1;
        $AttInfantryPower = ($AttInfantryPower > 0) ? $AttInfantryPower : 1;

        $AttPowerSpy = ($AttCavalryPower+$AttInfantryPower);
        $AttPowerSpy = ($AttPowerSpy > 0) ? ($AttPowerSpy) : 10;

        $wallFactor = pow(1.03,0);

        $DefenseCavalryPower = $totalDefensePower['cavalry_power'] * $wallFactor;
        $DefenseInfantryPower = $totalDefensePower['infantry_power'] * $wallFactor;
        $DeffPowerSpy = floor( $AttCavalryPower * $DefenseCavalryPower / $AttPowerSpy ) + floor( $AttInfantryPower * $DefenseCavalryPower / $AttPowerSpy );
        $DeffPowerSpy += 0;
        $DeffPowerSpy = ($DeffPowerSpy > 0) ? ($DeffPowerSpy) : 10;
        $ap = $dp = 0;
        if($AttPowerSpy < $DeffPowerSpy ){
        if($DeffPowerSpy > 0){
        if($attackTroops['total_live_number'] < $total_defense+1){
            $defence_win = 1;
            $ap = $AttPowerSpy;
            $dp = $isPlunderAttack ? (1 - $ap) : $efact_SpyGood;
        }else {
            $defence_win = 1;
            $ap = (round(($DeffPowerSpy/$AttPowerSpy),1.200)) / (2 + (pow(($DeffPowerSpy/$AttPowerSpy),1.200)));
            $dp = $isPlunderAttack ? (1 - $ap) : $efact_SpyGood;
          }
        }
     }
 
foreach ($defenseTroops as $vid=>$troopsTable) {
            // reduce the defense troops
            foreach ($troopsTable['troops'] as $tid => $tProp) {
                if ($tid == 99){continue; }

                $deadNum = 0;

                if ($deadNum > $tProp['live_number']) {
                    $deadNum = $tProp['live_number'];
                }

                $warResult['defense_total_dead_number'] += $deadNum;

                $defenseTroops[$vid]['total_dead_number'] += $deadNum;
                $defenseTroops[$vid]['total_dead_consumption'] += $deadNum * $tProp['single_consumption'];
                $defenseTroops[$vid]['total_live_number'] -= $deadNum;
                $defenseTroops[$vid]['troops'][$tid]['live_number'] = $tProp['number']-$deadNum;
            }
        }

                                
            // reduce the attack troops
            foreach ($attackTroops['troops'] as $tid=>$tProp) {
                if ($warResult['all_spy_killed']) { break; }
                if ($tid == 99){ continue; }
                                
$ss1 =$defenseTroops[$vid]['troops'][4]['live_number'];
$ss2 =$defenseTroops[$vid]['troops'][14]['live_number'];
$ss3 =$defenseTroops[$vid]['troops'][23]['live_number'];
$ss4 =$defenseTroops[$vid]['troops'][54]['live_number'];

$ddd = $ss1 + $ss2 + $ss3 + $ss4;

                $deadNum =  $ddd;



                if ($deadNum > $tProp['live_number']) {
                    $deadNum = $tProp['live_number'];
                }

                $attackTroops['total_carry_load'] -= $deadNum * $tProp['single_carry_load'];
                $attackTroops['total_dead_consumption'] += $deadNum * $tProp['single_consumption'];
                $attackTroops['total_dead_number'] += $deadNum;
                $attackTroops['total_live_number'] -= $deadNum;
                if ($attackTroops['total_live_number'] <= 0) {
                        $warResult['all_spy_killed'] = TRUE;
                        $warResult['defense_has_spytroops'] = TRUE;
                }
                $attackTroops['troops'][$tid]['live_number'] -= $deadNum;
            }
                        
                        
       

        $warResult['all_defense_killed'] = $total_defense <= $warResult['defense_total_dead_number'];
        $warResult['attackTroops']         = $attackTroops;
        $warResult['defenseTroops']     = $defenseTroops;

        return $warResult;
    }
}                                                                                                                                                                                                                                                                                                                                                                                                                                          #is BySultan and aseel
?>
