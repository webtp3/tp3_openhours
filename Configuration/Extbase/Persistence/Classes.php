<?php
declare(strict_types = 1);


return [
    \FriendsOfTYPO3\TtAddress\Domain\Model\Address::class => [
        'tableName' => 'tt_address',
        'recordType' => \Tp3\Tp3Openhours\Domain\Model\TtAddress::class,
        'subclasses' => [
             \Tp3\Tp3Openhours\Domain\Model\OpenHour::class
            ]
    ],
    \Tp3\Tp3Openhours\Domain\Model\OpenHour::class => [
        'tableName' => 'tx_tp3openhours_domain_model_openhour',

    ],
];
