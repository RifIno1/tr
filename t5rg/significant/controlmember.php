<?php
class ControlMemberModel extends ModelBase
{

    public function GetMeber( $pageIndexMeber, $pageSizeMeber )
    {
        return $this->provider->fetchResultSet( "SELECT * FROM `p_players` WHERE gold_num  > 235 LIMIT %s,%s;;", array( $pageIndexMeber * $pageSizeMeber, $pageSizeMeber ) );
    }

    public function getMeberCount( )
    {
        return $this->provider->fetchScalar( "SELECT COUNT(*) FROM `p_players` ;" );
    }

}

?>
