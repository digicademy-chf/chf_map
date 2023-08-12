<?php

declare(strict_types=1);

# This file is part of the extension DA Map for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\DAMap\Domain\Repository;

use Digicademy\DAMap\Domain\Model\Coordinates;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * Repository for coordinates
 * 
 * @extends Repository<Coordinates>
 */
class CoordinatesRepository extends Repository
{
    protected $defaultOrderings = [
        'sorting'   => QueryInterface::ORDER_ASCENDING,
        'longitude' => QueryInterface::ORDER_ASCENDING,
        'latitude'  => QueryInterface::ORDER_ASCENDING,
        'altitude'  => QueryInterface::ORDER_ASCENDING,
    ];
}

?>