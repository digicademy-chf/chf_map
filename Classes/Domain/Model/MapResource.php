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
use Digicademy\CHFBase\Domain\Model\AbstractResource;
use Digicademy\CHFBase\Domain\Model\Location;
use Digicademy\CHFObject\Domain\Model\ObjectGroup;

defined('TYPO3') or die();

/**
 * Model for MapResource
 */
class MapResource extends AbstractResource
{
    /**
     * List of all features compiled in this resource
     * 
     * @var ?ObjectStorage<Feature>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ?ObjectStorage $allFeatures = null;

    /**
     * List of all tiles compiled in this resource
     * 
     * @var ?ObjectStorage<Tile>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ?ObjectStorage $allTiles = null;

    /**
     * List of locations that use this map as a floor plan
     * 
     * @var ?ObjectStorage<Location>
     */
    #[Lazy()]
    protected ?ObjectStorage $asFloorPlanOfLocation = null;

    /**
     * List of object groups that use this map
     * 
     * @var ?ObjectStorage<ObjectGroup>
     */
    #[Lazy()]
    protected ?ObjectStorage $asFloorPlanOfObjectGroup = null;

    /**
     * Construct object
     *
     * @param string $langCode
     * @param string $uuid
     * @return MapResource
     */
    public function __construct(string $langCode, string $uuid)
    {
        parent::__construct($langCode, $uuid);
        $this->initializeObject();

        $this->setType('mapResource');
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->allFeatures ??= new ObjectStorage();
        $this->allTiles ??= new ObjectStorage();
        $this->asFloorPlanOfLocation ??= new ObjectStorage();
        $this->asFloorPlanOfObjectGroup ??= new ObjectStorage();
    }

    /**
     * Get all features
     *
     * @return ObjectStorage<Feature>
     */
    public function getAllFeatures(): ?ObjectStorage
    {
        return $this->allFeatures;
    }

    /**
     * Set all features
     *
     * @param ObjectStorage<Feature> $allFeatures
     */
    public function setAllFeatures(ObjectStorage $allFeatures): void
    {
        $this->allFeatures = $allFeatures;
    }

    /**
     * Add all features
     *
     * @param Feature $allFeatures
     */
    public function addAllFeatures(Feature $allFeatures): void
    {
        $this->allFeatures?->attach($allFeatures);
    }

    /**
     * Remove all features
     *
     * @param Feature $allFeatures
     */
    public function removeAllFeatures(Feature $allFeatures): void
    {
        $this->allFeatures?->detach($allFeatures);
    }

    /**
     * Remove all all features
     */
    public function removeAllAllFeatures(): void
    {
        $allFeatures = clone $this->allFeatures;
        $this->allFeatures->removeAll($allFeatures);
    }

    /**
     * Get all tiles
     *
     * @return ObjectStorage<Tile>
     */
    public function getAllTiles(): ?ObjectStorage
    {
        return $this->allTiles;
    }

    /**
     * Set all tiles
     *
     * @param ObjectStorage<Tile> $allTiles
     */
    public function setAllTiles(ObjectStorage $allTiles): void
    {
        $this->allTiles = $allTiles;
    }

    /**
     * Add all tiles
     *
     * @param Tile $allTiles
     */
    public function addAllTiles(Tile $allTiles): void
    {
        $this->allTiles?->attach($allTiles);
    }

    /**
     * Remove all tiles
     *
     * @param Tile $allTiles
     */
    public function removeAllTiles(Tile $allTiles): void
    {
        $this->allTiles?->detach($allTiles);
    }

    /**
     * Remove all all tiles
     */
    public function removeAllAllTiles(): void
    {
        $allTiles = clone $this->allTiles;
        $this->allTiles->removeAll($allTiles);
    }

    /**
     * Get as floor plan of location
     *
     * @return ObjectStorage<Location>
     */
    public function getAsFloorPlanOfLocation(): ?ObjectStorage
    {
        return $this->asFloorPlanOfLocation;
    }

    /**
     * Set as floor plan of location
     *
     * @param ObjectStorage<Location> $asFloorPlanOfLocation
     */
    public function setAsFloorPlanOfLocation(ObjectStorage $asFloorPlanOfLocation): void
    {
        $this->asFloorPlanOfLocation = $asFloorPlanOfLocation;
    }

    /**
     * Add as floor plan of location
     *
     * @param Location $asFloorPlanOfLocation
     */
    public function addAsFloorPlanOfLocation(Location $asFloorPlanOfLocation): void
    {
        $this->asFloorPlanOfLocation?->attach($asFloorPlanOfLocation);
    }

    /**
     * Remove as floor plan of location
     *
     * @param Location $asFloorPlanOfLocation
     */
    public function removeAsFloorPlanOfLocation(Location $asFloorPlanOfLocation): void
    {
        $this->asFloorPlanOfLocation?->detach($asFloorPlanOfLocation);
    }

    /**
     * Remove all as floor plan of locations
     */
    public function removeAllAsFloorPlanOfLocation(): void
    {
        $asFloorPlanOfLocation = clone $this->asFloorPlanOfLocation;
        $this->asFloorPlanOfLocation->removeAll($asFloorPlanOfLocation);
    }

    /**
     * Get as floor plan of object group
     *
     * @return ObjectStorage<ObjectGroup>
     */
    public function getAsFloorPlanOfObjectGroup(): ?ObjectStorage
    {
        return $this->asFloorPlanOfObjectGroup;
    }

    /**
     * Set as floor plan of object group
     *
     * @param ObjectStorage<ObjectGroup> $asFloorPlanOfObjectGroup
     */
    public function setAsFloorPlanOfObjectGroup(ObjectStorage $asFloorPlanOfObjectGroup): void
    {
        $this->asFloorPlanOfObjectGroup = $asFloorPlanOfObjectGroup;
    }

    /**
     * Add as floor plan of object group
     *
     * @param ObjectGroup $asFloorPlanOfObjectGroup
     */
    public function addAsFloorPlanOfObjectGroup(ObjectGroup $asFloorPlanOfObjectGroup): void
    {
        $this->asFloorPlanOfObjectGroup?->attach($asFloorPlanOfObjectGroup);
    }

    /**
     * Remove as floor plan of object group
     *
     * @param ObjectGroup $asFloorPlanOfObjectGroup
     */
    public function removeAsFloorPlanOfObjectGroup(ObjectGroup $asFloorPlanOfObjectGroup): void
    {
        $this->asFloorPlanOfObjectGroup?->detach($asFloorPlanOfObjectGroup);
    }

    /**
     * Remove all as floor plan of object groups
     */
    public function removeAllAsFloorPlanOfObjectGroup(): void
    {
        $asFloorPlanOfObjectGroup = clone $this->asFloorPlanOfObjectGroup;
        $this->asFloorPlanOfObjectGroup->removeAll($asFloorPlanOfObjectGroup);
    }
}
