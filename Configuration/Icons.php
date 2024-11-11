<?php
declare(strict_types=1);

# This file is part of the extension CHF Map for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


use TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider;
use TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider;

defined('TYPO3') or die();

// Extension-provided icons
return [
    'tx-chfmap' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:chf_map/Resources/Public/Icons/Extension.svg',
    ],
    'tx-chfmap-table-coordinate-group' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:chf_map/Resources/Public/Icons/TableCoordinateGroup.svg',
    ],
    'tx-chfmap-table-coordinates' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:chf_map/Resources/Public/Icons/TableCoordinates.svg',
    ],
    'tx-chfmap-table-feature' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:chf_map/Resources/Public/Icons/TableFeature.svg',
    ],
    'tx-chfmap-table-geometry' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:chf_map/Resources/Public/Icons/TableGeometry.svg',
    ],
    'tx-chfmap-table-tile' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:chf_map/Resources/Public/Icons/TableTile.svg',
    ],
    'tx-chfmap-plugin-map' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:chf_map/Resources/Public/Icons/PluginMap.svg',
    ],
];
