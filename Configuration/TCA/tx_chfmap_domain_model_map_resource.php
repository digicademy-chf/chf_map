<?php

# This file is part of the extension CHF Map for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


/**
 * MapResource and its properties
 * 
 * Configuration of a database table and its editing interface in the
 * TYPO3 backend. This also serves as the basis for the Extbase
 * domain model. For more information on TCA and its options see
 * https://docs.typo3.org/m/typo3/reference-tca/main/en-us/.
 */
return [
    'ctrl' => [
        'title'                    => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:database.mapResource',
        'label'                    => 'title',
        'label_alt'                => 'uri',
        'descriptionColumn'        => 'description',
        'tstamp'                   => 'tstamp',
        'crdate'                   => 'crdate',
        'delete'                   => 'deleted',
        'sortby'                   => 'sorting',
        'default_sortby'           => 'title ASC,uri ASC',
        'versioningWS'             => true,
        'iconfile'                 => 'EXT:chf_map/Resources/Public/Icons/MapResource.svg',
        'origUid'                  => 't3_origuid',
        'hideAtCopy'               => true,
        'languageField'            => 'sys_language_uid',
        'transOrigPointerField'    => 'l18n_parent',
        'transOrigDiffSourceField' => 'l18n_diffsource',
        'translationSource'        => 'l10n_source',
        'searchFields'             => 'title,description,uri',
        'enablecolumns'            => [
            'disabled' => 'hidden',
            'fe_group' => 'fe_group',
        ],
    ],
    'columns' => [
        'hidden' => [
            'exclude' => true,
            'label'   => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.enabled',
            'config'  => [
                'type'       => 'check',
                'renderType' => 'checkboxToggle',
                'items'      => [
                    [
                        'label' => '',
                        'invertStateDisplay' => true,
                    ]
                ],
            ]
        ],
        'fe_group' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.fe_group',
            'config' => [
                'type'       => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'size'       => 5,
                'maxitems'   => 20,
                'items'      => [
                    [
                        'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.hide_at_login',
                        'value' => -1,
                    ],
                    [
                        'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.any_login',
                        'value' => -2,
                    ],
                    [
                        'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.usergroups',
                        'value' => '--div--',
                    ],
                ],
                'exclusiveKeys' => '-1,-2',
                'foreign_table' => 'fe_groups',
            ],
        ],
        'sys_language_uid' => [
            'exclude' => true,
            'label'   => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
            'config'  => [
                'type' => 'language',
            ],
        ],
        'l18n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'label'       => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
            'config'      => [
                'type'       => 'select',
                'renderType' => 'selectSingle',
                'items'      => [
                    [
                        'label' => '',
                        'value' => 0,
                    ],
                ],
                'foreign_table'       => 'tx_chfmap_domain_model_map_resource',
                'foreign_table_where' => 'AND {#tx_chfmap_domain_model_map_resource}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chfmap_domain_model_map_resource}.{#sys_language_uid} IN (-1,0)',
                'default'             => 0,
            ],
        ],
        'l10n_source' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'l18n_diffsource' => [
            'config' => [
                'type'    => 'passthrough',
                'default' => '',
            ],
        ],
        'title' => [
            'label'       => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:database.mapResource.title',
            'description' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:database.mapResource.title.description',
            'config'      => [
                'type' => 'input',
                'size' => 40,
                'max'  => 255,
                'eval' => 'trim',
            ],
        ],
        'description' => [
            'label'       => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:database.mapResource.description',
            'description' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:database.mapResource.description.description',
            'config'      => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 5,
                'max'  => 2000,
                'eval' => 'trim',
            ],
        ],
        'uri' => [
            'label'       => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:database.mapResource.uri',
            'description' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:database.mapResource.uri.description',
            'config' => [
                'type'           => 'link',
                'allowedTypes'   => ['page', 'url', 'record'],
                'allowedOptions' => [],
                'mode'           => 'prepend',
                'valuePicker'    => [
                   'items' => [
                      ['HTTPS', 'https://'],
                      ['HTTP', 'http://'],
                   ],
                ],
            ],
        ],
        'sameAs' => [
            'label'       => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:database.mapResource.sameAs',
            'description' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:database.mapResource.sameAs.description',
            'config'      => [
                'type'                => 'inline',
                'foreign_table'       => 'tx_chfmap_domain_model_same_as',
                'foreign_field'       => 'parent_id',
                'foreign_table_field' => 'parent_table',
                'behaviour'           => [
                     'allowLanguageSynchronization' => true
                ],
                'appearance'          => [
                    'collapseAll'                     => true,
                    'expandSingle'                    => true,
                    'newRecordLinkAddTitle'           => true,
                    'levelLinksPosition'              => 'top',
                    'useSortable'                     => true,
                    'showPossibleLocalizationRecords' => true,
                    'showAllLocalizationLink'         => true,
                    'showSynchronizationLink'         => true,
                ],
            ],
        ],
        'mapFile' => [
            'label'       => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:database.mapResource.mapFile',
            'description' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:database.mapResource.mapFile.description',
            'config' => [
                'type'     => 'file',
                'allowed'  => 'common-image-types'
            ],
        ],
        'mapTiles' => [
            'label'       => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:database.mapResource.mapTiles',
            'description' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:database.mapResource.mapTiles.description',
            'config'      => [
                'type'                => 'inline',
                'foreign_table'       => 'tx_chfmap_domain_model_tiles',
                'foreign_field'       => 'parent_id',
                'foreign_table_field' => 'parent_table',
                'behaviour'           => [
                     'allowLanguageSynchronization' => true
                ],
                'appearance'          => [
                    'collapseAll'                     => true,
                    'expandSingle'                    => true,
                    'newRecordLinkAddTitle'           => true,
                    'levelLinksPosition'              => 'top',
                    'useSortable'                     => true,
                    'showPossibleLocalizationRecords' => true,
                    'showAllLocalizationLink'         => true,
                    'showSynchronizationLink'         => true,
                ],
            ],
        ],
        'feature' => [
            'label'       => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:database.mapResource.feature',
            'description' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:database.mapResource.feature.description',
            'config'      => [
                'type'                => 'inline',
                'foreign_table'       => 'tx_chfmap_domain_model_feature',
                'foreign_field'       => 'parent_id',
                'foreign_table_field' => 'parent_table',
                'behaviour'           => [
                     'allowLanguageSynchronization' => true
                ],
                'appearance'          => [
                    'collapseAll'                     => true,
                    'expandSingle'                    => true,
                    'newRecordLinkAddTitle'           => true,
                    'levelLinksPosition'              => 'top',
                    'useSortable'                     => true,
                    'showPossibleLocalizationRecords' => true,
                    'showAllLocalizationLink'         => true,
                    'showSynchronizationLink'         => true,
                ],
            ],
        ],
        'tag' => [
            'label'       => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:database.mapResource.tag',
            'description' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:database.mapResource.tag.description',
            'config'      => [
                'type'                => 'inline',
                'foreign_table'       => 'tx_chfmap_domain_model_tag',
                'foreign_field'       => 'parent_id',
                'foreign_table_field' => 'parent_table',
                'behaviour'           => [
                     'allowLanguageSynchronization' => true
                ],
                'appearance'          => [
                    'collapseAll'                     => true,
                    'expandSingle'                    => true,
                    'newRecordLinkAddTitle'           => true,
                    'levelLinksPosition'              => 'top',
                    'useSortable'                     => true,
                    'showPossibleLocalizationRecords' => true,
                    'showAllLocalizationLink'         => true,
                    'showSynchronizationLink'         => true,
                ],
            ],
        ],
    ],
    'palettes' => [
        'mapFileMapTiles' => [
            'showitem' => 'mapFile,mapTiles,',
        ],
    ],
    'types' => [
        '0' => [
            'showitem' => 'hidden,title,description,uri,sameAs,
            --div--;LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:database.mapResource.content,mapFileMapTiles,feature,tag,',
        ],
    ],
];

?>