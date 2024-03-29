<?php
declare(strict_types=1);

# This file is part of the extension CHF Map for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


defined('TYPO3') or die();

/**
 * Location and its properties
 * 
 * Extension of a database table and its editing interface in the
 * TYPO3 backend. This also serves as the basis for the Extbase
 * domain model. For more information on TCA and its options see
 * https://docs.typo3.org/m/typo3/reference-tca/main/en-us/.
 */

// Add columns 'geodata' and 'locationPlan'
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tx_chfbase_domain_model_location',
    [
        'geodata' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.location.geodata',
            'description' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.location.geodata.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_chfmap_domain_model_feature',
                'foreign_table_where' => 'AND {#tx_chfmap_domain_model_feature}.{#pid}=###CURRENT_PID###',
                'MM' => 'tx_chfbase_domain_model_location_feature_geodata_mm',
                'sortItems' => [
                    'label' => 'asc',
                ],
            ],
        ],
        'locationPlan' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.location.locationPlan',
            'description' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.location.locationPlan.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_chfbase_domain_model_resource',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_resource}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chfbase_domain_model_resource}.{#type}=\'glossaryResource\'',
                'MM' => 'tx_chfbase_domain_model_location_resource_locationplan_mm',
                'sortItems' => [
                    'label' => 'asc',
                ],
            ],
        ],
    ]
);
