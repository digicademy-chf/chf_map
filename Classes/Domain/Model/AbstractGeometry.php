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
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use Digicademy\CHFBase\Domain\Validator\StringOptionsValidator;

defined('TYPO3') or die();

/**
 * Model for AbstractGeometry
 */
class AbstractGeometry extends AbstractEntity
{
    /**
     * Record visible or not
     * 
     * @var bool
     */
    #[Validate([
        'validator' => 'Boolean',
    ])]
    protected bool $hidden = true;

    /**
     * Type of geometry
     * 
     * @var string
     */
    #[Validate([
        'validator' => StringOptionsValidator::class,
        'options'   => [
            'allowed' => [
                'point',
                'multiPoint',
                'lineString',
                'multiLineString',
                'polygon',
                'multiPolygon',
                'geometryCollection',
            ],
        ],
    ])]
    protected string $type = 'point';

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
     * Construct object
     *
     * @param string $type
     * @return AbstractGeometry
     */
    public function __construct(string $type)
    {
        $this->initializeObject();
    
        $this->setType($type);
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->boundingBox ??= new ObjectStorage();
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
}
