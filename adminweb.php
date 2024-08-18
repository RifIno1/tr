<?php

require( ".".DIRECTORY_SEPARATOR."t5rg".DIRECTORY_SEPARATOR."boot.php" );
require_once( MODEL_PATH."news.php" );
require_once( MODEL_PATH."advertising.php" );
require_once( MODEL_PATH."controlmember.php" );
require_once( MODEL_PATH."badwords.php" );
require_once( MODEL_PATH."wordsfilter.php" );
require_once( MODEL_PATH."payhis.php" );
class GPage  extends securegamepage
{

    public $saved = NULL;
    public $siteNews = NULL;
    public $isAdmin = FALSE;
    public $Advertisings = array( );
    public $Meber = array( );
    public $pageSize = 20;
    public $pageIndex = NULL;
    public $pageCount = NULL;
    public function GPage( )
    {
        parent::securegamepage( );
        $this->viewFile = "adminweb.phtml";
if ($_GET['t'] == 5) {
        $this->contentCssClass = "plus";
    } else {
        $this->contentCssClass = "messages";

} }

    public function load( )
    {
        parent::load( );
        $type = 'cashu';
        $m = new Payhis();
        $this->dataList = $m->PayhisByType($type);
        $payhistotal = $m->getTotalMoney();
        if ( $this->data['player_type'] != PLAYERTYPE_ADMIN )
        {
            exit( 0 );
        }
        else
        {
            $this->selectedTabIndex = ((((isset($_GET['t']) && is_numeric($_GET['t'])) && 0 <= intval($_GET['t'])) && intval($_GET['t']) <= 9) ? intval($_GET['t']) : 0);
            if ($this->selectedTabIndex == 0)
            {
            $m = new NewsModel( );
            $this->saved = FALSE;
            if ( $this->isPost( ) && isset( $_POST['news'] ) )
            {
                $this->siteNews = $_POST['news'];
                $this->saved = TRUE;
                $m->setSiteNews( $this->siteNews );
            }
            else
            {
                $this->siteNews = $m->getSiteNews( );
            }
            $m->dispose( );
        }
}
            if ($this->selectedTabIndex == 1)
            {

            $m = new NewsModel( );
            $this->saved = FALSE;
            if ( $this->isPost( ) && isset( $_POST['news'] ) )
            {
                $this->siteNews = $_POST['news'];
                $this->saved = TRUE;
                $m->setGlobalPlayerNews( $this->siteNews );
            }
            else
            {
                $this->siteNews = $m->getGlobalSiteNews( );
            }
            $m->dispose( );
}
            if ($this->selectedTabIndex == 3)
            {
        $this->pageIndex = isset( $_GET['p'] ) && is_numeric( $_GET['p'] ) ? intval( $_GET['p'] ) : 0;
            $m = new BadWordsModel( );
            $rowsCount = $m->getBadWordsCount( );
            $this->pageCount = 0 < $rowsCount ? ceil( $rowsCount / $this->pageSize ) : 1;
            if ( isset( $_GET['Dword'] ) && !empty( $_GET['Dword'] ) )
            {
                $wordID = mysql_real_escape_string( trim( $_GET['Dword'] ) );
                if ( $wordID != "" )
                {
                    $m->DeleteBadWords( $wordID );
                    $m->dispose( );
                    $this->redirect( "adminweb.php?t=3" );
                }
            }
            else if ( $this->isPost( ) )
            {
                $i = 0;
                while ( $i < count( $_POST['words'] ) )
                {
                    $words = mysql_real_escape_string( trim( $_POST['words'][$i] ) );
                    $replace = mysql_real_escape_string( trim( $_POST['replace'][$i] ) );
                    if ( $words != "")
                    {
                                                                                        if ($replace == "")
                                                                                                $replace = " ";
                                                                                        $this->BadWords[] = $words;
                                                                                        $this->Repl[] = $replace;
                                                                                }
                                                                                ++$i;
                }
                $m->addBadWords( $this->BadWords, $this->Repl );
                $m->dispose( );
                $this->redirect( "adminweb.php?t=3" );
            }
            else
            {
                $this->BadWords = $m->GetBadWords( $this->pageIndex, $this->pageSize );
                $m->dispose( );
            }
}
            if ($this->selectedTabIndex == 4)
            {
        $this->pageIndex = isset( $_GET['p'] ) && is_numeric( $_GET['p'] ) ? intval( $_GET['p'] ) : 0;
            $m = new ControlMemberModel( );
            $rowsCount = $m->getMeberCount( );
            $this->pageCount = 0 < $rowsCount ? ceil( $rowsCount / $this->pageSize ) : 1;
                $this->Meber = $m->GetMeber( $this->pageIndex, $this->pageSize, $this->GoldNumMeber );
                $m->dispose( );
}
            if ($this->selectedTabIndex == 2)
            {
        $this->pageIndex = isset( $_GET['p'] ) && is_numeric( $_GET['p'] ) ? intval( $_GET['p'] ) : 0;
            $m = new AdvertisingModel( );
            $rowsCount = $m->getAdvertisingCount( );
            $this->pageCount = 0 < $rowsCount ? ceil( $rowsCount / $this->pageSize ) : 1;
            if ( isset( $_GET['DAdv'] ) && !empty( $_GET['DAdv'] ) )
            {
                $advID = mysql_real_escape_string( trim( $_GET['DAdv'] ) );
                if ( $advID != "" )
                {
                    $m->DeleteAdvertising( $advID );
                    $m->dispose( );
                    $this->redirect( "adminweb.php?t=2" );
                }
            }
            else if ( $this->isPost( ) )
            {
                $post = array( );
                $type = isset( $_POST['do'] ) && $_POST['do'] != "add" ? "edit" : "add";
                $post['name'] = isset( $_POST['name'] ) && $_POST['name'] != "" ? mysql_real_escape_string( trim( $_POST['name'] ) ) : "جي وار";
                $post['url'] = isset( $_POST['url'] ) && $_POST['url'] != "" ? mysql_real_escape_string( trim( $_POST['url'] ) ) : "http://www.tatarzx.com";
                $post['cat'] = isset( $_POST['cat'] ) && $_POST['cat'] != "" ? mysql_real_escape_string( trim( $_POST['cat'] ) ) : "1";
                $post['image'] = isset( $_POST['image'] ) && $_POST['image'] != "" ? mysql_real_escape_string( trim( $_POST['image'] ) ) : "assets/default/img/characters.png";
                $ext = strtolower( end( explode( ".", mysql_real_escape_string( trim( $post['image'] ) ) ) ) );
                $post['type'] = $ext == "swf" ? "flash" : "image";
                $post['ID'] = isset( $_POST['ID'] ) && $_POST['ID'] != "" ? mysql_real_escape_string( trim( $_POST['ID'] ) ) : 0;
                $m->Advertising( $post, $type );
                $m->dispose( );
                $this->redirect( "adminweb.php?t=2" );
            }
            else
            {
                $this->Advertisings = $m->GetAdvertisings( $this->pageIndex, $this->pageSize );
                $m->dispose( );
            }
        }
    }
    public function getNextLink( )
    {
        $text = text_nextpage_lang." »";
        if ( $this->pageIndex + 1 == $this->pageCount )
        {
            return $text;
        }
        $link = "p=".( $this->pageIndex + 1 );
        $link = "&".$link;
        return "<a href=\"?t=".$this->selectedTabIndex."".$link."\">".$text."</a>";
    }

    public function getPreviousLink( )
    {
        $text = "« ".text_prevpage_lang;
        if ( $this->pageIndex == 0 )
        {
            return $text;
        }
        $link = "";
        if ( 0 < $this->pageIndex )
        {
            if ( $link != "" )
            {
                $link .= "&";
            }
            $link .= "p=".( $this->pageIndex - 1 );
        }
        if ( $link != "" )
        {
            $link = "&".$link;
        }
        $link = "?t=".$this->selectedTabIndex."".$link;
        return "<a href=\"".$link."\">".$text."</a>";
    }

}


$p = new GPage( );
$p->run( );
?>