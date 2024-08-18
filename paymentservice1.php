<?php

require( ".".DIRECTORY_SEPARATOR."t5rg".DIRECTORY_SEPARATOR."boot.php" );
require_once( MODEL_PATH."payment.php" );
class GPage extends WebService
{

    public function load( )
    {
        $AppConfig = $GLOBALS['AppConfig'];
        if ( $this->isPost( ) )
        {
            $usedPackage = NULL;
            foreach ( $AppConfig['plus']['packages'] as $package )
            {
                if ( $package['cost'] == $_POST['amount'] )
                {
                    $usedPackage = $package;
                }
            }
            $merchant_id = $AppConfig['plus']['payments']['cashu']['merchant_id'];
            $usedPayment = NULL;
            foreach ( $AppConfig['plus']['payments'] as $payment )
            {
                if ( $payment['merchant_id'] == $merchant_id )
                {
                    $usedPayment = $payment;
                }
            }
            if ( !isset( $_GET[$usedPayment['currency']] ) )
            {
                return;
            }
            if ( $usedPackage != NULL && $usedPayment != NULL && $_POST['token'] == md5( sprintf( "%s:%s:%s:%s", $merchant_id, $_POST['amount'], strtolower( $_POST['currency'] ), $_POST['test_mode'] ? $usedPayment['testKey'] : $usedPayment['key'] ) ) )
            {
                $playerId = base64_decode( $_POST['session_id'] );
                $goldNumber = $usedPackage['gold'];
                $m = new PaymentModel( );
                $m->incrementPlayerGold( $playerId, $goldNumber );
                $m->dispose( );
                echo "<h2> © йЦй зЦАМи гАтяга хДлгм,тъяг Аъ</h2>";
            }
            else
            {
                echo "<h2>АЦ ййЦ зЦАМи гАтяга хДлгм , МялЛ ЦягсАи гАозЦ</h2>";
            }
        }
    }

}

$p = new GPage( );
$p->run( );
?>
