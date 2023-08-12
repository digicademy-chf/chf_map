<?php

declare(strict_types=1);

# This file is part of the extension DA Map for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\DAMap\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\ORM\Cascade;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Model for coordinate groups
 */
class CoordinateGroup extends AbstractEntity
{
    /**
     * List of coordinates in this group
     * 
     * @var ObjectStorage<Coordinates>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $coordinates;

    /**
     * Get coordinates
     *
     * @return ObjectStorage<Coordinates>
     */
    public function getCoordinates(): ObjectStorage
    {
        return $this->coordinates;
    }

    /**
     * Set coordinates
     *
     * @param ObjectStorage<Coordinates> $coordinates
     */
    public function setCoordinates(ObjectStorage $coordinates): void
    {
        $this->coordinates = $coordinates;
    }

    /**
     * Add coordinates
     *
     * @param Coordinates $coordinates
     */
    public function addCoordinates(Coordinates $coordinates): void
    {
        $this->coordinates->attach($coordinates);
    }

    /**
     * Remove coordinates
     *
     * @param Coordinates $coordinates
     */
    public function removeCoordinates(Coordinates $coordinates): void
    {
        $this->coordinates->detach($coordinates);
    }

    /**
     * Remove all coordinates
     */
    public function removeAllCoordinates(): void
    {
        $coordinates = clone $this->coordinates;
        $this->coordinates->removeAll($coordinates);
    }
}

?>