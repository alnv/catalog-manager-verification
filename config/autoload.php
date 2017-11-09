<?php

ClassLoader::addNamespace( 'CMVerification' );

ClassLoader::addClasses([

    'CMVerification\ContentCatalogEntityVerification' => 'system/modules/catalog-manager-verification/ContentCatalogEntityVerification.php',
    'CMVerification\NotificationTokens' => 'system/modules/catalog-manager-verification/NotificationTokens.php',
    'CMVerification\VerificationSetup' => 'system/modules/catalog-manager-verification/VerificationSetup.php',
    'CMVerification\DcHelpers' => 'system/modules/catalog-manager-verification/DcHelpers.php'
 ]);

TemplateLoader::addFiles([

    'ce_verification_message' => 'system/modules/catalog-manager-verification/templates'
]);