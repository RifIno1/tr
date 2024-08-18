<?php


class efecttreasuryserver extends ModelBase
{

    public function Getefect( $name, $type )
    {
        return $this->provider->fetchResultSet( "SELECT * FROM p_villages WHERE artefact_name=%s and type=%s and is_artefact=1", array( $name , $type ) );
    }
    
    public function Getefectx( $idvlv )
    {
        return $this->provider->fetchResultSet( "SELECT * FROM p_villages WHERE id=%s", array( $idvlv ) );
    }
    
    public function Getefecttreasury( )
    {
       
                $ss = $this->provider->fetchResultSet( "SELECT * FROM p_villages WHERE is_artefact=1" );
                return $ss;
    }
    
     public function Getefectshow( $idvlv )
    {
        return $this->provider->fetchResultSet( "SELECT * FROM p_villages WHERE is_artefact = 1, id=%s", array( $idvlv ) );
    }
    
    public function Getmyefect( $idpl )
    {
        $dd = $this->provider->fetchResultSet( "SELECT * FROM p_villages WHERE is_artefact = 1, player_id=%s", array( $idpl ) );
                return $dd;
    }

}

?>