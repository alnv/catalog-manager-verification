<?php

$GLOBALS['TL_HOOKS']['catalogManagerSetCustomNotificationTokens'][] = [ 'CMVerification\NotificationTokens', 'setCustomTokens' ];
$GLOBALS['TL_HOOKS']['catalogManagerFrontendEditingOnSave'][] = [ 'CMVerification\VerificationSetup', 'setUpAttributesOnDuplication' ];

array_insert( $GLOBALS['TL_CTE'], 4, [

    'catalog-manager-verification' => [

        'catalogEntityVerification' => 'CMVerification\ContentCatalogEntityVerification'
    ]
]);

$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['catalog_manager_verification'] = [

    'ctlg_entity_verified' => [
        
        'recipients' => [ 'admin_email', 'raw_*', 'clean_*' ],
        'email_replyTo' => [ 'admin_email', 'raw_*', 'clean_*' ],
        'email_sender_name' => [ 'admin_email', 'raw_*', 'clean_*' ],
        'email_recipient_cc' => [ 'admin_email', 'raw_*', 'clean_*' ],
        'email_recipient_bcc' => [ 'admin_email', 'raw_*', 'clean_*' ],
        'email_sender_address' => [ 'admin_email', 'raw_*', 'clean_*' ],
        'file_name' => [ 'admin_email', 'raw_*', 'clean_*', 'field_*' ],
        'attachment_tokens' => [ 'raw_*', 'clean_*', 'field_*', 'table_*' ],
        'email_subject' => [ 'admin_email', 'domain', 'raw_*', 'clean_*', 'masterUrl' ],
        'file_content' => [ 'admin_email', 'raw_*', 'clean_*', 'field_*', 'masterUrl' ],
        'email_text' => [ 'admin_email', 'domain', 'raw_*', 'clean_*', 'field_*', 'masterUrl' ],
        'email_html' => [ 'admin_email', 'domain', 'raw_*', 'clean_*', 'field_*', 'masterUrl' ]
    ]
];

$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['catalog_manager']['ctlg_entity_status_insert']['email_html'][] = 'verificationSiteRelative';
$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['catalog_manager']['ctlg_entity_status_insert']['email_html'][] = 'verificationSite';
$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['catalog_manager']['ctlg_entity_status_insert']['email_text'][] = 'verificationSiteRelative';
$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['catalog_manager']['ctlg_entity_status_insert']['email_text'][] = 'verificationSite';
$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['catalog_manager']['ctlg_entity_status_insert']['file_content'][] = 'verificationSiteRelative';
$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['catalog_manager']['ctlg_entity_status_insert']['file_content'][] = 'verificationSite';

$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['catalog_manager']['ctlg_entity_status_duplicate']['email_html'][] = 'verificationSiteRelative';
$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['catalog_manager']['ctlg_entity_status_duplicate']['email_html'][] = 'verificationSite';
$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['catalog_manager']['ctlg_entity_status_duplicate']['email_text'][] = 'verificationSiteRelative';
$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['catalog_manager']['ctlg_entity_status_duplicate']['email_text'][] = 'verificationSite';
$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['catalog_manager']['ctlg_entity_status_duplicate']['file_content'][] = 'verificationSiteRelative';
$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['catalog_manager']['ctlg_entity_status_duplicate']['file_content'][] = 'verificationSite';

$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['catalog_manager']['ctlg_entity_status_update']['email_html'][] = 'verificationSiteRelative';
$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['catalog_manager']['ctlg_entity_status_update']['email_html'][] = 'verificationSite';
$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['catalog_manager']['ctlg_entity_status_update']['email_text'][] = 'verificationSiteRelative';
$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['catalog_manager']['ctlg_entity_status_update']['email_text'][] = 'verificationSite';
$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['catalog_manager']['ctlg_entity_status_update']['file_content'][] = 'verificationSiteRelative';
$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['catalog_manager']['ctlg_entity_status_update']['file_content'][] = 'verificationSite';