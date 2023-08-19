<?php

declare(strict_types=1);

# This file is part of the extension DA Map for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\DAMap\Domain\Model;

use Digicademy\DAMap\Domain\Validator\StringOptionsValidator;
use TYPO3\CMS\Extbase\Annotation\ORM\Cascade;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Abstract model for geometries
 */
class AbstractGeometry extends AbstractEntity
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
     * Type of geometry
     * 
     * @var string
     */
    #[Validate([
        'validator' => StringOptionsValidator::class,
        'options'   => [
            'allowed' => [
                'Point',
                'MultiPoint',
                'LineString',
                'MultiLineString',
                'Polygon',
                'MultiPolygon',
                'GeometryCollection',
            ],
        ],
    ])]
    protected string $type = '';

    /**
     * Two coordinates to produce a bounding box
     * 
     * @var ObjectStorage<Geometry>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $boundingBox;

    /**
     * Construct object
     *
     * @return AbstractGeometry
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