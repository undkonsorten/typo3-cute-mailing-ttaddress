<?php
declare(strict_types = 1);


use Undkonsorten\CuteMailing\Domain\Model\RecipientList;
use Undkonsorten\CuteMailingTtAddress\Domain\Model\TtAddressRecipient;
use Undkonsorten\CuteMailingTtAddress\Domain\Model\TtAddressRecipientList;

return [

    \FriendsOfTYPO3\TtAddress\Domain\Model\Address::class => [
        'subclasses' => [
            TtAddressRecipient::class => TtAddressRecipient::class,

        ]
    ],
    TtAddressRecipient::class=> [
        'tableName' => 'tt_address',
        'recordType' => TtAddressRecipient::class
    ],
    TtAddressRecipientList::class => [
        'tableName' => 'tx_cutemailing_domain_model_recipientlist',
        'recordType' => TtAddressRecipientList::class
    ],
    RecipientList::class => [
        'tableName' => 'tx_cutemailing_domain_model_recipientlist',
        'subclasses' => [
            TtAddressRecipientList::class => TtAddressRecipientList::class,
        ]
    ],
];
