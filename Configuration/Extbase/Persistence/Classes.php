<?php
declare(strict_types=1);

# This file is part of the extension CHF Map for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


defined('TYPO3') or die();

/**
 * Rules to map object inheritance to TCA tables
 * 
 * List of inherited object models and how they relate to TCA tables and
 * values of the property specified as 'type' in the TCA config. Simpler
 * objects based on tables of the same name and without multiple types
 * do not need to be listed here since Extbase maps them automatically.
 * For more information on the persistence of Extbase models see
 * https://docs.typo3.org/m/typo3/reference-coreapi/main/en-us/ExtensionArchitecture/Extbase/Reference/Domain/Persistence.html.
 */
return [
    Digicademy\CHFBase\Domain\Model\AbstractResource::class => [
        'subclasses' => [
            'mapResource' => Digicademy\CHFMap\Domain\Model\MapResource::class,
        ],
    ],
    Digicademy\CHFMap\Domain\Model\AbstractFeature::class => [
        'tableName'  => 'tx_chfmap_domain_model_feature',
        'recordType' => '0',
        'subclasses' => [
            'feature' => Digicademy\CHFMap\Domain\Model\Feature::class,
            'featureCollection' => Digicademy\CHFMap\Domain\Model\FeatureCollection::class,
        ],
    ],
    Digicademy\CHFMap\Domain\Model\AbstractGeometry::class => [
        'tableName'  => 'tx_chfmap_domain_model_geometry',
        'recordType' => '0',
        'subclasses' => [
            'point' => Digicademy\CHFMap\Domain\Model\SingleGeometry::class,
            'multiPoint' => Digicademy\CHFMap\Domain\Model\MultiGeometry::class,
            'lineString' => Digicademy\CHFMap\Domain\Model\SingleGeometry::class,
            'multiLineString' => Digicademy\CHFMap\Domain\Model\MultiGeometry::class,
            'polygon' => Digicademy\CHFMap\Domain\Model\SingleGeometry::class,
            'multiPolygon' => Digicademy\CHFMap\Domain\Model\MultiGeometry::class,
            'geometryCollection' => Digicademy\CHFMap\Domain\Model\GeometryCollection::class,
        ],
    ],
];
