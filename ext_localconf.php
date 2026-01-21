<?php
defined('TYPO3') or die();
//
//$GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects'][\FriendsOfTYPO3\TtAddress\Domain\Model\Address::class] = [
//    'className' => \Tp3\Tp3Openhours\Domain\Model\TtAddress::class
//];
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Tp3Openhours',
    'ListView',
    [
        \Tp3\Tp3Openhours\Controller\OpenHourController::class => 'list,show',
    ],
    [],
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
);
