<?php
declare(strict_types=1);

# This file is part of the extension CHF Map for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


defined('TYPO3') or die();

/**
 * LabelTag and its properties
 * 
 * Extension of a database table and its editing interface in the
 * TYPO3 backend. This also serves as the basis for the Extbase
 * domain model. For more information on TCA and its options see
 * https://docs.typo3.org/m/typo3/reference-tca/main/en-us/.
 */

// Add column 'asLabelOfFeature'
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tx_chfbase_domain_model_tag',
    [
        'asLabelOfFeature' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.labelTag.asLabelOfFeature',
            'description' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.labelTag.asLabelOfFeature.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_chfmap_domain_model_feature',
                'foreign_table_where' => 'AND {#tx_chfmap_domain_model_feature}.{#pid}=###CURRENT_PID###',
                'MM' => 'tx_chfmap_domain_model_feature_tag_label_mm',
                'MM_opposite_field' => 'label',
                'MM_match_fields' => [
                    'fieldname' => 'asLabelOfFeature',
                ],
                'size' => 5,
                'autoSizeMax' => 10,
            ],
        ],
    ]
);
