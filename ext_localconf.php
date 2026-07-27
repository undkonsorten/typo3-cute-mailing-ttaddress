<?php

declare(strict_types=1);

use Undkonsorten\CuteMailingTtAddress\Updates\ConvertRecipientListToTtAddressUpdateWizard;

if (!defined('TYPO3')) {
    die('Access denied.');
}
call_user_func(
    function ($extKey = 'cute_mailing_registeraddress') {
        $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update']['cuteMailing_ttAddressConvertWizard']
            = ConvertRecipientListToTtAddressUpdateWizard::class;
    }

);

