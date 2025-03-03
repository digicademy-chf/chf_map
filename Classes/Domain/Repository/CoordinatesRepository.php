<?php
declare(strict_types=1);

# This file is part of the extension CHF Map for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFMap\Domain\Repository;

use Digicademy\CHFBase\Domain\Repository\Traits\StoragePageAgnosticTrait;
use Digicademy\CHFMap\Domain\Model\Coordinates;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

defined('TYPO3') or die();

/**
 * Repository for Coordinates
 * 
 * @extends Repository<Coordinates>
 */
class CoordinatesRepository extends Repository
{
    use StoragePageAgnosticTrait;

    protected $defaultOrderings = [
        'sorting'   => QueryInterface::ORDER_ASCENDING,
        'longitude' => QueryInterface::ORDER_ASCENDING,
        'latitude'  => QueryInterface::ORDER_ASCENDING,
        'altitude'  => QueryInterface::ORDER_ASCENDING,
    ];
}
