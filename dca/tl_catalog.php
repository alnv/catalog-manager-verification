<?php

$GLOBALS['TL_DCA']['tl_catalog']['palettes']['__selector__'][] = 'useEntityVerification';
$GLOBALS['TL_DCA']['tl_catalog']['subpalettes']['useEntityVerification'] = 'catalogVerificationCodeColumn,catalogIsVerifiedColumn';
$GLOBALS['TL_DCA']['tl_catalog']['palettes']['default'] = str_replace( 'useVC;', 'useVC;{catalog_verification_legend},useEntityVerification;', $GLOBALS['TL_DCA']['tl_catalog']['palettes']['default'] );
$GLOBALS['TL_DCA']['tl_catalog']['palettes']['modifier'] = str_replace( 'useVC;', 'useVC;{catalog_verification_legend},useEntityVerification;', $GLOBALS['TL_DCA']['tl_catalog']['palettes']['modifier'] );

$GLOBALS['TL_DCA']['tl_catalog']['fields']['useEntityVerification'] = [

    'label' => &$GLOBALS['TL_LANG']['tl_catalog']['useEntityVerification'],
    'inputType' => 'checkbox',

    'eval' => [

        'doNotCopy' => true,
        'tl_class' => 'clr',
        'submitOnChange' => true
    ],

    'exclude' => true,
    'sql' => "char(1) NOT NULL default ''"
];

$GLOBALS['TL_DCA']['tl_catalog']['fields']['catalogVerificationCodeColumn'] = [

    'label' => &$GLOBALS['TL_LANG']['tl_catalog']['catalogVerificationCodeColumn'],
    'inputType' => 'select',

    'eval' => [

        'chosen' => true,
        'maxlength' => 128,
        'tl_class' => 'w50',
        'mandatory' => true,
        'doNotCopy' => true,
        'blankOptionLabel' => '-',
        'includeBlankOption'=>true
    ],

    'options_callback' => [ 'CMVerification\DcHelpers', 'getColumns' ],
    'exclude' => true,
    'sql' => "varchar(128) NOT NULL default ''"
];

$GLOBALS['TL_DCA']['tl_catalog']['fields']['catalogIsVerifiedColumn'] = [

    'label' => &$GLOBALS['TL_LANG']['tl_catalog']['catalogIsVerifiedColumn'],
    'inputType' => 'select',

    'eval' => [

        'chosen' => true,
        'maxlength' => 128,
        'tl_class' => 'w50',
        'mandatory' => true,
        'doNotCopy' => true,
        'blankOptionLabel' => '-',
        'includeBlankOption'=>true
    ],

    'options_callback' => [ 'CMVerification\DcHelpers', 'getColumns' ],
    'exclude' => true,
    'sql' => "varchar(128) NOT NULL default ''"
];