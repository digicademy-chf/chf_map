<?php
declare(strict_types=1);

# This file is part of the extension CHF Map for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFMap\Domain\Repository;

use Digicademy\CHFBase\Domain\Repository\Traits\StoragePageAgnosticTrait;
use Digicademy\CHFMap\Domain\Model\Feature;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

defined('TYPO3') or die();

/**
 * Repository for Feature
 * 
 * @extends Repository<Feature>
 */
class FeatureRepository extends Repository
{
    use StoragePageAgnosticTrait;

    protected $defaultOrderings = [
        'sorting'     => QueryInterface::ORDER_ASCENDING,
        'isHighlight' => QueryInterface::ORDER_ASCENDING,
        'title'       => QueryInterface::ORDER_ASCENDING,
    ];
}
