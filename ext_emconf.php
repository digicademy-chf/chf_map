<?php
defined('TYPO3') or die();

$EM_CONF[$_EXTKEY] = [
    'title'          => 'CHF Map',
    'description'    => 'Geodata and image maps for research data in TYPO3 as part of the CHF',
    'category'       => 'misc',
    'author'         => 'Jonatan Jalle Steller',
    'author_email'   => 'jonatan.steller@adwmainz.de',
    'author_company' => 'Academy of Sciences and Literature Mainz',
    'state'          => 'beta',
    'version'        => '0.6.0',
    'constraints'    => [
        'depends'   => [
            'typo3' => '13.0.0-13.99.99'
        ],
        'conflicts' => [
        ],
        'suggests'  => [
        ],
    ],
    'autoload'       => [
        'psr-4' => [
           'Digicademy\\CHFMap\\' => 'Classes/'
        ]
     ]
];
