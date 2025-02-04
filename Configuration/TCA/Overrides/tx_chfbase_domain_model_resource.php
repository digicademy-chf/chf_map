<?php
declare(strict_types=1);

# This file is part of the extension CHF Map for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


defined('TYPO3') or die();

/**
 * MapResource and its properties
 * 
 * Extension of a database table and its editing interface in the
 * TYPO3 backend. This also serves as the basis for the Extbase
 * domain model. For more information on TCA and its options see
 * https://docs.typo3.org/m/typo3/reference-tca/main/en-us/.
 */

// Add select item 'mapResource'
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem('tx_chfbase_domain_model_resource', 'type',
    [
        'label' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.mapResource.type.mapResource',
        'value' => 'mapResource',
    ]
);

// Add columns 'all_features' and 'all_tiles'
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tx_chfbase_domain_model_resource',
    [
        'all_features' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.mapResource.allFeatures',
            'description' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.mapResource.allFeatures.description',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_chfmap_domain_model_feature',
                'foreign_field' => 'parent_resource',
                'foreign_sortby' => 'sorting',
                'appearance' => [
                    'collapseAll' => true,
                    'expandSingle' => true,
                    'newRecordLinkAddTitle' => true,
                    'levelLinksPosition' => 'bottom',
                    'useSortable' => false,
                    'showPossibleLocalizationRecords' => true,
                    'showAllLocalizationLink' => true,
                    'showSynchronizationLink' => true,
                ],
            ],
        ],
        'all_tiles' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.mapResource.allTiles',
            'description' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.mapResource.allTiles.description',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_chfmap_domain_model_tile',
                'foreign_field' => 'parent_resource',
                'foreign_sortby' => 'sorting',
                'appearance' => [
                    'collapseAll' => true,
                    'expandSingle' => true,
                    'newRecordLinkAddTitle' => true,
                    'levelLinksPosition' => 'bottom',
                    'useSortable' => false,
                    'showPossibleLocalizationRecords' => true,
                    'showAllLocalizationLink' => true,
                    'showSynchronizationLink' => true,
                ],
            ],
        ],
    ]
);

// Add type 'mapResource' and its 'showitem' list
$GLOBALS['TCA']['tx_chfbase_domain_model_resource']['types'] += ['mapResource' => [
   'showitem' => 'type,--palette--;;titleLangCodeDescription,
   --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.structured,all_features,all_tiles,all_agents,all_locations,all_periods,all_tags,all_keywords,all_relations,all_file_groups,
   --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.placement,--palette--;;iriUuidSameAs,
   --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.editorial,--palette--;;publicationDateRevisionDateRevisionNumberEditorialNote,--palette--;;authorshipRelationLicenceRelation,
   --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.import,--palette--;;importOriginImportState,',
]];
