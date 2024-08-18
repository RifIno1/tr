<?php
class Puls extends ModelBase{
        public function InviteBy($id){
        return $this->provider->fetchResultSet("SELECT * FROM p_players WHERE invite_by='$id'");
   }
   
   public function InviteByGold($id){
        return $this->provider->fetchResultSet("SELECT * FROM p_players WHERE invite_by='$id'");
   }
   
    public function incrementPlayerGold( $playerId )
    {
        $this->provider->executeQuery( "UPDATE p_players SET gold_num=gold_num+1000 WHERE id=%s", array(
            $playerId
        ) );
    }
        public function Playerclub( $a,$b)
    {
        $this->provider->executeQuery( "UPDATE p_players SET club=1,gold_num=gold_num-%s WHERE id=%s", array(
            $a,
            $b
        ) );
    }
        public function PlayerRef( $RefId )
    {
        $this->provider->executeQuery( "UPDATE p_players SET show_ref=1 WHERE id=%s", array(
            $RefId
        ) );
    }
        
        public function getPlayerDataById( $playerId )
    {
        return $this->provider->fetchRow( "SELECT p.last_ip, p.pwd, p.total_people_count FROM p_players p WHERE p.id=%s", array(
            $playerId
        ) );
    }
        
        public function getPlayerDataByName( $playerName )
    {
        return $this->provider->fetchRow( "SELECT p.id FROM p_players p WHERE p.name='%s'", array(
            $playerName
        ) );
    }
        
        public function DeletPlayerGold( $playerId, $GoldNum )
    {
        $this->provider->executeQuery( "UPDATE p_players SET gold_num=gold_num-%s WHERE id=%s", array(
                    $GoldNum,
            $playerId
        ) );
    }

        public function getPlayerId( $playerName )
    {
        return $this->provider->fetchRow( "SELECT p.id FROM p_players p WHERE p.name=%s", array(
            $playerName
        ) );
    }



        
        public function GivePlayerGold( $playerName, $GoldNum )
    {
        $this->provider->executeQuery( "UPDATE p_players SET gold_num=gold_num+%s WHERE name='%s'", array(
                    $GoldNum,
            $playerName
        ) );
    }
}
?>