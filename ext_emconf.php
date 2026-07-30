<?php

declare(strict_types=1);

/** @noinspection PhpUndefinedVariableInspection */
$EM_CONF[$_EXTKEY] = [
    'title' => 'Cute Mailing ttaddress',
    'description' => 'A TYPO3 extension that connects tt_address and cute-mailing.',
    'category' => 'plugin',
    'author' => 'undkonsorten',
    'author_email' => 'kontakt@undkonsorten.com',
    'state' => 'stable',
    'version' => '2.4.1',
    'constraints' => [
        'depends' => [
            'typo3' => '11.5.0-14.3.99',
            'cute_mailing' => '4.0.0-4.99.99',
            'tt_address' => '5.2.0-9.99.99',
        ],
    ],
];
