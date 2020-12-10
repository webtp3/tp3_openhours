<?php
defined('TYPO3_MODE') or die();

$GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects'][\FriendsOfTYPO3\TtAddress\Domain\Model\Address::class] = [
    'className' => \Tp3\Tp3Openhours\Domain\Model\TtAddress::class
];
