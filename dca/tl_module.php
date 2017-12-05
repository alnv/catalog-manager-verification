<?php

$GLOBALS['TL_DCA']['tl_module']['palettes']['__selector__'][] = 'catalogEnableEntityVerification';
$GLOBALS['TL_DCA']['tl_module']['subpalettes']['catalogEnableEntityVerification'] = 'catalogVerifyOnActTypes,catalogVerificationSite';
$GLOBALS['TL_DCA']['tl_module']['palettes']['catalogUniversalView'] = str_replace( 'catalogUseFrontendEditingViewPage;', 'catalogUseFrontendEditingViewPage;{catalog_verification_legend},catalogEnableEntityVerification;', $GLOBALS['TL_DCA']['tl_module']['palettes']['catalogUniversalView'] );

$GLOBALS['TL_DCA']['tl_module']['fields']['catalogEnableEntityVerification'] = [

    'label' => &$GLOBALS['TL_LANG']['tl_module']['catalogEnableEntityVerification'],
    'inputType' => 'checkbox',

    'eval' => [

        'doNotCopy' => true,
        'tl_class' => 'clr',
        'submitOnChange' => true,
    ],

    'exclude' => true,
    'sql' => "char(1) NOT NULL default ''"
];

$GLOBALS['TL_DCA']['tl_module']['fields']['catalogVerificationSite'] = [

    'label' => &$GLOBALS['TL_LANG']['tl_module']['catalogVerificationSite'],
    'inputType' => 'pageTree',

    'eval' => [

        'tl_class' => 'clr',
        'mandatory' => true,
        'fieldType' => 'radio',
    ],

    'foreignKey' => 'tl_page.title',

    'relation' => [

        'load' => 'lazy',
        'type' => 'hasOne'
    ],

    'exclude' => true,
    'sql' => "int(10) unsigned NOT NULL default '0'"
];

$GLOBALS['TL_DCA']['tl_module']['fields']['catalogVerifyOnActTypes'] = [

    'label' => &$GLOBALS['TL_LANG']['tl_module']['catalogVerifyOnActTypes'],
    'inputType' => 'checkbox',

    'eval' => [

        'multiple' => true,
        'maxlength' => 512,
        'tl_class' => 'clr',
        'mandatory' => true,
        'doNotCopy' => true
    ],

    'reference' => $GLOBALS['TL_LANG']['tl_module']['reference']['catalogVerifyOnActTypes'],
    'options' => [ 'create', 'edit', 'copy' ],
    'exclude' => true,
    'sql' => "varchar(512) NOT NULL default ''"
];