<?php
declare(strict_types=1);

# This file is part of the extension CHF Map for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


defined('TYPO3') or die();

ORIGINAL WEITER UNTEN; VORLAGE ABSTRACTBASE ZUM ÜBERARBEITEN!!!

/**
 * Agent and its properties
 * 
 * Configuration of a database table and its editing interface in the
 * TYPO3 backend. This also serves as the basis for the Extbase
 * domain model. For more information on TCA and its options see
 * https://docs.typo3.org/m/typo3/reference-tca/main/en-us/.
 */
return [
    'ctrl' => [
        'title'                    => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.agent',
        'label'                    => 'surname',
        'label_alt'                => 'forename,corporateName,alternativeName,type',
        'tstamp'                   => 'tstamp',
        'crdate'                   => 'crdate',
        'delete'                   => 'deleted',
        'sortby'                   => 'sorting',
        'default_sortby'           => 'isHighlight ASC,surname ASC,forename ASC,corporateName ASC,alternativeName ASC,type ASC',
        'versioningWS'             => true,
        'iconfile'                 => 'EXT:chf_base/Resources/Public/Icons/Agent.svg',
        'origUid'                  => 't3_origuid',
        'hideAtCopy'               => true,
        'languageField'            => 'sys_language_uid',
        'transOrigPointerField'    => 'l18n_parent',
        'transOrigDiffSourceField' => 'l18n_diffsource',
        'translationSource'        => 'l10n_source',
        'searchFields'             => 'uuid,type,forename,surname,corporateName,alternativeName,honorific,occupation,gender,publicationDate,revisionNumber,revisionDate,editorialNote,importOrigin,import',
        'enablecolumns'            => [
            'disabled' => 'hidden',
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
            ],
        ],
        'sys_language_uid' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'language',
            ],
        ],
        'l18n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                        'label' => '',
                        'value' => 0,
                    ],
                ],
                'foreign_table' => 'tx_chfbase_domain_model_agent',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_agent}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chfbase_domain_model_agent}.{#sys_language_uid} IN (-1,0)',
                'default' => 0,
            ],
        ],
        'l10n_source' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'l18n_diffsource' => [
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
        'uuid' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.uuid',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.uuid.description',
            'config' => [
                'type' => 'uuid',
                'size' => 40,
                'required' => true,
            ],
        ],
        'sameAs' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.sameAs',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.sameAs.description',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_chfbase_domain_model_same_as',
                'foreign_field' => 'parent',
                'foreign_table_field' => 'parent_table',
                'appearance' => [
                    'collapseAll' => true,
                    'expandSingle' => true,
                    'newRecordLinkAddTitle' => true,
                    'levelLinksPosition' => 'top',
                    'useSortable' => true,
                    'showPossibleLocalizationRecords' => true,
                    'showAllLocalizationLink' => true,
                    'showSynchronizationLink' => true,
                ],
            ],
        ],
        'authorshipRelation' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.authorshipRelation',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.authorshipRelation.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_chfbase_domain_model_relation',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_relation}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chfbase_domain_model_relation}.{#type}=\'authorshipRelation\'',
                'MM' => 'tx_chfbase_domain_model_relation_any_record_mm',
                'MM_opposite_field' => 'record',
                'size' => 5,
                'autoSizeMax' => 10,
                'fieldControl' => [
                    'editPopup' => [
                        'disabled' => false,
                    ],
                    'addRecord' => [
                        'disabled' => false,
                    ],
                    'listModule' => [
                        'disabled' => false,
                    ],
                ],
            ],
        ],
        'licenceRelation' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.licenceRelation',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.licenceRelation.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_chfbase_domain_model_relation',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_relation}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chfbase_domain_model_relation}.{#type}=\'licenceRelation\'',
                'MM' => 'tx_chfbase_domain_model_relation_any_record_mm',
                'MM_opposite_field' => 'record',
                'size' => 5,
                'autoSizeMax' => 10,
                'fieldControl' => [
                    'editPopup' => [
                        'disabled' => false,
                    ],
                    'addRecord' => [
                        'disabled' => false,
                    ],
                    'listModule' => [
                        'disabled' => false,
                    ],
                ],
            ],
        ],
        'publicationDate' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractBase.publicationDate',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractBase.publicationDate.description',
            'config' => [
                'type' => 'datetime',
                'format' => 'date',
                'eval' => 'int',
                'default' => 0,
            ],
        ],
        'revisionNumber' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractBase.revisionNumber',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractBase.revisionNumber.description',
            'config' => [
                'type' => 'number',
            ],
        ],
        'revisionDate' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractBase.revisionDate',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractBase.revisionDate.description',
            'config' => [
                'type' => 'datetime',
                'format' => 'date',
                'eval' => 'int',
                'default' => 0,
            ],
        ],
        'editorialNote' => [
            'exclude' => true,
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractBase.editorialNote',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractBase.editorialNote.description',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 5,
                'max' => 2000,
                'eval' => 'trim',
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
            ],
        ],
        'importOrigin' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.importOrigin',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.importOrigin.description',
            'config' => [
                'type' => 'input',
                'size' => 40,
                'max' => 255,
                'eval' => 'trim',
            ],
        ],

























