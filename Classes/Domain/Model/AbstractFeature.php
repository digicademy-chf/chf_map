<?php
declare(strict_types=1);

# This file is part of the extension CHF Map for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFMap\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\ORM\Cascade;
use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use Digicademy\CHFBase\Domain\Model\AbstractBase;
use Digicademy\CHFBase\Domain\Model\LabelTag;
use Digicademy\CHFBase\Domain\Model\LinkRelation;
use Digicademy\CHFBase\Domain\Model\Location;
use Digicademy\CHFBase\Domain\Validator\StringOptionsValidator;
use Digicademy\CHFBib\Domain\Model\SourceRelation;
use Digicademy\CHFLex\Domain\Model\Frequency;
use Digicademy\CHFMedia\Domain\Model\FileMetadata;
use Digicademy\CHFObject\Domain\Model\SingleObject;
use Digicademy\CHFObject\Domain\Model\ObjectGroup;
use Digicademy\CHFPub\Domain\Model\PublicationRelation;

defined('TYPO3') or die();

/**
 * Model for AbstractFeature
 */
class AbstractFeature extends AbstractBase
{
    /**
     * Type of feature
     * 
     * @var string
     */
    #[Validate([
        'validator' => StringOptionsValidator::class,
        'options'   => [
            'allowed' => [
                'feature',
                'featureCollection',
            ],
        ],
    ])]
    protected string $type = 'feature';

    /**
     * Name of the feature
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options' => [
            'maximum' => 255,
        ],
    ])]
    protected string $title = '';

    /**
     * Brief information about the feature
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options' => [
            'maximum' => 2000,
        ],
    ])]
    protected string $description = '';

    /**
     * Two sets of coordinates to produce a bounding box
     * 
     * @var ?ObjectStorage<Coordinates>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ?ObjectStorage $boundingBox = null;

    /**
     * Label to group the database record into
     * 
     * @var ?ObjectStorage<LabelTag>
     */
    #[Lazy()]
    protected ?ObjectStorage $label = null;

    /**
     * Sources of this database record
     * 
     * @var ?ObjectStorage<SourceRelation>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ?ObjectStorage $sourceRelation = null;

    /**
     * Links relevant to this database record
     * 
     * @var ?ObjectStorage<LinkRelation>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ?ObjectStorage $linkRelation = null;

    /**
     * Relevant text publications in the database
     * 
     * @var ?ObjectStorage<PublicationRelation>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ?ObjectStorage $publicationRelation = null;

    /**
     * Lists this record without its content
     * 
     * @var bool
     */
    #[Validate([
        'validator' => 'Boolean',
    ])]
    protected bool $isTeaser = false;

    /**
     * Makes this record available at the top of lists
     * 
     * @var bool
     */
    #[Validate([
        'validator' => 'Boolean',
    ])]
    protected bool $isHighlight = false;

    /**
     * Resource that this database record is part of
     * 
     * @var ?ObjectStorage<MapResource>
     */
    #[Lazy()]
    protected ?ObjectStorage $parentResource = null;

    /**
     * Full import code that this record is based on
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options'   => [
            'maximum' => 100000,
        ],
    ])]
    protected string $import = '';

    /**
     * List of locations that use this feature as geodata
     * 
     * @var ?ObjectStorage<Location>
     */
    #[Lazy()]
    protected ?ObjectStorage $asGeodataOfLocation = null;

    /**
     * List of files that use this feature as geodata
     * 
     * @var ?ObjectStorage<FileMetadata>
     */
    #[Lazy()]
    protected ?ObjectStorage $asGeodataOfFileMetadata = null;

    /**
     * List of frequencies that use this feature as geodata
     * 
     * @var ?ObjectStorage<Frequency>
     */
    #[Lazy()]
    protected ?ObjectStorage $asGeodataOfFrequency = null;

    /**
     * List of single objects that use this feature as geodata
     * 
     * @var ?ObjectStorage<SingleObject>
     */
    #[Lazy()]
    protected ?ObjectStorage $asGeodataOfSingleObject = null;

    /**
     * List of object groups that use this feature as geodata
     * 
     * @var ?ObjectStorage<ObjectGroup>
     */
    #[Lazy()]
    protected ?ObjectStorage $asGeodataOfObjectGroup = null;

    /**
     * List of variant relations that this feature is part of
     * 
     * @var ?ObjectStorage<VariantRelation>
     */
    #[Lazy()]
    protected ?ObjectStorage $asFeatureOfVariantRelation = null;

    /**
     * Construct object
     *
     * @param MapResource $parentResource
     * @param string $uuid
     * @return AbstractFeature
     */
    public function __construct(MapResource $parentResource, string $uuid)
    {
        parent::__construct($uuid);
        $this->initializeObject();

        $this->addParentResource($parentResource);
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->boundingBox ??= new ObjectStorage();
        $this->label ??= new ObjectStorage();
        $this->sourceRelation ??= new ObjectStorage();
        $this->linkRelation ??= new ObjectStorage();
        $this->publicationRelation ??= new ObjectStorage();
        $this->parentResource ??= new ObjectStorage();
        $this->asGeodataOfLocation ??= new ObjectStorage();
        $this->asGeodataOfFileMetadata ??= new ObjectStorage();
        $this->asGeodataOfFrequency ??= new ObjectStorage();
        $this->asGeodataOfSingleObject ??= new ObjectStorage();
        $this->asGeodataOfObjectGroup ??= new ObjectStorage();
        $this->asFeatureOfVariantRelation ??= new ObjectStorage();
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
     * Get title
     *
     * @return string
     */
    public function getCode(): string
    {
        return $this->title;
    }

    /**
     * Set title
     *
     * @param string $title
     */
    public function setCode(string $title): void
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
     * Get bounding box
     *
     * @return ObjectStorage<Coordinates>
     */
    public function getBoundingBox(): ?ObjectStorage
    {
        return $this->boundingBox;
    }

    /**
     * Set bounding box
     *
     * @param ObjectStorage<Coordinates> $boundingBox
     */
    public function setBoundingBox(ObjectStorage $boundingBox): void
    {
        $this->boundingBox = $boundingBox;
    }

    /**
     * Add bounding box
     *
     * @param Coordinates $boundingBox
     */
    public function addBoundingBox(Coordinates $boundingBox): void
    {
        $this->boundingBox?->attach($boundingBox);
    }

    /**
     * Remove bounding box
     *
     * @param Coordinates $boundingBox
     */
    public function removeBoundingBox(Coordinates $boundingBox): void
    {
        $this->boundingBox?->detach($boundingBox);
    }

    /**
     * Remove all bounding boxes
     */
    public function removeAllBoundingBox(): void
    {
        $boundingBox = clone $this->boundingBox;
        $this->boundingBox->removeAll($boundingBox);
    }

    /**
     * Get label
     *
     * @return ObjectStorage<LabelTag>
     */
    public function getLabel(): ?ObjectStorage
    {
        return $this->label;
    }

    /**
     * Set label
     *
     * @param ObjectStorage<LabelTag> $label
     */
    public function setLabel(ObjectStorage $label): void
    {
        $this->label = $label;
    }

    /**
     * Add label
     *
     * @param LabelTag $label
     */
    public function addLabel(LabelTag $label): void
    {
        $this->label?->attach($label);
    }

    /**
     * Remove label
     *
     * @param LabelTag $label
     */
    public function removeLabel(LabelTag $label): void
    {
        $this->label?->detach($label);
    }

    /**
     * Remove all labels
     */
    public function removeAllLabel(): void
    {
        $label = clone $this->label;
        $this->label->removeAll($label);
    }

    /**
     * Get source relation
     *
     * @return ObjectStorage<SourceRelation>
     */
    public function getSourceRelation(): ?ObjectStorage
    {
        return $this->sourceRelation;
    }

    /**
     * Set source relation
     *
     * @param ObjectStorage<SourceRelation> $sourceRelation
     */
    public function setSourceRelation(ObjectStorage $sourceRelation): void
    {
        $this->sourceRelation = $sourceRelation;
    }

    /**
     * Add source relation
     *
     * @param SourceRelation $sourceRelation
     */
    public function addSourceRelation(SourceRelation $sourceRelation): void
    {
        $this->sourceRelation?->attach($sourceRelation);
    }

    /**
     * Remove source relation
     *
     * @param SourceRelation $sourceRelation
     */
    public function removeSourceRelation(SourceRelation $sourceRelation): void
    {
        $this->sourceRelation?->detach($sourceRelation);
    }

    /**
     * Remove all source relations
     */
    public function removeAllSourceRelation(): void
    {
        $sourceRelation = clone $this->sourceRelation;
        $this->sourceRelation->removeAll($sourceRelation);
    }

    /**
     * Get link relation
     *
     * @return ObjectStorage<LinkRelation>
     */
    public function getLinkRelation(): ?ObjectStorage
    {
        return $this->linkRelation;
    }

    /**
     * Set link relation
     *
     * @param ObjectStorage<LinkRelation> $linkRelation
     */
    public function setLinkRelation(ObjectStorage $linkRelation): void
    {
        $this->linkRelation = $linkRelation;
    }

    /**
     * Add link relation
     *
     * @param LinkRelation $linkRelation
     */
    public function addLinkRelation(LinkRelation $linkRelation): void
    {
        $this->linkRelation?->attach($linkRelation);
    }

    /**
     * Remove link relation
     *
     * @param LinkRelation $linkRelation
     */
    public function removeLinkRelation(LinkRelation $linkRelation): void
    {
        $this->linkRelation?->detach($linkRelation);
    }

    /**
     * Remove all link relations
     */
    public function removeAllLinkRelation(): void
    {
        $linkRelation = clone $this->linkRelation;
        $this->linkRelation->removeAll($linkRelation);
    }

    /**
     * Get publication relation
     *
     * @return ObjectStorage<PublicationRelation>
     */
    public function getPublicationRelation(): ?ObjectStorage
    {
        return $this->publicationRelation;
    }

    /**
     * Set publication relation
     *
     * @param ObjectStorage<PublicationRelation> $publicationRelation
     */
    public function setPublicationRelation(ObjectStorage $publicationRelation): void
    {
        $this->publicationRelation = $publicationRelation;
    }

    /**
     * Add publication relation
     *
     * @param PublicationRelation $publicationRelation
     */
    public function addPublicationRelation(PublicationRelation $publicationRelation): void
    {
        $this->publicationRelation?->attach($publicationRelation);
    }

    /**
     * Remove publication relation
     *
     * @param PublicationRelation $publicationRelation
     */
    public function removePublicationRelation(PublicationRelation $publicationRelation): void
    {
        $this->publicationRelation?->detach($publicationRelation);
    }

    /**
     * Remove all publication relations
     */
    public function removeAllPublicationRelation(): void
    {
        $publicationRelation = clone $this->publicationRelation;
        $this->publicationRelation->removeAll($publicationRelation);
    }

    /**
     * Get is teaser
     *
     * @return bool
     */
    public function getIsTeaser(): bool
    {
        return $this->isTeaser;
    }

    /**
     * Set is teaser
     *
     * @param bool $isTeaser
     */
    public function setIsTeaser(bool $isTeaser): void
    {
        $this->isTeaser = $isTeaser;
    }

    /**
     * Get is highlight
     *
     * @return bool
     */
    public function getIsHighlight(): bool
    {
        return $this->isHighlight;
    }

    /**
     * Set is highlight
     *
     * @param bool $isHighlight
     */
    public function setIsHighlight(bool $isHighlight): void
    {
        $this->isHighlight = $isHighlight;
    }

    /**
     * Get parent resource
     *
     * @return ObjectStorage<MapResource>
     */
    public function getParentResource(): ?ObjectStorage
    {
        return $this->parentResource;
    }

    /**
     * Set parent resource
     *
     * @param ObjectStorage<MapResource> $parentResource
     */
    public function setParentResource(ObjectStorage $parentResource): void
    {
        $this->parentResource = $parentResource;
    }

    /**
     * Add parent resource
     *
     * @param MapResource $parentResource
     */
    public function addParentResource(MapResource $parentResource): void
    {
        $this->parentResource?->attach($parentResource);
    }

    /**
     * Remove parent resource
     *
     * @param MapResource $parentResource
     */
    public function removeParentResource(MapResource $parentResource): void
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
     * Get import
     *
     * @return string
     */
    public function getImport(): string
    {
        return $this->import;
    }

    /**
     * Set import
     *
     * @param string $import
     */
    public function setImport(string $import): void
    {
        $this->import = $import;
    }

    /**
     * Get as geodata of location
     *
     * @return ObjectStorage<Location>
     */
    public function getAsGeodataOfLocation(): ?ObjectStorage
    {
        return $this->asGeodataOfLocation;
    }

    /**
     * Set as geodata of location
     *
     * @param ObjectStorage<Location> $asGeodataOfLocation
     */
    public function setAsGeodataOfLocation(ObjectStorage $asGeodataOfLocation): void
    {
        $this->asGeodataOfLocation = $asGeodataOfLocation;
    }

    /**
     * Add as geodata of location
     *
     * @param Location $asGeodataOfLocation
     */
    public function addAsGeodataOfLocation(Location $asGeodataOfLocation): void
    {
        $this->asGeodataOfLocation?->attach($asGeodataOfLocation);
    }

    /**
     * Remove as geodata of location
     *
     * @param Location $asGeodataOfLocation
     */
    public function removeAsGeodataOfLocation(Location $asGeodataOfLocation): void
    {
        $this->asGeodataOfLocation?->detach($asGeodataOfLocation);
    }

    /**
     * Remove all as geodata of locations
     */
    public function removeAllAsGeodataOfLocation(): void
    {
        $asGeodataOfLocation = clone $this->asGeodataOfLocation;
        $this->asGeodataOfLocation->removeAll($asGeodataOfLocation);
    }

    /**
     * Get as geodata of file metadata
     *
     * @return ObjectStorage<FileMetadata>
     */
    public function getAsGeodataOfFileMetadata(): ?ObjectStorage
    {
        return $this->asGeodataOfFileMetadata;
    }

    /**
     * Set as geodata of file metadata
     *
     * @param ObjectStorage<FileMetadata> $asGeodataOfFileMetadata
     */
    public function setAsGeodataOfFileMetadata(ObjectStorage $asGeodataOfFileMetadata): void
    {
        $this->asGeodataOfFileMetadata = $asGeodataOfFileMetadata;
    }

    /**
     * Add as geodata of file metadata
     *
     * @param FileMetadata $asGeodataOfFileMetadata
     */
    public function addAsGeodataOfFileMetadata(FileMetadata $asGeodataOfFileMetadata): void
    {
        $this->asGeodataOfFileMetadata?->attach($asGeodataOfFileMetadata);
    }

    /**
     * Remove as geodata of file metadata
     *
     * @param FileMetadata $asGeodataOfFileMetadata
     */
    public function removeAsGeodataOfFileMetadata(FileMetadata $asGeodataOfFileMetadata): void
    {
        $this->asGeodataOfFileMetadata?->detach($asGeodataOfFileMetadata);
    }

    /**
     * Remove all as geodata of file metadatas
     */
    public function removeAllAsGeodataOfFileMetadata(): void
    {
        $asGeodataOfFileMetadata = clone $this->asGeodataOfFileMetadata;
        $this->asGeodataOfFileMetadata->removeAll($asGeodataOfFileMetadata);
    }

    /**
     * Get as geodata of frequency
     *
     * @return ObjectStorage<Frequency>
     */
    public function getAsGeodataOfFrequency(): ?ObjectStorage
    {
        return $this->asGeodataOfFrequency;
    }

    /**
     * Set as geodata of frequency
     *
     * @param ObjectStorage<Frequency> $asGeodataOfFrequency
     */
    public function setAsGeodataOfFrequency(ObjectStorage $asGeodataOfFrequency): void
    {
        $this->asGeodataOfFrequency = $asGeodataOfFrequency;
    }

    /**
     * Add as geodata of frequency
     *
     * @param Frequency $asGeodataOfFrequency
     */
    public function addAsGeodataOfFrequency(Frequency $asGeodataOfFrequency): void
    {
        $this->asGeodataOfFrequency?->attach($asGeodataOfFrequency);
    }

    /**
     * Remove as geodata of frequency
     *
     * @param Frequency $asGeodataOfFrequency
     */
    public function removeAsGeodataOfFrequency(Frequency $asGeodataOfFrequency): void
    {
        $this->asGeodataOfFrequency?->detach($asGeodataOfFrequency);
    }

    /**
     * Remove all as geodata of frequencies
     */
    public function removeAllAsGeodataOfFrequency(): void
    {
        $asGeodataOfFrequency = clone $this->asGeodataOfFrequency;
        $this->asGeodataOfFrequency->removeAll($asGeodataOfFrequency);
    }

    /**
     * Get as geodata of single object
     *
     * @return ObjectStorage<SingleObject>
     */
    public function getAsGeodataOfSingleObject(): ?ObjectStorage
    {
        return $this->asGeodataOfSingleObject;
    }

    /**
     * Set as geodata of single object
     *
     * @param ObjectStorage<SingleObject> $asGeodataOfSingleObject
     */
    public function setAsGeodataOfSingleObject(ObjectStorage $asGeodataOfSingleObject): void
    {
        $this->asGeodataOfSingleObject = $asGeodataOfSingleObject;
    }

    /**
     * Add as geodata of single object
     *
     * @param SingleObject $asGeodataOfSingleObject
     */
    public function addAsGeodataOfSingleObject(SingleObject $asGeodataOfSingleObject): void
    {
        $this->asGeodataOfSingleObject?->attach($asGeodataOfSingleObject);
    }

    /**
     * Remove as geodata of single object
     *
     * @param SingleObject $asGeodataOfSingleObject
     */
    public function removeAsGeodataOfSingleObject(SingleObject $asGeodataOfSingleObject): void
    {
        $this->asGeodataOfSingleObject?->detach($asGeodataOfSingleObject);
    }

    /**
     * Remove all as geodata of single objects
     */
    public function removeAllAsGeodataOfSingleObject(): void
    {
        $asGeodataOfSingleObject = clone $this->asGeodataOfSingleObject;
        $this->asGeodataOfSingleObject->removeAll($asGeodataOfSingleObject);
    }

    /**
     * Get as geodata of object group
     *
     * @return ObjectStorage<ObjectGroup>
     */
    public function getAsGeodataOfObjectGroup(): ?ObjectStorage
    {
        return $this->asGeodataOfObjectGroup;
    }

    /**
     * Set as geodata of object group
     *
     * @param ObjectStorage<ObjectGroup> $asGeodataOfObjectGroup
     */
    public function setAsGeodataOfObjectGroup(ObjectStorage $asGeodataOfObjectGroup): void
    {
        $this->asGeodataOfObjectGroup = $asGeodataOfObjectGroup;
    }

    /**
     * Add as geodata of object group
     *
     * @param ObjectGroup $asGeodataOfObjectGroup
     */
    public function addAsGeodataOfObjectGroup(ObjectGroup $asGeodataOfObjectGroup): void
    {
        $this->asGeodataOfObjectGroup?->attach($asGeodataOfObjectGroup);
    }

    /**
     * Remove as geodata of object group
     *
     * @param ObjectGroup $asGeodataOfObjectGroup
     */
    public function removeAsGeodataOfObjectGroup(ObjectGroup $asGeodataOfObjectGroup): void
    {
        $this->asGeodataOfObjectGroup?->detach($asGeodataOfObjectGroup);
    }

    /**
     * Remove all as geodata of object groups
     */
    public function removeAllAsGeodataOfObjectGroup(): void
    {
        $asGeodataOfObjectGroup = clone $this->asGeodataOfObjectGroup;
        $this->asGeodataOfObjectGroup->removeAll($asGeodataOfObjectGroup);
    }

    /**
     * Get as feature of variant relation
     *
     * @return ObjectStorage<VariantRelation>
     */
    public function getAsFeatureOfVariantRelation(): ?ObjectStorage
    {
        return $this->asFeatureOfVariantRelation;
    }

    /**
     * Set as feature of variant relation
     *
     * @param ObjectStorage<VariantRelation> $asFeatureOfVariantRelation
     */
    public function setAsFeatureOfVariantRelation(ObjectStorage $asFeatureOfVariantRelation): void
    {
        $this->asFeatureOfVariantRelation = $asFeatureOfVariantRelation;
    }

    /**
     * Add as feature of variant relation
     *
     * @param VariantRelation $asFeatureOfVariantRelation
     */
    public function addAsFeatureOfVariantRelation(VariantRelation $asFeatureOfVariantRelation): void
    {
        $this->asFeatureOfVariantRelation?->attach($asFeatureOfVariantRelation);
    }

    /**
     * Remove as feature of variant relation
     *
     * @param VariantRelation $asFeatureOfVariantRelation
     */
    public function removeAsFeatureOfVariantRelation(VariantRelation $asFeatureOfVariantRelation): void
    {
        $this->asFeatureOfVariantRelation?->detach($asFeatureOfVariantRelation);
    }

    /**
     * Remove all as feature of variant relations
     */
    public function removeAllAsFeatureOfVariantRelation(): void
    {
        $asFeatureOfVariantRelation = clone $this->asFeatureOfVariantRelation;
        $this->asFeatureOfVariantRelation->removeAll($asFeatureOfVariantRelation);
    }
}
