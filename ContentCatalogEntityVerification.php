<?php

namespace CMVerification;

use CatalogManager\CatalogFieldBuilder as CatalogFieldBuilder;
use CatalogManager\Toolkit as Toolkit;

class ContentCatalogEntityVerification extends \ContentElement {


    protected $strTemplate = 'ce_verification_message';


    public function generate() {
        
        if ( TL_MODE == 'BE' ) {

            $objTemplate = new \BackendTemplate('be_wildcard');
            $objTemplate->wildcard = '### ' . utf8_strtoupper( $GLOBALS['TL_LANG']['CTE']['catalogEntityVerification'][0] ) . ' ###';
            
            return $objTemplate->parse();
        }

        return parent::generate();
    }


    protected function compile() {

        $strVerificationCode = \Input::get('auto_item');
        $objModule = $this->Database->prepare('SELECT * FROM tl_module WHERE id = ?')->execute( $this->catalogUniversalViewID );

        if ( !$strVerificationCode || !$objModule->numRows ) {

            global $objPage;

            $objHandler = new $GLOBALS['TL_PTY']['error_403']();
            $objHandler->generate( $objPage->id );

            exit;
        }

        $arrEntity = [];
        $strMasterUrl = '';
        $blnSuccess = false;
        $strOutput = $this->catalogDefaultVerificationMessage;
        $objEntity = $this->Database->prepare( sprintf('SELECT * FROM %s WHERE %s = ? AND %s = ?', $objModule->catalogTablename, $objModule->catalogVerificationCodeColumn, $objModule->catalogIsVerifiedColumn ) )->limit(1)->execute( $strVerificationCode, '' );
        $blnExist =  $objEntity->numRows ? true : false;
        $arrRow = $objEntity->row();

        if ( $blnExist ) {

            $arrTokens = [];
            $blnSuccess = true;

            $this->Database->prepare( sprintf('UPDATE %s SET %s = ? WHERE id = ?', $objModule->catalogTablename, $objModule->catalogIsVerifiedColumn) )->execute( '1', $objEntity->id );

            $objFieldBuilder = new CatalogFieldBuilder();
            $objFieldBuilder->initialize( $objModule->catalogTablename );
            $arrFields = $objFieldBuilder->getCatalogFields( true, null, false, true );

            $strMasterUrl = $this->getMasterUrl( $arrRow['alias'] );
            $arrEntity = Toolkit::parseCatalogValues( $arrRow, $arrFields );

            foreach ( $arrRow as $strKey => $varValue ) $arrTokens[ 'raw_' . $strKey ] = $varValue;
            foreach ( $arrEntity as $strKey => $varValue ) $arrTokens[ 'clean_' . $strKey ] = $varValue;
            foreach ( $arrFields as $strKey => $varValue ) $arrTokens[ 'field_' . $strKey  ] = $varValue;

            $arrTokens['masterUrl'] = $strMasterUrl;

            $this->notify( $arrTokens );
        }

        if ( $this->catalogAfterVerificationHandlerType == 'staticRedirect' ) {

            \Controller::redirectToFrontendPage( $this->catalogAfterVerificationRedirect );
        }

        if ( $this->catalogAfterVerificationHandlerType == 'detailRedirect' ) {

            \Controller::redirect( $strMasterUrl );
        }

        if ( $this->catalogAfterVerificationHandlerType == 'message' && $blnSuccess ) {

            $strOutput = $this->catalogAfterVerificationMessage;
        }

        $this->Template->masterUrl = $strMasterUrl;
        $this->Template->entityExist = $blnExist;
        $this->Template->success = $blnSuccess;
        $this->Template->output = $strOutput;
        $this->Template->entity = $arrEntity;
        $this->Template->origin = $arrRow;
    }


    protected function notify( $arrTokens ) {

        $blnEnable = ( class_exists( 'NotificationCenter\Model\Notification' ) && $this->Database->tableExists( 'tl_nc_notification' ) );

        if ( !$blnEnable ) return null;

        $objNotification = \NotificationCenter\Model\Notification::findByPk( $this->catalogNotificationID );

        if ( $objNotification === null ) {

            $this->log( 'The notification was not found ID ' . $this->catalogNotificationID , __METHOD__, TL_ERROR );

            return null;
        }

        $arrTokens[ 'domain' ] = $this->getDomain();
        $arrTokens[ 'admin_email' ] = $this->getAdminEmail();

        $objNotification->send( $arrTokens, $GLOBALS['TL_LANGUAGE'] );
    }


    protected function getAdminEmail() {

        return $GLOBALS['TL_ADMIN_EMAIL'];
    }


    protected function getDomain() {

        return \Idna::decode( \Environment::get('host') );
    }


    protected function getMasterUrl( $strAlias ) {

        $objPage = \PageModel::findWithDetails( $this->catalogAfterVerificationRedirect );

        if ( $objPage == null ) return '';

        return $this->generateFrontendUrl( $objPage->row(), '/' . $strAlias );
    }
}