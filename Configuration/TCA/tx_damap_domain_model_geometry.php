<?php

# This file is part of the extension DA Map for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


/**
 * Geometry and its properties
 * 
 * Configuration of a database table and its editing interface in the
 * TYPO3 backend. This also serves as the basis for the Extbase
 * domain model. For more information on TCA and its options see
 * https://docs.typo3.org/m/typo3/reference-tca/main/en-us/.
 */
return [
    'ctrl' => [
        'title'                    => 'LLL:EXT:da_map/Resources/Private/Language/locallang.xlf:database.geometry',
        'label'                    => 'type',
        'tstamp'                   => 'tstamp',
        'crdate'                   => 'crdate',
        'delete'                   => 'deleted',
        'sortby'                   => 'sorting',
        'default_sortby'           => 'type ASC',
        'versioningWS'             => true,
        'iconfile'                 => 'EXT:da_map/Resources/Public/Icons/Geometry.svg',
        'origUid'                  => 't3_origuid',
        'hideAtCopy'               => true,
        'languageField'            => 'sys_language_uid',
        'transOrigPointerField'    => 'l18n_parent',
        'transOrigDiffSourceField' => 'l18n_diffsource',
        'translationSource'        => 'l10n_source',
        'type'                     => 'type',
        'searchFields'             => 'type',
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
                'foreign_table'       => 'tx_damap_domain_model_geometry',
                'foreign_table_where' => 'AND {#tx_damap_domain_model_geometry}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_damap_domain_model_geometry}.{#sys_language_uid} IN (-1,0)',
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
        'type' => [
            'label'       => 'LLL:EXT:da_map/Resources/Private/Language/locallang.xlf:database.geometry.type',
            'description' => 'LLL:EXT:da_map/Resources/Private/Language/locallang.xlf:database.geometry.type.description',
            'config'      => [
                'type'       => 'select',
                'renderType' => 'selectSingle',
                'items'      => [
                    [
                        'label' => 'LLL:EXT:da_map/Resources/Private/Language/locallang.xlf:database.geometry.type.point',
                        'value' => 'Point',
                    ],
                    [
                        'label' => 'LLL:EXT:da_map/Resources/Private/Language/locallang.xlf:database.geometry.type.multiPoint',
                        'value' => 'MultiPoint',
                    ],
                    [
                        'label' => 'LLL:EXT:da_map/Resources/Private/Language/locallang.xlf:database.geometry.type.lineString',
                        'value' => 'LineString',
                    ],
                    [
                        'label' => 'LLL:EXT:da_map/Resources/Private/Language/locallang.xlf:database.geometry.type.multiLineString',
                        'value' => 'MultiLineString',
                    ],
                    [
                        'label' => 'LLL:EXT:da_map/Resources/Private/Language/locallang.xlf:database.geometry.type.polygon',
                        'value' => 'Polygon',
                    ],
                    [
                        'label' => 'LLL:EXT:da_map/Resources/Private/Language/locallang.xlf:database.geometry.type.multiPolygon',
                        'value' => 'MultiPolygon',
                    ],
                    [
                        'label' => 'LLL:EXT:da_map/Resources/Private/Language/locallang.xlf:database.geometry.type.geometryCollection',
                        'value' => 'GeometryCollection',
                    ],
                ],
                'required'   => true,
            ],
        ],
        'coordinates' => [
            'label'       => 'LLL:EXT:da_map/Resources/Private/Language/locallang.xlf:database.geometry.coordinates',
            'description' => 'LLL:EXT:da_map/Resources/Private/Language/locallang.xlf:database.geometry.coordinates.description',
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
            ],
        ],
        'coordinateGroups' => [
            'label'       => 'LLL:EXT:da_map/Resources/Private/Language/locallang.xlf:database.geometry.coordinateGroups',
            'description' => 'LLL:EXT:da_map/Resources/Private/Language/locallang.xlf:database.geometry.coordinateGroups.description',
            'config'      => [
                'type'                => 'inline',
                'foreign_table'       => 'tx_damap_domain_model_coordinate_group',
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
            'label'       => 'LLL:EXT:da_map/Resources/Private/Language/locallang.xlf:database.geometry.geometry',
            'description' => 'LLL:EXT:da_map/Resources/Private/Language/locallang.xlf:database.geometry.geometry.description',
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
            'label'       => 'LLL:EXT:da_map/Resources/Private/Language/locallang.xlf:database.geometry.boundingBox',
            'description' => 'LLL:EXT:da_map/Resources/Private/Language/locallang.xlf:database.geometry.boundingBox.description',
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
    ],
    'palettes' => [],
    'types' => [
        'Point' => [
            'showitem' => 'hidden,type,coordinates,boundingBox,',
        ],
        'MultiPoint' => [
            'showitem' => 'hidden,type,coordinateGroups,boundingBox,',
        ],
        'LineString' => [
            'showitem' => 'hidden,type,coordinates,boundingBox,',
        ],
        'MultiLineString' => [
            'showitem' => 'hidden,type,coordinateGroups,boundingBox,',
        ],
        'Polygon' => [
            'showitem' => 'hidden,type,coordinates,boundingBox,',
        ],
        'MultiPolygon' => [
            'showitem' => 'hidden,type,coordinateGroups,boundingBox,',
        ],
        'GeometryCollection' => [
            'showitem' => 'hidden,type,geometry,boundingBox,',
        ],
    ],
];

?>
