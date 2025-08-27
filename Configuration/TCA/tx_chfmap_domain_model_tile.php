<?php
declare(strict_types=1);

# This file is part of the extension CHF Map for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


defined('TYPO3') or die();

/**
 * Tile and its properties
 * 
 * Configuration of a database table and its editing interface in the
 * TYPO3 backend. This also serves as the basis for the Extbase
 * domain model. For more information on TCA and its options see
 * https://docs.typo3.org/m/typo3/reference-tca/main/en-us/.
 */
return [
    'ctrl' => [
        'title'                    => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.tile',
        'label'                    => 'title',
        'label_alt'                => 'uri',
        'label_alt_force'          => true,
        'tstamp'                   => 'tstamp',
        'crdate'                   => 'crdate',
        'delete'                   => 'deleted',
        'sortby'                   => 'sorting',
        'default_sortby'           => 'title ASC,uri ASC',
        'versioningWS'             => true,
        'iconfile'                 => 'EXT:chf_map/Resources/Public/Icons/TableTile.svg',
        'origUid'                  => 't3_origuid',
        'hideAtCopy'               => true,
        'languageField'            => 'sys_language_uid',
        'transOrigPointerField'    => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'translationSource'        => 'l10n_source',
        'searchFields'             => 'title,uri',
        'enablecolumns'            => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
            'fe_group' => 'fe_group',
        ],
    ],
    'columns' => [
        'title' => [
            'exclude' => true,
            'label' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.tile.title',
            'description' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.tile.title.description',
            'config' => [
                'type' => 'input',
                'size' => 40,
                'max' => 255,
                'eval' => 'trim',
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
                'required' => true,
            ],
        ],
        'uri' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.tile.uri',
            'description' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.tile.uri.description',
            'config' => [
                'type' => 'link',
                'allowedTypes' => ['url'],
                'allowedOptions' => [],
                'mode' => 'prepend',
                'valuePicker' => [
                   'items' => [
                      ['HTTPS', 'https://'],
                      ['HTTP', 'http://'],
                   ],
                ],
                'appearance' => [
                    'enableBrowser' => false,
                ],
            ],
        ],
        'parent_resource' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.parentResource',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.parentResource.description',
            'onChange' => 'reload',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingleBox',
                'foreign_table' => 'tx_chfbase_domain_model_resource',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_resource}.{#sys_language_uid} IN (-1, 0)'
                    . ' AND {#tx_chfbase_domain_model_resource}.{#type}=\'mapResource\'',
                'MM' => 'tx_chfbase_domain_model_resource_record_mm',
                'MM_match_fields' => [
                    'fieldname' => 'parent_resource',
                    'tablenames' => 'tx_chfmap_domain_model_tile',
                ],
                'MM_opposite_field' => 'items',
                'sortItems' => [
                    'label' => 'asc',
                ],
            ],
        ],
    ],
    'palettes' => [
        'titleUri' => [
            'showitem' => 'title,uri,',
        ],
    ],
    'types' => [
        '0' => [
            'showitem' => '--palette--;;titleUri,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.management,parent_resource,',
        ],
    ],
];
