<?php

namespace CMVerification;

use CatalogManager\Toolkit as Toolkit;

class VerificationSetup extends \Frontend{
    
    public function setUpVerificationAttributes($arrValues, $strAct, $arrCatalog, $arrCatalogFields, $objFrontendEditing ) {

        if ( !$objFrontendEditing->catalogEnableEntityVerification ) return $arrValues;

        $arrActTypes = Toolkit::deserialize( $objFrontendEditing->catalogVerifyOnActTypes );
        $objCatalog = $this->Database->prepare('SELECT * FROM tl_catalog WHERE tablename = ?')->limit(1)->execute( $objFrontendEditing->catalogTablename );

        if ( Toolkit::isEmpty( $objCatalog->catalogVerificationCodeColumn ) || Toolkit::isEmpty( $objCatalog->catalogIsVerifiedColumn ) ) return $arrValues;
        if ( !is_array( $arrActTypes ) && empty( $arrActTypes ) ) return $arrValues;

        if ( in_array( $strAct, $arrActTypes ) ) {

            $strCode = uniqid();

            $arrValues[ $objCatalog->catalogVerificationCodeColumn ] = md5( $strCode );
            $arrValues[ $objCatalog->catalogIsVerifiedColumn ] = '';
        }

        return $arrValues;
    }
}