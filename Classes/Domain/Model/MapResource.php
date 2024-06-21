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
     * List of all features compiled in this resource
     * 
     * @var ?ObjectStorage<Feature|FeatureCollection>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ?ObjectStorage $allFeatures = null;

    /**
     * List of locations that use this map as a location plan
     * 
     * @var ?ObjectStorage<Location>
     */
    #[Lazy()]
    protected ?ObjectStorage $asLocationPlanOfLocation = null;

    /**
     * List of object groups that use this map
     * 
     * @var ?ObjectStorage<ObjectGroup>
     */
    #[Lazy()]
    protected ?ObjectStorage $asObjectGroupPlanOfObjectGroup = null;

    /**
     * Construct object
     *
     * @param string $uuid
     * @param string $langCode
     * @return MapResource
     */
    public function __construct(string $uuid, string $langCode)
    {
        parent::__construct($uuid, $langCode);
        $this->initializeObject();

        $this->setType('mapResource');
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->allTiles ??= new ObjectStorage();
        $this->allFeatures ??= new ObjectStorage();
        $this->asLocationPlanOfLocation ??= new ObjectStorage();
        $this->asObjectGroupPlanOfObjectGroup ??= new ObjectStorage();
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
     * Get all features
     *
     * @return ObjectStorage<Feature|FeatureCollection>
     */
    public function getAllFeatures(): ?ObjectStorage
    {
        return $this->allFeatures;
    }

    /**
     * Set all features
     *
     * @param ObjectStorage<Feature|FeatureCollection> $allFeatures
     */
    public function setAllFeatures(ObjectStorage $allFeatures): void
    {
        $this->allFeatures = $allFeatures;
    }

    /**
     * Add all features
     *
     * @param Feature|FeatureCollection $allFeatures
     */
    public function addAllFeatures(Feature|FeatureCollection $allFeatures): void
    {
        $this->allFeatures?->attach($allFeatures);
    }

    /**
     * Remove all features
     *
     * @param Feature|FeatureCollection $allFeatures
     */
    public function removeAllFeatures(Feature|FeatureCollection $allFeatures): void
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
     * Get as location plan of location
     *
     * @return ObjectStorage<Location>
     */
    public function getAsLocationPlanOfLocation(): ?ObjectStorage
    {
        return $this->asLocationPlanOfLocation;
    }

    /**
     * Set as location plan of location
     *
     * @param ObjectStorage<Location> $asLocationPlanOfLocation
     */
    public function setAsLocationPlanOfLocation(ObjectStorage $asLocationPlanOfLocation): void
    {
        $this->asLocationPlanOfLocation = $asLocationPlanOfLocation;
    }

    /**
     * Add as location plan of location
     *
     * @param Location $asLocationPlanOfLocation
     */
    public function addAsLocationPlanOfLocation(Location $asLocationPlanOfLocation): void
    {
        $this->asLocationPlanOfLocation?->attach($asLocationPlanOfLocation);
    }

    /**
     * Remove as location plan of location
     *
     * @param Location $asLocationPlanOfLocation
     */
    public function removeAsLocationPlanOfLocation(Location $asLocationPlanOfLocation): void
    {
        $this->asLocationPlanOfLocation?->detach($asLocationPlanOfLocation);
    }

    /**
     * Remove all as location plan of locations
     */
    public function removeAllAsLocationPlanOfLocation(): void
    {
        $asLocationPlanOfLocation = clone $this->asLocationPlanOfLocation;
        $this->asLocationPlanOfLocation->removeAll($asLocationPlanOfLocation);
    }

    /**
     * Get as object group plan of object group
     *
     * @return ObjectStorage<ObjectGroup>
     */
    public function getAsObjectGroupPlanOfObjectGroup(): ?ObjectStorage
    {
        return $this->asObjectGroupPlanOfObjectGroup;
    }

    /**
     * Set as object group plan of object group
     *
     * @param ObjectStorage<ObjectGroup> $asObjectGroupPlanOfObjectGroup
     */
    public function setAsObjectGroupPlanOfObjectGroup(ObjectStorage $asObjectGroupPlanOfObjectGroup): void
    {
        $this->asObjectGroupPlanOfObjectGroup = $asObjectGroupPlanOfObjectGroup;
    }

    /**
     * Add as object group plan of object group
     *
     * @param ObjectGroup $asObjectGroupPlanOfObjectGroup
     */
    public function addAsObjectGroupPlanOfObjectGroup(ObjectGroup $asObjectGroupPlanOfObjectGroup): void
    {
        $this->asObjectGroupPlanOfObjectGroup?->attach($asObjectGroupPlanOfObjectGroup);
    }

    /**
     * Remove as object group plan of object group
     *
     * @param ObjectGroup $asObjectGroupPlanOfObjectGroup
     */
    public function removeAsObjectGroupPlanOfObjectGroup(ObjectGroup $asObjectGroupPlanOfObjectGroup): void
    {
        $this->asObjectGroupPlanOfObjectGroup?->detach($asObjectGroupPlanOfObjectGroup);
    }

    /**
     * Remove all as object group plan of object groups
     */
    public function removeAllAsObjectGroupPlanOfObjectGroup(): void
    {
        $asObjectGroupPlanOfObjectGroup = clone $this->asObjectGroupPlanOfObjectGroup;
        $this->asObjectGroupPlanOfObjectGroup->removeAll($asObjectGroupPlanOfObjectGroup);
    }
}