# This file is part of the extension CHF Map for TYPO3.
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
        'title'                    => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:database.feature',
        'label'                    => 'title',
        'label_alt'                => 'type,weight',
        'descriptionColumn'        => 'description',
        'tstamp'                   => 'tstamp',
        'crdate'                   => 'crdate',
        'delete'                   => 'deleted',
        'sortby'                   => 'sorting',
        'default_sortby'           => 'title ASC,type ASC,weight ASC',
        'versioningWS'             => true,
        'iconfile'                 => 'EXT:chf_map/Resources/Public/Icons/Feature.svg',
        'origUid'                  => 't3_origuid',
        'hideAtCopy'               => true,
        'languageField'            => 'sys_language_uid',
        'transOrigPointerField'    => 'l18n_parent',
        'transOrigDiffSourceField' => 'l18n_diffsource',
        'translationSource'        => 'l10n_source',
        'type'                     => 'type',
        'searchFields'             => 'uuid,title,type,description,weight,projection',
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
                'foreign_table'       => 'tx_chfmap_domain_model_feature',
                'foreign_table_where' => 'AND {#tx_chfmap_domain_model_feature}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chfmap_domain_model_feature}.{#sys_language_uid} IN (-1,0)',
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
        'parent_id' => [
            'label'       => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:database.feature.parent_id',
            'description' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:database.feature.parent_id.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectSingle',
                'foreign_table'       => 'tx_chfmap_domain_model_map_resource',
                'foreign_table_where' => 'AND {#tx_chfmap_domain_model_map_resource}.{#pid}=###CURRENT_PID###',
                'maxitems'            => 1,
                'required'            => true,
            ],
        ],
        'uuid' => [
            'label'       => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:database.feature.uuid',
            'description' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:database.feature.uuid.description',
            'config'      => [
                'type'     => 'uuid',
                'size'     => 40,
                'required' => true,
            ],
        ],
        'title' => [
            'label'       => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:database.feature.title',
            'description' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:database.feature.title.description',
            'config'      => [
                'type' => 'input',
                'size' => 40,
                'max'  => 255,
                'eval' => 'trim',
            ],
        ],
        'type' => [
            'label'       => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:database.feature.type',
            'description' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:database.feature.type.description',
            'config'      => [
                'type'       => 'select',
                'renderType' => 'selectSingle',
                'items'      => [
                    [
                        'label' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:database.feature.type.feature',
                        'value' => 'Feature',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:database.feature.type.featureCollection',
                        'value' => 'FeatureCollection',
                    ],
                ],
                'required'   => true,
            ],
        ],
        'description' => [
            'label'       => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:database.feature.description',
            'description' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:database.feature.description.description',
            'config'      => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 5,
                'max'  => 2000,
                'eval' => 'trim',
            ],
        ],
        'label' => [
            'label'       => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:database.feature.label',
            'description' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:database.feature.label.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chfmap_domain_model_tag',
                'foreign_table_where' => 'AND {#tx_chfmap_domain_model_tag}.{#pid}=###CURRENT_PID###'
                . ' AND {#tx_chfmap_domain_model_tag}.{#type}=\'label\''
                . ' ORDER BY tag',
                'MM'                  => 'tx_chfmap_domain_model_feature_label_mm',
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
            'label'       => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:database.feature.sameAs',
            'description' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:database.feature.sameAs.description',
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
        'feature' => [
            'label'       => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:database.feature.feature',
            'description' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:database.feature.feature.description',
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
                'overrideChildTca' => [
                    'columns' => [
                        'type' => [
                            'config' => [
                                'items' => [
                                    [
                                        'label' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:database.feature.type.feature',
                                        'value' => 'Feature',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'weight' => [
            'label'       => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:database.feature.weight',
            'description' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:database.feature.weight.description',
            'config'      => [
                'type' => 'number'
            ],
        ],
        'projection' => [
            'label'       => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:database.feature.projection',
            'description' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:database.feature.projection.description',
            'config'      => [
                'type'       => 'select',
                'renderType' => 'selectSingle',
                'items'      => [
                    [
                        'label' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:database.feature.projection.worldGeodeticSystem',
                        'value' => 'worldGeodeticSystem',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:database.feature.projection.pixels',
                        'value' => 'pixels',
                    ],
                ],
                'required'   => true,
            ],
        ],
        'geometry' => [
            'label'       => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:database.feature.geometry',
            'description' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:database.feature.geometry.description',
            'config'      => [
                'type'                => 'inline',
                'foreign_table'       => 'tx_chfmap_domain_model_geometry',
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
        'boundingBox' => [
            'label'       => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:database.feature.boundingBox',
            'description' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:database.feature.boundingBox.description',
            'config'      => [
                'type'                => 'inline',
                'foreign_table'       => 'tx_chfmap_domain_model_coordinates',
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
                'maxitems'            => 2,
            ],
        ],
    ],
    'palettes' => [
        'hiddenParentId' => [
            'showitem' => 'hidden,parent_id,',
        ],
        'uuidTitle' => [
            'showitem' => 'uuid,title,',
        ],
    ],
    'types' => [
        'AbstractFeature' => [
            'showitem' => 'hiddenParentId,uuidTitle,type,description,label,sameAs,
            --div--;LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:database.feature.details,boundingBox,',
        ],
        'Feature' => [
            'showitem' => 'hiddenParentId,uuidTitle,type,description,label,sameAs,
            --div--;LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:database.feature.details,weight,projection,geometry,boundingBox,',
        ],
        'FeatureCollection' => [
            'showitem' => 'hiddenParentId,uuidTitle,type,description,label,sameAs,
            --div--;LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:database.feature.details,feature,boundingBox,',
        ],
    ],
];
