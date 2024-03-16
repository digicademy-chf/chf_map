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
            'Point' => Digicademy\CHFMap\Domain\Model\SingleGeometry::class,
            'MultiPoint' => Digicademy\CHFMap\Domain\Model\MultiGeometry::class,
            'LineString' => Digicademy\CHFMap\Domain\Model\SingleGeometry::class,
            'MultiLineString' => Digicademy\CHFMap\Domain\Model\MultiGeometry::class,
            'Polygon' => Digicademy\CHFMap\Domain\Model\SingleGeometry::class,
            'MultiPolygon' => Digicademy\CHFMap\Domain\Model\MultiGeometry::class,
            'GeometryCollection' => Digicademy\CHFMap\Domain\Model\GeometryCollection::class,
        ],
    ],
];
