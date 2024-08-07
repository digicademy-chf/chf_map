<?php
declare(strict_types=1);

# This file is part of the extension CHF Map for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFMap\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\ORM\Cascade;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

defined('TYPO3') or die();

/**
 * Model for MultiGeometry
 */
class MultiGeometry extends AbstractGeometry
{
    /**
     * List of coordinate groups in this geometry
     * 
     * @var ?ObjectStorage<CoordinateGroup>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ?ObjectStorage $coordinateGroup = null;

    /**
     * Construct object
     *
     * @param string $type
     * @return MultiGeometry
     */
    public function __construct(string $type)
    {
        parent::__construct($type);
        $this->initializeObject();
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->coordinateGroup ??= new ObjectStorage();
    }

    /**
     * Get coordinate group
     *
     * @return ObjectStorage<CoordinateGroup>
     */
    public function getCoordinateGroup(): ?ObjectStorage
    {
        return $this->coordinateGroup;
    }

    /**
     * Set coordinate group
     *
     * @param ObjectStorage<CoordinateGroup> $coordinateGroup
     */
    public function setCoordinateGroup(ObjectStorage $coordinateGroup): void
    {
        $this->coordinateGroup = $coordinateGroup;
    }

    /**
     * Add coordinate group
     *
     * @param CoordinateGroup $coordinateGroup
     */
    public function addCoordinateGroup(CoordinateGroup $coordinateGroup): void
    {
        $this->coordinateGroup?->attach($coordinateGroup);
    }

    /**
     * Remove coordinate group
     *
     * @param CoordinateGroup $coordinateGroup
     */
    public function removeCoordinateGroup(CoordinateGroup $coordinateGroup): void
    {
        $this->coordinateGroup?->detach($coordinateGroup);
    }

    /**
     * Remove all coordinate groups
     */
    public function removeAllCoordinateGroup(): void
    {
        $coordinateGroup = clone $this->coordinateGroup;
        $this->coordinateGroup->removeAll($coordinateGroup);
    }
}
