<?php
declare(strict_types=1);

# This file is part of the extension CHF Map for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


defined('TYPO3') or die();

/**
 * AbstractGeometry and its properties
 * 
 * Configuration of a database table and its editing interface in the
 * TYPO3 backend. This also serves as the basis for the Extbase
 * domain model. For more information on TCA and its options see
 * https://docs.typo3.org/m/typo3/reference-tca/main/en-us/.
 */
return [
    'ctrl' => [
        'title'                    => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.abstractGeometry',
        'label'                    => 'type',
        'tstamp'                   => 'tstamp',
        'crdate'                   => 'crdate',
        'delete'                   => 'deleted',
        'sortby'                   => 'sorting',
        'default_sortby'           => 'type ASC',
        'versioningWS'             => true,
        'iconfile'                 => 'EXT:chf_map/Resources/Public/Icons/Geometry.svg',
        'origUid'                  => 't3_origuid',
        'hideAtCopy'               => true,
        'languageField'            => 'sys_language_uid',
        'transOrigPointerField'    => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'translationSource'        => 'l10n_source',
        'type'                     => 'type',
        'searchFields'             => 'type',
        'enablecolumns'            => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
            'fe_group' => 'fe_group',
        ],
    ],
    'columns' => [
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
                'foreign_table_where' => 'ORDER BY fe_groups.title',
            ],
        ],
        'sys_language_uid' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'language',
            ],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l10n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                        'label' => '',
                        'value' => 0,
                    ],
                ],
                'foreign_table' => 'tx_chfmap_domain_model_geometry',
                'foreign_table_where' => 'AND {#tx_chfmap_domain_model_geometry}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chfmap_domain_model_geometry}.{#sys_language_uid} IN (-1,0)',
                'default' => 0,
            ],
        ],
        'l10n_source' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
                'default' => '',
            ],
        ],
        'hidden' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.enabled',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.hidden.description',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [
                    [
                        'label' => '',
                        'invertStateDisplay' => true,
                    ]
                ],
            ]
        ],
        'starttime' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.starttime',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.starttime.description',
            'config' => [
                'type' => 'datetime',
                'format' => 'datetime',
                'eval' => 'int',
                'default' => 0,
            ],
        ],
        'endtime' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.endtime',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.endtime.description',
            'config' => [
                'type' => 'datetime',
                'format' => 'datetime',
                'eval' => 'int',
                'default' => 0,
                'range' => [
                    'upper' => mktime(0, 0, 0, 1, 1, 2106),
                ],
            ],
        ],
        'parentTable' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'parent' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'type' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.abstractGeometry.type',
            'description' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.abstractGeometry.type.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                        'label' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.abstractGeometry.type.point',
                        'value' => 'point',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.abstractGeometry.type.multiPoint',
                        'value' => 'multiPoint',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.abstractGeometry.type.lineString',
                        'value' => 'lineString',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.abstractGeometry.type.multiLineString',
                        'value' => 'multiLineString',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.abstractGeometry.type.polygon',
                        'value' => 'polygon',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.abstractGeometry.type.multiPolygon',
                        'value' => 'multiPolygon',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.abstractGeometry.type.geometryCollection',
                        'value' => 'geometryCollection',
                    ],
                ],
                'required' => true,
            ],
        ],
        'coordinates' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.singleGeometry.coordinates',
            'description' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.singleGeometry.coordinates.description',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_chfmap_domain_model_coordinates',
                'foreign_field' => 'parent',
                'foreign_table_field' => 'parent_table',
                'appearance' => [
                    'collapseAll' => true,
                    'expandSingle' => true,
                    'newRecordLinkAddTitle' => true,
                    'levelLinksPosition' => 'bottom',
                    'useSortable' => true,
                    'showPossibleLocalizationRecords' => true,
                    'showAllLocalizationLink' => true,
                    'showSynchronizationLink' => true,
                ],
            ],
        ],
        'coordinateGroup' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.multiGeometry.coordinateGroup',
            'description' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.multiGeometry.coordinateGroup.description',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_chfmap_domain_model_coordinate_group',
                'foreign_field' => 'parent',
                'foreign_table_field' => 'parent_table',
                'appearance' => [
                    'collapseAll' => true,
                    'expandSingle' => true,
                    'newRecordLinkAddTitle' => true,
                    'levelLinksPosition' => 'bottom',
                    'useSortable' => true,
                    'showPossibleLocalizationRecords' => true,
                    'showAllLocalizationLink' => true,
                    'showSynchronizationLink' => true,
                ],
            ],
        ],
        'geometry' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.geometryCollection.geometry',
            'description' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.geometryCollection.geometry.description',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_chfmap_domain_model_geometry',
                'foreign_field' => 'parent',
                'foreign_table_field' => 'parent_table',
                'appearance' => [
                    'collapseAll' => true,
                    'expandSingle' => true,
                    'newRecordLinkAddTitle' => true,
                    'levelLinksPosition' => 'bottom',
                    'useSortable' => true,
                    'showPossibleLocalizationRecords' => true,
                    'showAllLocalizationLink' => true,
                    'showSynchronizationLink' => true,
                ],
                'overrideChildTca' => [
                    'columns' => [
                        'type' => [
                            'config' => [
                                'items' => [
                                    [
                                        'label' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.abstractGeometry.type.point',
                                        'value' => 'point',
                                    ],
                                    [
                                        'label' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.abstractGeometry.type.multiPoint',
                                        'value' => 'multiPoint',
                                    ],
                                    [
                                        'label' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.abstractGeometry.type.lineString',
                                        'value' => 'lineString',
                                    ],
                                    [
                                        'label' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.abstractGeometry.type.multiLineString',
                                        'value' => 'multiLineString',
                                    ],
                                    [
                                        'label' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.abstractGeometry.type.polygon',
                                        'value' => 'polygon',
                                    ],
                                    [
                                        'label' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.abstractGeometry.type.multiPolygon',
                                        'value' => 'multiPolygon',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'boundingBox' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.abstractGeometry.boundingBox',
            'description' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.abstractGeometry.boundingBox.description',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_chfmap_domain_model_coordinates',
                'foreign_field' => 'parent',
                'foreign_table_field' => 'parent_table',
                'appearance' => [
                    'collapseAll' => true,
                    'expandSingle' => true,
                    'newRecordLinkAddTitle' => true,
                    'levelLinksPosition' => 'bottom',
                    'useSortable' => true,
                    'showPossibleLocalizationRecords' => true,
                    'showAllLocalizationLink' => true,
                    'showSynchronizationLink' => true,
                ],
                'maxitems' => 2,
            ],
        ],
    ],
    'palettes' => [
        'coordinatesBoundingBox' => [
            'showitem' => 'coordinates,--linebreak--,boundingBox,',
        ],
        'coordinateGroupBoundingBox' => [
            'showitem' => 'coordinateGroup,--linebreak--,boundingBox,',
        ],
        'geometryBoundingBox' => [
            'showitem' => 'geometry,--linebreak--,boundingBox,',
        ],
    ],
    'types' => [
        '0' => [
            'showitem' => 'type,boundingBox,',
        ],
        'point' => [
            'showitem' => 'type,--palette--;;coordinatesBoundingBox,',
        ],
        'multiPoint' => [
            'showitem' => 'type,--palette--;;coordinateGroupBoundingBox,',
        ],
        'lineString' => [
            'showitem' => 'type,--palette--;;coordinatesBoundingBox,',
        ],
        'multiLineString' => [
            'showitem' => 'type,--palette--;;coordinateGroupBoundingBox,',
        ],
        'polygon' => [
            'showitem' => 'type,--palette--;;coordinatesBoundingBox,',
        ],
        'multiPolygon' => [
            'showitem' => 'type,--palette--;;coordinateGroupBoundingBox,',
        ],
        'geometryCollection' => [
            'showitem' => 'type,--palette--;;geometryBoundingBox,',
        ],
    ],
];
