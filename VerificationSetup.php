<?php

namespace CMVerification;

use CatalogManager\Toolkit as Toolkit;

class VerificationSetup extends \Frontend{
    
    public function setUpAttributesOnDuplication($arrValues, $strAct, $arrCatalog, $arrCatalogFields, $objFrontendEditing ) {

        if ( !$objFrontendEditing->catalogEnableEntityVerification ) {

            return $arrValues;
        }

        if ( Toolkit::isEmpty( $objFrontendEditing->catalogVerificationCodeColumn ) || Toolkit::isEmpty( $objFrontendEditing->catalogIsVerifiedColumn ) ) {

            return $arrValues;
        }

        $arrActTypes = Toolkit::deserialize( $objFrontendEditing->catalogVerifyOnActTypes );

        if ( !is_array( $arrActTypes ) && empty( $arrActTypes ) ) return $arrValues;

        if ( in_array( $strAct, $arrActTypes ) ) {

            $strCode = uniqid();

            $arrValues[ $objFrontendEditing->catalogVerificationCodeColumn ] = md5( $strCode );
            $arrValues[ $objFrontendEditing->catalogIsVerifiedColumn ] = '';
        }

        return $arrValues;
    }
}