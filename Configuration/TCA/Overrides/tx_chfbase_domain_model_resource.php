<?php
defined('TYPO3') or die();

# This file is part of the extension CHF Map for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


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

// Add columns 'allTiles' and 'allFeatures'
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tx_chfbase_domain_model_resource',
    [
        'allTiles' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.mapResource.allTiles',
            'description' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.mapResource.allTiles.description',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_chfmap_domain_model_tile',
                'foreign_field' => 'parentResource',
                'foreign_sortby' => 'sorting',
                'appearance' => [
                    'collapseAll' => true,
                    'expandSingle' => true,
                    'newRecordLinkAddTitle' => true,
                    'levelLinksPosition' => 'top',
                    'useSortable' => false,
                    'showPossibleLocalizationRecords' => true,
                    'showAllLocalizationLink' => true,
                    'showSynchronizationLink' => true,
                ],
            ],
        ],
        'allFeatures' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.mapResource.allFeatures',
            'description' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.mapResource.allFeatures.description',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_chfmap_domain_model_feature',
                'foreign_field' => 'parentResource',
                'foreign_sortby' => 'sorting',
                'appearance' => [
                    'collapseAll' => true,
                    'expandSingle' => true,
                    'newRecordLinkAddTitle' => true,
                    'levelLinksPosition' => 'top',
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
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
   'tx_chfbase_domain_model_resource',
   'hiddenUuid,typeUri,titleLangCode,description,sameAs,
   --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.editorial,authorshipRelation,licenceRelation,publicationDateRevisionNumberRevisionDate,editorialNote,
   --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.content,allAgents,allFileCollections,allLocations,allPeriods,allRelations,allTags,allTiles,allFeatures,
   --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.import,importOrigin,importState,'
   'mapResource'
);
