<?php
declare(strict_types=1);

# This file is part of the extension CHF Map for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


defined('TYPO3') or die();

/**
 * VariantRelation and its properties
 * 
 * Extension of a database table and its editing interface in the
 * TYPO3 backend. This also serves as the basis for the Extbase
 * domain model. For more information on TCA and its options see
 * https://docs.typo3.org/m/typo3/reference-tca/main/en-us/.
 */

// Add select item group 'chfMap'
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItemGroup('tx_chfbase_domain_model_relation', 'type',
    'chfMap',
    'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.chfMap'
);

// Add select item 'variantRelation'
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem('tx_chfbase_domain_model_relation', 'type',
    [
        'label' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.variantRelation.type.variantRelation',
        'value' => 'variantRelation',
        'group' => 'chfMap',
    ]
);

// Add column 'feature'
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tx_chfbase_domain_model_relation',
    [
        'feature' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.variantRelation.feature',
            'description' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.variantRelation.feature.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingleBox',
                'foreign_table' => 'tx_chfmap_domain_model_feature',
                'foreign_table_where' => 'AND {#tx_chfmap_domain_model_feature}.{#pid}=###CURRENT_PID###',
                'MM' => 'tx_chfbase_domain_model_relation_feature_feature_mm',
                'multiple' => 1,
                'required' => true,
            ],
        ],
    ]
);

// Add type 'variantRelation' and its 'showitem' list
$GLOBALS['TCA']['tx_chfbase_domain_model_relation']['types'] += ['variantRelation' => [
    'showitem' => '--palette--;;typeUuid,feature,--palette--;;parentResourceDescription,',
]];
