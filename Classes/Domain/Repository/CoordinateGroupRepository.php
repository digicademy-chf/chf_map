<?php

declare(strict_types=1);

# This file is part of the extension CHF Map for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFMap\Domain\Repository;

use Digicademy\CHFMap\Domain\Model\CoordinateGroup;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * Repository for coordinate groups
 * 
 * @extends Repository<CoordinateGroup>
 */
class CoordinateGroupRepository extends Repository
{
    protected $defaultOrderings = [
        'sorting'     => QueryInterface::ORDER_ASCENDING,
        'coordinates' => QueryInterface::ORDER_ASCENDING,
    ];
}

?>