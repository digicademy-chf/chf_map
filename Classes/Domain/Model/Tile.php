<?php
declare(strict_types=1);

# This file is part of the extension CHF Map for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFMap\Domain\Model;

use TYPO3\CMS\Core\Resource\FileReference;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\ORM\Cascade;
use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

defined('TYPO3') or die();

/**
 * Model for Tile
 */
class Tile extends AbstractEntity
{
    /**
     * Whether the record should be visible or not
     * 
     * @var bool
     */
    #[Validate([
        'validator' => 'Boolean',
    ])]
    protected bool $hidden = true;

    /**
     * Resource that this database record is part of
     * 
     * @var ?ObjectStorage<object>
     */
    #[Lazy()]
    protected ?ObjectStorage $parentResource = null;

    /**
     * Name of the tile layer
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
     * External web address of the tile layer, including wildcards for coordinates and zoom
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'Url',
    ])]
    protected string $uri = '';

    /**
     * Internal image file to use as the tile layer
     * 
     * @var FileReference|LazyLoadingProxy|null
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected FileReference|LazyLoadingProxy|null $image = null;

    /**
     * Construct object
     *
     * @param MapResource $parentResource
     * @param string $title
     * @return Tile
     */
    public function __construct(MapResource $parentResource, string $title)
    {
        $this->initializeObject();
    
        $this->addParentResource($parentResource);
        $this->setTitle($title);
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->parentResource ??= new ObjectStorage();
    }

    /**
     * Get hidden
     *
     * @return bool
     */
    public function getHidden(): bool
    {
        return $this->hidden;
    }

    /**
     * Set hidden
     *
     * @param bool $hidden
     */
    public function setHidden(bool $hidden): void
    {
        $this->hidden = $hidden;
    }

    /**
     * Get parent resource
     *
     * @return ObjectStorage<object>
     */
    public function getParentResource(): ?ObjectStorage
    {
        return $this->parentResource;
    }

    /**
     * Set parent resource
     *
     * @param ObjectStorage<object> $parentResource
     */
    public function setParentResource(ObjectStorage $parentResource): void
    {
        $this->parentResource = $parentResource;
    }

    /**
     * Add parent resource
     *
     * @param object $parentResource
     */
    public function addParentResource(object $parentResource): void
    {
        $this->parentResource?->attach($parentResource);
    }

    /**
     * Remove parent resource
     *
     * @param object $parentResource
     */
    public function removeParentResource(object $parentResource): void
    {
        $this->parentResource?->detach($parentResource);
    }

    /**
     * Remove all parent resources
     */
    public function removeAllParentResource(): void
    {
        $parentResource = clone $this->parentResource;
        $this->parentResource->removeAll($parentResource);
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
     * Get image
     * 
     * @return FileReference
     */
    public function getImage(): FileReference
    {
        if ($this->image instanceof LazyLoadingProxy) {
            $this->image->_loadRealInstance();
        }
        return $this->image;
    }

    /**
     * Set image
     * 
     * @param FileReference
     */
    public function setImage(FileReference $image): void
    {
        $this->image = $image;
    }
}
