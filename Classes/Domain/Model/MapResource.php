<?php

declare(strict_types=1);

# This file is part of the extension DA Map for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\DAMap\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Cascade;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Model for map resources
 */
class MapResource extends AbstractEntity
{
    /**
     * Name of the map
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options'   => [
            'maximum' => 255,
        ],
    ])]
    protected string $title = '';

    /**
     * Brief information about the map
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options'   => [
            'maximum' => 2000,
        ],
    ])]
    protected string $description = '';

    /**
     * Web address of the map
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'Url',
    ])]
    protected string $uri = '';

    /**
     * External web address to identify the map across the web
     * 
     * @var ObjectStorage<SameAs>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $sameAs;

    /**
     * File to display as the base map
     * 
     * @var ObjectStorage<FileReference>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $mapFile;

    /**
     * Tile layers to use instead of a file
     * 
     * @var ObjectStorage<Tiles>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $mapTiles;

    /**
     * List of all features in this resource
     * 
     * @var ObjectStorage<Feature|FeatureCollection>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $feature;

    /**
     * List of all tags in this resource
     * 
     * @var ObjectStorage<Tag>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $tag;

    /**
     * Construct object
     *
     * @return MapResource
     */
    public function __construct()
    {
        $this->initializeObject();
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->sameAs   = new ObjectStorage();
        $this->mapFile  = new ObjectStorage();
        $this->mapTiles = new ObjectStorage();
        $this->feature  = new ObjectStorage();
        $this->tag      = new ObjectStorage();
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Set title
     *
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Set description
     *
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * Get URI
     *
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * Set URI
     *
     * @param string $uri
     */
    public function setUri(string $uri): void
    {
        $this->uri = $uri;
    }

    /**
     * Get same as
     *
     * @return ObjectStorage<SameAs>
     */
    public function getSameAs(): ObjectStorage
    {
        return $this->sameAs;
    }

    /**
     * Set same as
     *
     * @param ObjectStorage<SameAs> $sameAs
     */
    public function setSameAs(ObjectStorage $sameAs): void
    {
        $this->sameAs = $sameAs;
    }

    /**
     * Add same as
     *
     * @param SameAs $sameAs
     */
    public function addSameAs(SameAs $sameAs): void
    {
        $this->sameAs->attach($sameAs);
    }

    /**
     * Remove same as
     *
     * @param SameAs $sameAs
     */
    public function removeSameAs(SameAs $sameAs): void
    {
        $this->sameAs->detach($sameAs);
    }

    /**
     * Remove all same as
     */
    public function removeAllSameAs(): void
    {
        $sameAs = clone $this->sameAs;
        $this->sameAs->removeAll($sameAs);
    }

    /**
     * Get mapFile
     *
     * @return ObjectStorage<FileReference>
     */
    public function getMapFile(): ObjectStorage
    {
        return $this->mapFile;
    }

    /**
     * Set mapFile
     *
     * @param ObjectStorage<FileReference> $mapFile
     */
    public function setMapFile(ObjectStorage $mapFile): void
    {
        $this->mapFile = $mapFile;
    }

    /**
     * Add mapFile
     *
     * @param FileReference $mapFile
     */
    public function addMapFile(FileReference $mapFile): void
    {
        $this->mapFile->attach($mapFile);
    }

    /**
     * Remove mapFile
     *
     * @param FileReference $mapFile
     */
    public function removeMapFile(FileReference $mapFile): void
    {
        $this->mapFile->detach($mapFile);
    }

    /**
     * Remove all mapFiles
     */
    public function removeAllMapFiles(): void
    {
        $mapFile = clone $this->mapFile;
        $this->mapFile->removeAll($mapFile);
    }

    /**
     * Get map tiles
     *
     * @return ObjectStorage<Tiles>
     */
    public function getMapTiles(): ObjectStorage
    {
        return $this->mapTiles;
    }

    /**
     * Set map tiles
     *
     * @param ObjectStorage<Tiles> $mapTiles
     */
    public function setMapTiles(ObjectStorage $mapTiles): void
    {
        $this->mapTiles = $mapTiles;
    }

    /**
     * Add map tiles
     *
     * @param Tiles $mapTiles
     */
    public function addMapTiles(Tiles $mapTiles): void
    {
        $this->mapTiles->attach($mapTiles);
    }

    /**
     * Remove map tiles
     *
     * @param Tiles $mapTiles
     */
    public function removeMapTiles(Tiles $mapTiles): void
    {
        $this->mapTiles->detach($mapTiles);
    }

    /**
     * Remove all map tiles
     */
    public function removeAllEntries(): void
    {
        $mapTiles = clone $this->mapTiles;
        $this->mapTiles->removeAll($mapTiles);
    }

    /**
     * Get feature
     *
     * @return ObjectStorage<Feature|FeatureCollection>
     */
    public function getFeature(): ObjectStorage
    {
        return $this->feature;
    }

    /**
     * Set feature
     *
     * @param ObjectStorage<Feature|FeatureCollection> $feature
     */
    public function setFeature(ObjectStorage $feature): void
    {
        $this->feature = $feature;
    }

    /**
     * Add feature
     *
     * @param Feature|FeatureCollection $feature
     */
    public function addFeature(Feature|FeatureCollection $feature): void
    {
        $this->feature->attach($feature);
    }

    /**
     * Remove feature
     *
     * @param Feature|FeatureCollection $feature
     */
    public function removeFeature(Feature|FeatureCollection $feature): void
    {
        $this->feature->detach($feature);
    }

    /**
     * Remove all features
     */
    public function removeAllFeatures(): void
    {
        $feature = clone $this->feature;
        $this->feature->removeAll($feature);
    }

    /**
     * Get tag
     *
     * @return ObjectStorage<Tag>
     */
    public function getTag(): ObjectStorage
    {
        return $this->tag;
    }

    /**
     * Set tag
     *
     * @param ObjectStorage<Tag> $tag
     */
    public function setTag(ObjectStorage $tag): void
    {
        $this->tag = $tag;
    }

    /**
     * Add tag
     *
     * @param Tag $tag
     */
    public function addTag(Tag $tag): void
    {
        $this->tag->attach($tag);
    }

    /**
     * Remove tag
     *
     * @param Tag $tag
     */
    public function removeTag(Tag $tag): void
    {
        $this->tag->detach($tag);
    }

    /**
     * Remove all tags
     */
    public function removeAllTags(): void
    {
        $tag = clone $this->tag;
        $this->tag->removeAll($tag);
    }
}

?>