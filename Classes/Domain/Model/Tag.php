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
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Model for tags
 */
class Tag extends AbstractEntity
{
    /**
     * Resource that this tag is attached to
     * 
     * @var MapResource
     */
    protected MapResource $parent_id;

    /**
     * Unique identifier of the tag
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
     * Name of the tag
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options'   => [
            'minimum' => 1,
            'maximum' => 255,
        ],
    ])]
    protected string $text = '';

    /**
     * Type of tag
     * 
     * @var string
     */
    #[Validate([
        'validator' => StringOptionsValidator::class,
        'options'   => [
            'allowed' => [
                'label',
            ],
        ],
    ])]
    protected string $type = '';

    /**
     * Brief information about the tag
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
     * External web address to identify the tag across the web
     * 
     * @var ObjectStorage<SameAs>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $sameAs;

    /**
     * List of features with this label
     * 
     * @var ObjectStorage<Feature>
     */
    #[Lazy()]
    protected ObjectStorage $asLabelOfFeature;

    /**
     * Initialize object
     *
     * @param MapResource $parent_id
     * @param string $uuid
     * @param string $text
     * @param string $type
     * @return Tag
     */
    public function __construct(MapResource $parent_id, string $uuid, string $text, string $type)
    {
        $this->sameAs           = new ObjectStorage();
        $this->asLabelOfFeature = new ObjectStorage();

        $this->setParentId($parent_id);
        $this->setUuid($uuid);
        $this->setText($text);
        $this->setType($type);
    }

    /**
     * Get parent ID
     * 
     * @return MapResource
     */
    public function getParentId(): MapResource
    {
        return $this->parent_id;
    }

    /**
     * Set parent ID
     * 
     * @param MapResource $parent_id
     */
    public function setParentId(MapResource $parent_id): void
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
     * Get text
     *
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * Set text
     *
     * @param string $text
     */
    public function setText(string $text): void
    {
        $this->text = $text;
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
     * Get as label of feature
     *
     * @return ObjectStorage<Feature>
     */
    public function getAsLabelOfFeature(): ObjectStorage
    {
        return $this->asLabelOfFeature;
    }

    /**
     * Set as label of feature
     *
     * @param ObjectStorage<Feature> $asLabelOfFeature
     */
    public function setAsLabelOfFeature(ObjectStorage $asLabelOfFeature): void
    {
        $this->asLabelOfFeature = $asLabelOfFeature;
    }

    /**
     * Add as label of feature
     *
     * @param Feature $asLabelOfFeature
     */
    public function addAsLabelOfFeature(Feature $asLabelOfFeature): void
    {
        $this->asLabelOfFeature->attach($asLabelOfFeature);
    }

    /**
     * Remove as label of feature
     *
     * @param Feature $asLabelOfFeature
     */
    public function removeAsLabelOfFeature(Feature $asLabelOfFeature): void
    {
        $this->asLabelOfFeature->detach($asLabelOfFeature);
    }

    /**
     * Remove all as label of features
     */
    public function removeAllAsLabelOfFeatures(): void
    {
        $asLabelOfFeature = clone $this->asLabelOfFeature;
        $this->asLabelOfFeature->removeAll($asLabelOfFeature);
    }
}

?>