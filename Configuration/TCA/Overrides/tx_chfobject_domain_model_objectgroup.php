<?php
declare(strict_types=1);

# This file is part of the extension CHF Map for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


defined('TYPO3') or die();

/**
 * ObjectGroup and its properties
 * 
 * Extension of a database table and its editing interface in the
 * TYPO3 backend. This also serves as the basis for the Extbase
 * domain model. For more information on TCA and its options see
 * https://docs.typo3.org/m/typo3/reference-tca/main/en-us/.
 */

// Add columns 'geodata' and 'floor_plan'
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tx_chfobject_domain_model_objectgroup',
    [
        'geodata' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.abstractObject.geodata',
            'description' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.abstractObject.geodata.description',
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
                'foreign_table_where' => 'AND {#tx_chfmap_domain_model_feature}.{#pid}=###CURRENT_PID###',
                'MM' => 'tx_chfobject_domain_model_objectgroup_feature_geodata_mm',
                'multiple' => 1,
                'sortItems' => [
                    'label' => 'asc',
                ],
            ],
        ],
        'floor_plan' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.objectGroup.floorPlan',
            'description' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.objectGroup.floorPlan.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                        'label' => '',
                        'value' => 0,
                    ],
                ],
                'foreign_table' => 'tx_chfbase_domain_model_resource',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_resource}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chfbase_domain_model_resource}.{#type}=\'mapResource\'',
                'MM' => 'tx_chfobject_domain_model_objectgroup_resource_floorplan_mm',
                'multiple' => 1,
                'sortItems' => [
                    'label' => 'asc',
                ],
            ],
        ],
    ]
);
