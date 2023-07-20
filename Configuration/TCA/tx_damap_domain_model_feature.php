<?php

# This file is part of the extension DA Map for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


/**
 * Feature and its properties
 * 
 * Configuration of a database table and its editing interface in the
 * TYPO3 backend. This also serves as the basis for the Extbase
 * domain model. For more information on TCA and its options see
 * https://docs.typo3.org/m/typo3/reference-tca/main/en-us/.
 */
return [
    'ctrl' => [
        'title'                    => 'LLL:EXT:da_map/Resources/Private/Language/locallang.xlf:database.feature',
        'label'                    => 'title',
        'label_alt'                => 'uuid,type,weight',
        'descriptionColumn'        => 'description',
        'tstamp'                   => 'tstamp',
        'crdate'                   => 'crdate',
        'delete'                   => 'deleted',
        'sortby'                   => 'sorting',
        'default_sortby'           => 'title ASC,uuid ASC,type ASC,weight ASC',
        'versioningWS'             => true,
        'iconfile'                 => 'EXT:da_map/Resources/Public/Icons/Feature.svg',
        'origUid'                  => 't3_origuid',
        'hideAtCopy'               => true,
        'languageField'            => 'sys_language_uid',
        'transOrigPointerField'    => 'l18n_parent',
        'transOrigDiffSourceField' => 'l18n_diffsource',
        'translationSource'        => 'l10n_source',
        'type'                     => 'type',
        'searchFields'             => 'title,uuid,type,weight,description',
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
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'size' => 5,
                'maxitems' => 20,
                'items' => [
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
                'foreign_table'       => 'tx_damap_domain_model_feature',
                'foreign_table_where' =>
                    'AND {#tx_damap_domain_model_feature}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_damap_domain_model_feature}.{#sys_language_uid} IN (-1,0)',
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
            'label'       => 'LLL:EXT:da_map/Resources/Private/Language/locallang.xlf:database.feature.title',
            'description' => 'LLL:EXT:da_map/Resources/Private/Language/locallang.xlf:database.feature.title.description',
            'config'      => [
                'type' => 'input',
                'size' => 40,
                'max'  => 255,
                'eval' => 'trim',
            ],
        ],
        'uuid' => [
            'label'       => 'LLL:EXT:da_map/Resources/Private/Language/locallang.xlf:database.feature.uuid',
            'description' => 'LLL:EXT:da_map/Resources/Private/Language/locallang.xlf:database.feature.uuid.description',
            'config'      => [
                'type'     => 'uuid',
                'size'     => 40,
                'required' => true,
            ],
        ],
        'type' => [
            'label'       => 'LLL:EXT:da_map/Resources/Private/Language/locallang.xlf:database.feature.type',
            'description' => 'LLL:EXT:da_map/Resources/Private/Language/locallang.xlf:database.feature.type.description',
            'config'      => [
                'type'       => 'select',
                'renderType' => 'selectSingle',
                'items'      => [
                    [
                        'label' => 'LLL:EXT:da_map/Resources/Private/Language/locallang.xlf:database.feature.type.feature',
                        'value' => 'Feature',
                    ],
                    [
                        'label' => 'LLL:EXT:da_map/Resources/Private/Language/locallang.xlf:database.feature.type.featureCollection',
                        'value' => 'FeatureCollection',
                    ],
                ],
                'required'   => true,
            ],
        ],
        'weight' => [
            'label'       => 'LLL:EXT:da_map/Resources/Private/Language/locallang.xlf:database.feature.weight',
            'description' => 'LLL:EXT:da_map/Resources/Private/Language/locallang.xlf:database.feature.weight.description',
            'config'      => [
                'type' => 'number'
            ],
        ],
        'description' => [
            'label'       => 'LLL:EXT:da_map/Resources/Private/Language/locallang.xlf:database.feature.description',
            'description' => 'LLL:EXT:da_map/Resources/Private/Language/locallang.xlf:database.feature.description.description',
            'config'      => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 5,
                'max'  => 2000,
                'eval' => 'trim',
            ],
        ],
        'feature' => [
            'label'       => 'LLL:EXT:da_map/Resources/Private/Language/locallang.xlf:database.feature.feature',
            'description' => 'LLL:EXT:da_map/Resources/Private/Language/locallang.xlf:database.feature.feature.description',
            'config'      => [
                'type'                => 'inline',
                'foreign_table'       => 'tx_damap_domain_model_feature',
                'foreign_field'       => 'parent_id',
                'foreign_table_field' => 'parent_table',
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
        'geometry' => [
            'label'       => 'LLL:EXT:da_map/Resources/Private/Language/locallang.xlf:database.feature.geometry',
            'description' => 'LLL:EXT:da_map/Resources/Private/Language/locallang.xlf:database.feature.geometry.description',
            'config'      => [
                'type'                => 'inline',
                'foreign_table'       => 'tx_damap_domain_model_geometry',
                'foreign_field'       => 'parent_id',
                'foreign_table_field' => 'parent_table',
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
        'boundingBox' => [
            'label'       => 'LLL:EXT:da_map/Resources/Private/Language/locallang.xlf:database.feature.boundingBox',
            'description' => 'LLL:EXT:da_map/Resources/Private/Language/locallang.xlf:database.feature.boundingBox.description',
            'config'      => [
                'type'                => 'inline',
                'foreign_table'       => 'tx_damap_domain_model_coordinates',
                'foreign_field'       => 'parent_id',
                'foreign_table_field' => 'parent_table',
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
                'maxitems'            => 2,
            ],
        ],
        'label' => [
            'label'       => 'LLL:EXT:da_map/Resources/Private/Language/locallang.xlf:database.feature.label',
            'description' => 'LLL:EXT:da_map/Resources/Private/Language/locallang.xlf:database.feature.label.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_damap_domain_model_tag',
                'foreign_table_where' => 'AND {#tx_damap_domain_model_tag}.{#pid}=###CURRENT_PID###'
                . ' AND {#tx_damap_domain_model_tag}.{#type}=\'label\''
                . ' ORDER BY tag',
                'MM'                  => 'tx_damap_domain_model_feature_label_mm',
                'size'                => 5,
                'autoSizeMax'         => 10,
                'fieldControl'        => [
                    'editPopup'  => [
                        'disabled' => false,
                    ],
                    'addRecord'  => [
                        'disabled' => false,
                    ],
                    'listModule' => [
                        'disabled' => false,
                    ],
                ],
            ],
        ],
        'sameAs' => [
            'label'       => 'LLL:EXT:da_map/Resources/Private/Language/locallang.xlf:database.feature.sameAs',
            'description' => 'LLL:EXT:da_map/Resources/Private/Language/locallang.xlf:database.feature.sameAs.description',
            'config'      => [
                'type'                => 'inline',
                'foreign_table'       => 'tx_damap_domain_model_same_as',
                'foreign_field'       => 'parent_id',
                'foreign_table_field' => 'parent_table',
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
        'titleUuid' => [
            'showitem' => 'title,uuid,',
        ],
        'typeWeight' => [
            'showitem' => 'type,weight,',
        ],
    ],
    'types' => [
        'Feature' => [
            'showitem' => 'hidden,titleUuid,typeWeight,description,geometry,boundingBox,label,sameAs,',
        ],
        'FeatureCollection' => [
            'showitem' => 'hidden,titleUuid,type,description,feature,boundingBox,label,sameAs,',
        ],
    ],
];

?>
