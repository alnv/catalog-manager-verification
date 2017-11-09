<?php

namespace CMVerification;

class NotificationTokens {


    public function setCustomTokens( $arrTokens, $arrData, $objModule ) {

        $strVerifySiteId = $objModule->catalogVerificationSite;

        if ( !$strVerifySiteId || !$objModule->catalogVerificationCodeColumn ) return $arrTokens;

        $strVerificationCode = $arrData[ $objModule->catalogVerificationCodeColumn ] ?: '';

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