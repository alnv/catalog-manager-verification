<?php

$GLOBALS['TL_DCA']['tl_content']['palettes']['__selector__'][] = 'catalogAfterVerificationHandlerType';
$GLOBALS['TL_DCA']['tl_content']['subpalettes']['catalogAfterVerificationHandlerType_message'] = 'catalogAfterVerificationMessage';
$GLOBALS['TL_DCA']['tl_content']['subpalettes']['catalogAfterVerificationHandlerType_staticRedirect'] = 'catalogAfterVerificationRedirect';
$GLOBALS['TL_DCA']['tl_content']['subpalettes']['catalogAfterVerificationHandlerType_detailRedirect'] = 'catalogAfterVerificationRedirect';
$GLOBALS['TL_DCA']['tl_content']['palettes']['catalogEntityVerification'] = '{type_legend},type,headline;{catalog_verification_legend},catalogUniversalViewID,catalogNotificationID,catalogDefaultVerificationMessage,catalogAfterVerificationHandlerType;{template_legend:hide},catalogVerificationCustomTpl;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space;{invisible_legend:hide},invisible,start,stop';

$GLOBALS['TL_DCA']['tl_content']['fields']['catalogUniversalViewID'] = [

    'label' => &$GLOBALS['TL_LANG']['tl_content']['catalogUniversalViewID'],
    'inputType' => 'select',

    'eval' => [

        'chosen' => true,
        'maxlength' => 128,
        'tl_class' => 'w50',
        'mandatory' => true,
        'doNotCopy' => true,
        'submitOnChange' => true,
        'blankOptionLabel' => '-',
        'includeBlankOption'=>true
    ],
    
    'options_callback' => [ 'CMVerification\DcHelpers', 'getViewIDs' ],
    'exclude' => true,
    'sql' => "varchar(128) NOT NULL default ''"
];

$GLOBALS['TL_DCA']['tl_content']['fields']['catalogNotificationID'] = [

    'label' => &$GLOBALS['TL_LANG']['tl_content']['catalogNotificationID'],
    'inputType' => 'select',

    'eval' => [

        'chosen' => true,
        'tl_class' => 'w50',
        'includeBlankOption' => true,
        'ncNotificationChoices' => [ 'ctlg_entity_verified' ]
    ],

    'options_callback' => [ 'CMVerification\DcHelpers', 'getNotificationChoices' ],

    'relation' => [

        'load'=>'lazy',
        'type'=>'hasOne',
        'table'=>'tl_nc_notification'
    ],

    'exclude' => true,
    'sql' => "int(10) unsigned NOT NULL default '0'"
];

$GLOBALS['TL_DCA']['tl_content']['fields']['catalogAfterVerificationHandlerType'] = [

    'label' => &$GLOBALS['TL_LANG']['tl_content']['catalogAfterVerificationHandlerType'],
    'inputType' => 'radio',
    'default' => 'message',

    'eval' => [

        'maxlength' => 128,
        'tl_class' => 'clr',
        'doNotCopy' => true,
        'submitOnChange' => true,
    ],

    'reference' => &$GLOBALS['TL_LANG']['tl_content']['reference']['catalogAfterVerificationHandlerType'],
    'options' => [ 'message', 'staticRedirect', 'detailRedirect' ],
    'exclude' => true,
    'sql' => "varchar(128) NOT NULL default ''"
];

$GLOBALS['TL_DCA']['tl_content']['fields']['catalogAfterVerificationMessage'] = [

    'label' => &$GLOBALS['TL_LANG']['tl_content']['catalogAfterVerificationMessage'],
    'inputType' => 'textarea',

    'eval' => [

        'rte' => 'tinyMCE',
        'tl_class' => 'clr',
        'allowHtml' => true,
        'doNotCopy' => true
    ],

    'exclude' => true,
    'sql' => "varchar(128) NOT NULL default ''"
];

$GLOBALS['TL_DCA']['tl_content']['fields']['catalogAfterVerificationRedirect'] = [

    'label' => &$GLOBALS['TL_LANG']['tl_content']['catalogAfterVerificationRedirect'],
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

$GLOBALS['TL_DCA']['tl_content']['fields']['catalogDefaultVerificationMessage'] = [

    'label' => &$GLOBALS['TL_LANG']['tl_content']['catalogDefaultVerificationMessage'],
    'inputType' => 'textarea',

    'eval' => [

        'rte' => 'tinyMCE',
        'tl_class' => 'clr',
        'allowHtml' => true
    ],

    'exclude' => true,
    'sql' => "varchar(128) NOT NULL default ''"
];

$GLOBALS['TL_DCA']['tl_content']['fields']['catalogVerificationCustomTpl'] = [

    'label' => &$GLOBALS['TL_LANG']['tl_content']['catalogVerificationCustomTpl'],
    'inputType' => 'select',

    'eval' => [

        'includeBlankOption'=>true,
        'tl_class' => 'w50',
        'chosen'=>true
    ],

    'options_callback' => [ 'CMVerification\DcHelpers', 'getCustomVerificationTemplates' ],

    'exclude' => true,
    'sql' => "varchar(128) NOT NULL default ''"
];