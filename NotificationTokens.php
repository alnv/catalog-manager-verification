<?php

namespace CMVerification;

class NotificationTokens extends \Frontend {


    public function setCustomTokens( $arrTokens, $arrData, $objModule ) {

        $strVerifySiteId = $objModule->catalogVerificationSite;
        $objCatalog = $this->Database->prepare('SELECT * FROM tl_catalog WHERE tablename = ?')->limit(1)->execute( $objModule->catalogTablename );

        if ( !$strVerifySiteId || !$objCatalog->catalogVerificationCodeColumn ) return $arrTokens;

        $strVerificationCode = $arrData[ $objCatalog->catalogVerificationCodeColumn ] ?: '';

        if ( !$strVerificationCode ) return $arrTokens;

        $arrTokens['verificationSiteRelative'] = $this->getVerificationUrl( $strVerifySiteId, $strVerificationCode );
        $arrTokens['verificationSite'] = \Idna::decode( \Environment::get('base') ) . $this->getVerificationUrl( $strVerifySiteId, $strVerificationCode );

        return $arrTokens;
    }


    protected function getVerificationUrl( $strVerifyId, $strVerificationCode ) {

        $objPage = \PageModel::findWithDetails( $strVerifyId );

        if ( $objPage == null ) return '';

        return \Controller::generateFrontendUrl( $objPage->row(), '/' . $strVerificationCode );
    }
}