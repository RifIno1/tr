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
            if ( isset( $_POST['session_id'] ) )
            {
                $merchant_id = $AppConfig['plus']['payments']['cashu']['merchant_id'];
            }
            else
            {
                $merchant_id = $AppConfig['plus']['payments']['onecard']['merchant_id'];
                $key = $merchant_id.$_POST['OneCard_TransID'].$_POST['OneCard_Amount'].$_POST['OneCard_Currency'].$_POST['OneCard_RTime'].$payment['plus']['payments']['cashu']['testKey'].$_POST['OneCard_Code'];
                $token = md5( $key );
                if ( $usedPackage != NULL && $_POST['OneCard_Code'] == "00" && $_POST['OneCard_RHashKey'] == $token )
                {
                    $playerId = base64_decode( $_POST['OneCard_Field1'] );
                    $goldNumber = $usedPackage['gold'];
                    $m = new PaymentModel( );
                    $m->incrementPlayerGold( $playerId, $goldNumber );
                    $m->dispose( );
                                    $m = new PaymentModel();
                $m->InsertMoneyLog( $transID, $usernam, $goldNumber, $cost, $currency, $type );

                $userid = $m->getPlayerDataById ($playerId);
                $usernam = $userid['name'];
                $name = "الادارة";
                require_once( MODEL_PATH."msg.php" );
                $mm = new MessageModel( );
                        $subject = "تمت العمليه الشرائيه بنجاح ! تهانينا";
$message = 'أهلا وسهلآ   '.$usernam.',

لقد تم شحن ذهب بقيمة '.$cost.' مقابل '.$goldNumber.' من الذهب وتمت العمليه بنجاح.

مع فائق الإحترام.

الادارة';
                $messageId = $mm->sendMessage( 1, $name, $playerId, $usernam, $subject, $message );
                $quizArray[] = $messageId;
                echo "<h2> تمت عملية الشراء بنجاح,شكرا لك</h2>";
            }
            else
            {
                echo "<h2>لم تتم عملية الشراء بنجاح , يرجى مراسلة الدعم</h2>";
                }
                $p = new GPage( );
                $p->run( );
                return;
            }
            $usedPayment = NULL;
            foreach ( $AppConfig['plus']['payments'] as $payment )
            {
                if ( $payment['merchant_id'] == $merchant_id )
                {
                    $usedPayment = $payment;
                }
            }
            if ( !isset( $_GET[$usedPayment['returnKey']] ) )
            {
                return;
            }
            if ( $usedPackage != NULL && $usedPayment != NULL && $_POST['token'] == md5( sprintf( "%s:%s:%s:%s", $merchant_id, $_POST['amount'], strtolower( $_POST['currency'] ), $_POST['test_mode'] ? $usedPayment['testKey'] : $usedPayment['key'] ) ) )
            {
                $playerId = base64_decode( $_POST['session_id'] );
                $goldNumber = $usedPackage['gold'];
                $transID = $_POST['trn_id'];
                $m = new PaymentModel();
                $userid = $m->getPlayerDataById ($playerId);
                $usernam = $userid['name'];
                $usernam = $userid['name'];
                $cost = $_POST['amount'];
                $currency = $_POST['currency'];
                $type = 'cashu';
                $m = new PaymentModel( );
                $m->incrementPlayerGold( $playerId, $goldNumber );
                $m->dispose( );
                $m = new PaymentModel();
                $m->InsertMoneyLog( $transID, $usernam, $goldNumber, $cost, $currency, $type );
                 $m->updatetotalcashu( $goldNumber, $cost );

                $userid = $m->getPlayerDataById ($playerId);
                $usernam = $userid['name'];
                $name = "الادارة";
                require_once( MODEL_PATH."msg.php" );
                $mm = new MessageModel( );
                        $subject = "تمت العمليه الشرائيه بنجاح ! تهانينا";
$message = 'أهلا وسهلآ   '.$usernam.',

لقد تم شحن ذهب بقيمة '.$cost.' مقابل '.$goldNumber.' من الذهب وتمت العمليه بنجاح.

مع فائق الإحترام.

الادارة';
                $messageId = $mm->sendMessage( 1, $name, $playerId, $usernam, $subject, $message );
                $quizArray[] = $messageId;
                echo "<h2> تمت عملية الشراء بنجاح,شكرا لك</h2>";
            }
            else
            {
                echo "<h2>لم تتم عملية الشراء بنجاح , يرجى مراسلة الدعم</h2>";
            }
        }
    }
}
$p = new GPage( );
$p->run( );
?>
