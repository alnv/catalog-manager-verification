<?php

namespace CMVerification;

use CatalogManager\CatalogFieldBuilder as CatalogFieldBuilder;
use CatalogManager\Toolkit as Toolkit;

class DcHelpers extends \Backend {


    public function getColumns( \DataContainer $dc ) {

        $arrReturn = [];
        $arrForbiddenTypes = [ 'upload' ];
        $strTablename = $dc->activeRecord->catalogTablename;

        if ( Toolkit::isEmpty( $strTablename ) ) return $arrReturn;

        $objFieldBuilder = new CatalogFieldBuilder();
        $objFieldBuilder->initialize( $strTablename );
        $arrFields = $objFieldBuilder->getCatalogFields( true, null );

        foreach ( $arrFields as $strFieldname => $arrField ) {

            if ( in_array( $arrField['type'], Toolkit::columnOnlyFields() ) ) continue;
            if ( in_array( $arrField['type'], Toolkit::excludeFromDc() ) ) continue;
            if ( in_array( $arrField['type'], $arrForbiddenTypes ) ) continue;

            $arrReturn[ $strFieldname ] = Toolkit::getLabelValue( $arrField['_dcFormat']['label'], $strFieldname );
        }

        return $arrReturn;
    }


    public function getViewIDs() {

        $arrReturn = [];
        $objList = $this->Database->prepare('SELECT * FROM tl_module WHERE type = ? AND catalogEnableEntityVerification = ? AND catalogEnableFrontendEditing = ?')->execute( 'catalogUniversalView', '1', '1' );

        if ( !$objList->numRows ) return $arrReturn;

        while ( $objList->next() ) {

            $arrReturn[ $objList->id ] = $objList->name ? $objList->name : $objList->catalogTablename;
        }

        return $arrReturn;
    }


    public function getNotificationChoices( \DataContainer $dc ) {

        $strWhere = '';
        $arrValues = [];
        $arrChoices = [];

        if ( !$this->Database->tableExists( 'tl_nc_notification' ) ) return [];

        $arrTypes = $GLOBALS['TL_DCA']['tl_content']['fields'][ $dc->field ]['eval']['ncNotificationChoices'];

        if ( !empty( $arrTypes ) && is_array( $arrTypes ) ) {

            $strWhere = ' WHERE ' . implode( ' OR ', array_fill(0, count($arrTypes), 'type=?' ) );
            $arrValues = $arrTypes;
        }

        $objNotifications = $this->Database->prepare( 'SELECT id,title FROM tl_nc_notification' . $strWhere . ' ORDER BY title' )->execute( $arrValues );

        while ( $objNotifications->next() ) {

            $arrChoices[ $objNotifications->id ] = $objNotifications->title;
        }

        return $arrChoices;
    }


    public function getCustomVerificationTemplates() {

        return $this->getTemplateGroup('ce_verification_');
    }
}