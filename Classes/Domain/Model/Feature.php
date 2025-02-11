<?php
declare(strict_types=1);

# This file is part of the extension CHF Map for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFMap\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Cascade;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use Digicademy\CHFBase\Domain\Model\AbstractBase;
use Digicademy\CHFBase\Domain\Model\LabelTag;
use Digicademy\CHFBase\Domain\Model\LinkRelation;
use Digicademy\CHFBase\Domain\Model\Location;
use Digicademy\CHFBase\Domain\Validator\StringOptionsValidator;
use Digicademy\CHFBib\Domain\Model\SourceRelation;
use Digicademy\CHFPub\Domain\Model\PublicationRelation;

defined('TYPO3') or die();

/**
 * Model for Feature
 */
class Feature extends AbstractBase
{
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
     * Type of projection used for geometries in this feature
     * 
     * @var string
     */
    #[Validate([
        'validator' => StringOptionsValidator::class,
        'options'   => [
            'allowed' => [
                'worldGeodeticSystem',
            ],
        ],
    ])]
    protected string $projection = 'worldGeodeticSystem';

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
     * JSON data describing the feature
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'NotEmpty',
    ])]
    protected string $geoJson = '{}';

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
     * List of distributions that use this feature as geodata
     * 
     * @var ?ObjectStorage<Distribution>
     */
    #[Lazy()]
    protected ?ObjectStorage $asGeodataOfDistribution = null;

    /**
     * Construct object
     *
     * @param MapResource $parentResource
     * @param string $iri
     * @param string $uuid
     * @return Feature
     */
    public function __construct(MapResource $parentResource, string $iri, string $uuid)
    {
        parent::__construct($iri, $uuid);
        $this->initializeObject();

        $this->addParentResource($parentResource);
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->label ??= new ObjectStorage();
        $this->sourceRelation ??= new ObjectStorage();
        $this->linkRelation ??= new ObjectStorage();
        $this->publicationRelation ??= new ObjectStorage();
        $this->parentResource ??= new ObjectStorage();
        $this->asGeodataOfLocation ??= new ObjectStorage();
        $this->asGeodataOfDistribution ??= new ObjectStorage();
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
     * Get projection
     *
     * @return string
     */
    public function getProjection(): string
    {
        return $this->projection;
    }

    /**
     * Set projection
     *
     * @param string $projection
     */
    public function setProjection(string $projection): void
    {
        $this->projection = $projection;
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
     * Get GeoJSON
     *
     * @return string
     */
    public function getGeoJson(): string
    {
        return $this->geoJson;
    }

    /**
     * Set GeoJSON
     *
     * @param string $geoJson
     */
    public function setGeoJson(string $geoJson): void
    {
        $this->geoJson = $geoJson;
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
     * Get as geodata of distribution
     *
     * @return ObjectStorage<Distribution>
     */
    public function getAsGeodataOfDistribution(): ?ObjectStorage
    {
        return $this->asGeodataOfDistribution;
    }

    /**
     * Set as geodata of distribution
     *
     * @param ObjectStorage<Distribution> $asGeodataOfDistribution
     */
    public function setAsGeodataOfDistribution(ObjectStorage $asGeodataOfDistribution): void
    {
        $this->asGeodataOfDistribution = $asGeodataOfDistribution;
    }

    /**
     * Add as geodata of distribution
     *
     * @param Distribution $asGeodataOfDistribution
     */
    public function addAsGeodataOfDistribution(Distribution $asGeodataOfDistribution): void
    {
        $this->asGeodataOfDistribution?->attach($asGeodataOfDistribution);
    }

    /**
     * Remove as geodata of distribution
     *
     * @param Distribution $asGeodataOfDistribution
     */
    public function removeAsGeodataOfDistribution(Distribution $asGeodataOfDistribution): void
    {
        $this->asGeodataOfDistribution?->detach($asGeodataOfDistribution);
    }

    /**
     * Remove all as geodata of distributions
     */
    public function removeAllAsGeodataOfDistribution(): void
    {
        $asGeodataOfDistribution = clone $this->asGeodataOfDistribution;
        $this->asGeodataOfDistribution->removeAll($asGeodataOfDistribution);
    }
}
