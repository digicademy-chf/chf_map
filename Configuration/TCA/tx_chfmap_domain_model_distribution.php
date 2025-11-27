<?php
declare(strict_types=1);

# This file is part of the extension CHF Map for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


defined('TYPO3') or die();

/**
 * Distribution and its properties
 * 
 * Configuration of a database table and its editing interface in the
 * TYPO3 backend. This also serves as the basis for the Extbase
 * domain model. For more information on TCA and its options see
 * https://docs.typo3.org/m/typo3/reference-tca/main/en-us/.
 */
return [
    'ctrl' => [
        'title'                    => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.distribution',
        'label'                    => 'postal_code',
        'label_alt'                => 'tokens',
        'label_alt_force'          => true,
        'tstamp'                   => 'tstamp',
        'crdate'                   => 'crdate',
        'delete'                   => 'deleted',
        'sortby'                   => 'sorting',
        'default_sortby'           => 'postal_code ASC,tokens ASC',
        'versioningWS'             => true,
        'iconfile'                 => 'EXT:chf_map/Resources/Public/Icons/TableDistribution.svg',
        'origUid'                  => 't3_origuid',
        'hideAtCopy'               => true,
        'languageField'            => 'sys_language_uid',
        'transOrigPointerField'    => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'translationSource'        => 'l10n_source',
        'enablecolumns'            => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
            'fe_group' => 'fe_group',
        ],
    ],
    'columns' => [
        'tokens' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.distribution.tokens',
            'description' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.distribution.tokens.description',
            'config' => [
                'type' => 'number',
                'size' => 13,
                'default' => 0,
                'range' => [
                    'lower' => 0,
                ],
            ],
        ],
        'tokens_total' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.distribution.tokensTotal',
            'description' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.distribution.tokensTotal.description',
            'config' => [
                'type' => 'number',
                'size' => 13,
                'nullable' => true,
                'default' => null,
                'range' => [
                    'lower' => 0,
                ],
            ],
        ],
        'token_type' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.distribution.tokenType',
            'description' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.distribution.tokenType.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                        'label' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.distribution.tokenType.unknown',
                        'value' => 'unknown',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.distribution.tokenType.population',
                        'value' => 'population',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.distribution.tokenType.families',
                        'value' => 'families',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.distribution.tokenType.births',
                        'value' => 'births',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.distribution.tokenType.landlines',
                        'value' => 'landlines',
                    ],
                ],
                'default' => 'unknown',
                'required' => true,
            ],
        ],
        'postal_code' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.distribution.postalCode',
            'description' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.distribution.postalCode.description',
            'config' => [
                'type' => 'input',
                'size' => 40,
                'max' => 255,
                'eval' => 'trim',
            ],
        ],
        'postal_code_system' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.distribution.postalCodeSystem',
            'description' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.distribution.postalCodeSystem.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                        'label' => '',
                        'value' => 0,
                    ],
                    [
                        'label' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.distribution.postalCodeSystem.germany',
                        'value' => 'de',
                    ],
                ],
                'default' => 0,
            ],
        ],
        'coordinates' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.distribution.coordinates',
            'description' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.distribution.coordinates.description',
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
        'geodata' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.distribution.geodata',
            'description' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.distribution.geodata.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                        'label' => '',
                        'value' => 0,
                    ],
                ],
                'foreign_table' => 'tx_chfmap_domain_model_feature',
                'foreign_table_where' => 'AND {#tx_chfmap_domain_model_feature}.{#sys_language_uid} IN (-1, 0)',
            ],
        ],
        'parent_resource' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.parentResource',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.parentResource.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingleBox',
                'foreign_table' => 'tx_chfbase_domain_model_resource',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_resource}.{#sys_language_uid} IN (-1, 0)'
                    . ' AND {#tx_chfbase_domain_model_resource}.{#type}=\'lexicographicResource\'',
                'MM' => 'tx_chfbase_domain_model_resource_record_mm',
                'MM_match_fields' => [
                    'fieldname' => 'parent_resource',
                    'tablenames' => 'tx_chfmap_domain_model_distribution',
                ],
                'MM_opposite_field' => 'items',
                'sortItems' => [
                    'label' => 'asc',
                ],
            ],
        ],
    ],
    'palettes' => [
        'tokensTokensTotalTokenType' => [
            'showitem' => 'tokens,tokens_total,--linebreak--,token_type,',
        ],
        'postalCodePostalCodeSystem' => [
            'showitem' => 'postal_code,postal_code_system,',
        ],
        'parentFrequencyParentResource' => [
            'showitem' => 'parent_frequency,parent_resource,',
        ],
    ],
    'types' => [
        '0' => [
            'showitem' => '--palette--;;tokensTokensTotalTokenType,--palette--;;postalCodePostalCodeSystem,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.structured,coordinates,geodata,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.management,--palette--;;parentFrequencyParentResource,',
        ],
    ],
];
