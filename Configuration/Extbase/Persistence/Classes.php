<?php

declare(strict_types=1);

# This file is part of the extension DA Map for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


/**
 * Rules to map object inheritance to TCA tables
 * 
 * List of inherited object models and how they relate to TCA tables
 * and values of the property specified as 'type' in the TCA config.
 * Simpler objects based on tables that do not have multiple types
 * do not need to be listed here since Extbase maps them automatically.
 * For more information on the persistence of Extbase models see
 * https://docs.typo3.org/m/typo3/reference-coreapi/main/en-us/ExtensionArchitecture/Extbase/Reference/Domain/Persistence.html#extbase-persistence.
 */
return [
    Digicademy\DAMap\Domain\Model\AbstractFeature::class => [
        'tableName'  => 'tx_damap_domain_model_feature',
        'recordType' => 'AbstractFeature',
        'subclasses' => [
            'Feature'           => Digicademy\DAMap\Domain\Model\Feature::class,
            'FeatureCollection' => Digicademy\DAMap\Domain\Model\FeatureCollection::class,
        ]
    ],
    Digicademy\DAMap\Domain\Model\AbstractGeometry::class => [
        'tableName'  => 'tx_damap_domain_model_geometry',
        'recordType' => 'AbstractGeometry',
        'subclasses' => [
            'Point'              => Digicademy\DAMap\Domain\Model\SingleGeometry::class,
            'MultiPoint'         => Digicademy\DAMap\Domain\Model\MultiGeometry::class,
            'LineString'         => Digicademy\DAMap\Domain\Model\SingleGeometry::class,
            'MultiLineString'    => Digicademy\DAMap\Domain\Model\MultiGeometry::class,
            'Polygon'            => Digicademy\DAMap\Domain\Model\SingleGeometry::class,
            'MultiPolygon'       => Digicademy\DAMap\Domain\Model\MultiGeometry::class,
            'GeometryCollection' => Digicademy\DAMap\Domain\Model\GeometryCollection::class,
        ]
    ],
];

?>