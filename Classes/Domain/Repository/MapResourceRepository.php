<?php

declare(strict_types=1);

# This file is part of the extension DA Map for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\DAMap\Domain\Repository;

use Digicademy\DAMap\Domain\Model\MapResource;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * Repository for map resources
 * 
 * @extends Repository<MapResource>
 */
class MapResourceRepository extends Repository
{
    protected $defaultOrderings = [
        'sorting' => QueryInterface::ORDER_ASCENDING,
        'title'   => QueryInterface::ORDER_ASCENDING,
        'uri'     => QueryInterface::ORDER_ASCENDING,
    ];
}

?>