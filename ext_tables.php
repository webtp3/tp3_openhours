<?php

/*
 * This file is part of the web-tp3/tp3openhours.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

defined('TYPO3_MODE') || die('Access denied.');
$_EXTKEY = 'tp3_openhours';
call_user_func(

    function ($_EXTKEY) {

        /* Add the flexforms to the TCA */
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_tp3openhours_domain_model_openhour', 'EXT:tp3_openhours/Resources/Private/Language/locallang_csh_tx_tp3openhours_domain_model_openhour.xlf');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_tp3openhours_domain_model_openhour');
    },
    $_EXTKEY
);
