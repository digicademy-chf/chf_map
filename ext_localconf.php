<?php
declare(strict_types=1);

# This file is part of the extension CHF Map for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


use Digicademy\CHFBase\Controller\AbstractResourceController;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

defined('TYPO3') or die();

// Register 'MapView' content element
ExtensionUtility::configurePlugin(
    'CHFMap',
    'MapView',
    [
        AbstractResourceController::class => 'index',
        AbstractResourceController::class => 'show',
    ],
);
