<?php

declare(strict_types=1);

# This file is part of the extension DA Map for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


return [
    Digicademy\DAMap\Domain\Model\Feature::class => [
        'tableName' => 'tx_damap_domain_model_feature',
        'recordType' => 'Feature',
    ],
    Digicademy\DAMap\Domain\Model\FeatureCollection::class => [
        'tableName' => 'tx_damap_domain_model_feature',
        'recordType' => 'FeatureCollection',
    ],
    Digicademy\DAMap\Domain\Model\PointGeometry::class => [
        'tableName' => 'tx_damap_domain_model_geometry',
        'recordType' => 'Point',
    ],
    Digicademy\DAMap\Domain\Model\MultiPointGeometry::class => [
        'tableName' => 'tx_damap_domain_model_geometry',
        'recordType' => 'MultiPoint',
    ],
    Digicademy\DAMap\Domain\Model\LineStringGeometry::class => [
        'tableName' => 'tx_damap_domain_model_geometry',
        'recordType' => 'LineString',
    ],
    Digicademy\DAMap\Domain\Model\MultiLineStringGeometry::class => [
        'tableName' => 'tx_damap_domain_model_geometry',
        'recordType' => 'MultiLineString',
    ],
    Digicademy\DAMap\Domain\Model\PolygonGeometry::class => [
        'tableName' => 'tx_damap_domain_model_geometry',
        'recordType' => 'Polygon',
    ],
    Digicademy\DAMap\Domain\Model\MultiPolygonGeometry::class => [
        'tableName' => 'tx_damap_domain_model_geometry',
        'recordType' => 'MultiPolygon',
    ],
    Digicademy\DAMap\Domain\Model\GeometryCollection::class => [
        'tableName' => 'tx_damap_domain_model_geometry',
        'recordType' => 'GeometryCollection',
    ],
];

?>