<?php

/** @noinspection PhpUndefinedVariableInspection */
$EM_CONF[$_EXTKEY] = [
    'title' => 'Cute Mailing ttaddress',
    'description' => 'A TYPO3 extension that connects tt_address and cute-mailing.',
    'category' => 'plugin',
    'author' => 'undkonsorten',
    'author_email' => 'kontakt@undkonsorten.com',
    'state' => 'stable',
    'version' => '2.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '11.5.0-11.5.99',
            'cute_mailing' => '3.0.0-3.99.99',
            'tt_address' => '5.2.0-7.99.99',
        ],
    ],
];
