<?php

declare(strict_types=1);

# This file is part of the extension DA Map for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\DAMap\Domain\Model;

use Digicademy\DAMap\Domain\Validator\StringOptionsValidator;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\ORM\Cascade;
use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Abstract model for features
 */
class AbstractFeature extends AbstractEntity
{
    /**
     * Whether the record should be visisible or not
     * 
     * @var bool
     */
    #[Validate([
        'validator' => 'Boolean',
    ])]
    protected bool $hidden = false;

    /**
     * Resource that this feature is attached to
     * 
     * @var LazyLoadingProxy|MapResource|Feature
     */
    #[Lazy()]
    protected LazyLoadingProxy|MapResource|Feature $parent_id;

    /**
     * Unique identifier of the feature
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'RegularExpression',
        'options'   => [
            'regularExpression' => '^[0-9a-fA-F]{8}\b-[0-9a-fA-F]{4}\b-[0-9a-fA-F]{4}\b-[0-9a-fA-F]{4}\b-[0-9a-fA-F]{12}$',
            'errorMessage'      => 'LLL:EXT:da_map/Resources/Private/Language/locallang.xlf:validator.regularExpression.noUuid',
        ],
    ])]
    protected string $uuid = '';

    /**
     * Name of the feature
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
     * Type of feature
     * 
     * @var string
     */
    #[Validate([
        'validator' => StringOptionsValidator::class,
        'options'   => [
            'allowed' => [
                'Feature',
                'FeatureCollection',
            ],
        ],
    ])]
    protected string $type = '';

    /**
     * Brief information about the feature
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
     * Label to group the feature into
     * 
     * @var ObjectStorage<Tag>
     */
    #[Lazy()]
    protected ObjectStorage $label;

    /**
     * External web address to identify the feature across the web
     * 
     * @var ObjectStorage<SameAs>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $sameAs;

    /**
     * Two coordinates to produce a bounding box
     * 
     * @var ObjectStorage<Coordinates>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $boundingBox;

    /**
     * Construct object
     *
     * @param MapResource $parent_id
     * @param string $uuid
     * @param string $type
     * @return AbstractFeature
     */
    public function __construct(MapResource $parent_id, string $uuid, string $type)
    {
        $this->initializeObject();

        $this->setParentId($parent_id);
        $this->setUuid($uuid);
        $this->setType($type);
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->label       = new ObjectStorage();
        $this->sameAs      = new ObjectStorage();
        $this->boundingBox = new ObjectStorage();
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
     * Get parent ID
     * 
     * @return MapResource|Feature
     */
    public function getParentId(): MapResource|Feature
    {
        if ($this->parent_id instanceof LazyLoadingProxy) {
            $this->parent_id->_loadRealInstance();
        }
        return $this->parent_id;
    }

    /**
     * Set parent ID
     * 
     * @param MapResource|Feature $parent_id
     */
    public function setParentId(MapResource|Feature $parent_id): void
    {
        $this->parent_id = $parent_id;
    }

    /**
     * Get UUID
     *
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * Set UUID
     *
     * @param string $uuid
     */
    public function setUuid(string $uuid): void
    {
        $this->uuid = $uuid;
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
     * Get type
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Set type
     *
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
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
     * Get label
     *
     * @return ObjectStorage<Tag>
     */
    public function getLabel(): ObjectStorage
    {
        return $this->label;
    }

    /**
     * Set label
     *
     * @param ObjectStorage<Tag> $label
     */
    public function setLabel(ObjectStorage $label): void
    {
        $this->label = $label;
    }

    /**
     * Add label
     *
     * @param Tag $label
     */
    public function addLabel(Tag $label): void
    {
        $this->label->attach($label);
    }

    /**
     * Remove label
     *
     * @param Tag $label
     */
    public function removeLabel(Tag $label): void
    {
        $this->label->detach($label);
    }

    /**
     * Remove all labels
     */
    public function removeAllLabels(): void
    {
        $label = clone $this->label;
        $this->label->removeAll($label);
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
     * Get bounding box
     *
     * @return ObjectStorage<Geometry>
     */
    public function getBoundingBox(): ObjectStorage
    {
        return $this->boundingBox;
    }

    /**
     * Set bounding box
     *
     * @param ObjectStorage<Geometry> $boundingBox
     */
    public function setBoundingBox(ObjectStorage $boundingBox): void
    {
        $this->boundingBox = $boundingBox;
    }

    /**
     * Add bounding box
     *
     * @param Geometry $boundingBox
     */
    public function addBoundingBox(Geometry $boundingBox): void
    {
        $this->boundingBox->attach($boundingBox);
    }

    /**
     * Remove bounding box
     *
     * @param Geometry $boundingBox
     */
    public function removeBoundingBox(Geometry $boundingBox): void
    {
        $this->boundingBox->detach($boundingBox);
    }

    /**
     * Remove all bounding boxes
     */
    public function removeAllBoundingBoxes(): void
    {
        $boundingBox = clone $this->boundingBox;
        $this->boundingBox->removeAll($boundingBox);
    }
}

?>