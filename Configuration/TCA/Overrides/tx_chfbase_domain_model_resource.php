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
                    'levelLinksPosition' => 'bottom',
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
                    'levelLinksPosition' => 'bottom',
                    'useSortable' => false,
                    'showPossibleLocalizationRecords' => true,
                    'showAllLocalizationLink' => true,
                    'showSynchronizationLink' => true,
                ],
            ],
        ],
        'asFloorPlanOfLocation' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.mapResource.asFloorPlanOfLocation',
            'description' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.mapResource.asFloorPlanOfLocation.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_chfbase_domain_model_location',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_location}.{#pid}=###CURRENT_PID###',
                'MM' => 'tx_chfbase_domain_model_location_resource_floorplan_mm',
                'MM_opposite_field' => 'floorPlan',
                'multiple' => 1,
                'size' => 5,
                'autoSizeMax' => 10,
            ],
        ],
        'asFloorPlanOfObjectGroup' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.mapResource.asFloorPlanOfObjectGroup',
            'description' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.mapResource.asFloorPlanOfObjectGroup.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_chfobject_domain_model_object_group',
                'foreign_table_where' => 'AND {#tx_chfobject_domain_model_object_group}.{#pid}=###CURRENT_PID###',
                'MM' => 'tx_chfobject_domain_model_object_group_resource_floorplan_mm',
                'MM_opposite_field' => 'floorPlan',
                'multiple' => 1,
                'size' => 5,
                'autoSizeMax' => 10,
            ],
        ],
    ]
);

// Add type 'mapResource' and its 'showitem' list
$GLOBALS['TCA']['tx_chfbase_domain_model_resource']['types'] += ['mapResource' => [
    'showitem' => '--palette--;;typeUuid,--palette--;;titleLangCodeDescription,sameAs,
   --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.editorial,--palette--;;authorshipRelationLicenceRelation,--palette--;;publicationDateRevisionDateRevisionNumberEditorialNote,
   --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.content,allFeatures,allTiles,allAgents,allLocations,allPeriods,allTags,allRelations,allFileGroups,
   --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.import,--palette--;;importOriginImportState,
   --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.usage,asFloorPlanOfLocation,',
]];
