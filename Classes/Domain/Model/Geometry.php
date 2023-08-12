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
 * Model for geometries
 */
class Geometry extends AbstractEntity
{
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
     * List of coordinates in this geometry
     * 
     * @var ObjectStorage<Coordinates>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $coordinates;

    /**
     * List of coordinate groups in this geometry
     * 
     * @var ObjectStorage<CoordinateGroup>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $coordinateGroup;

    /**
     * List of geometries in this geometry
     * 
     * @var ObjectStorage<Geometry>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $geometry;

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
     * Initialize object
     *
     * @param string $type
     * @return Geometry
     */
    public function __construct(string $type)
    {
        $this->coordinates     = new ObjectStorage();
        $this->coordinateGroup = new ObjectStorage();
        $this->geometry        = new ObjectStorage();
        $this->boundingBox     = new ObjectStorage();

        $this->setType($type);
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
     * Get coordinates
     *
     * @return ObjectStorage<Coordinates>
     */
    public function getCoordinates(): ObjectStorage
    {
        return $this->coordinates;
    }

    /**
     * Set coordinates
     *
     * @param ObjectStorage<Coordinates> $coordinates
     */
    public function setCoordinates(ObjectStorage $coordinates): void
    {
        $this->coordinates = $coordinates;
    }

    /**
     * Add coordinates
     *
     * @param Coordinates $coordinates
     */
    public function addCoordinates(Coordinates $coordinates): void
    {
        $this->coordinates->attach($coordinates);
    }

    /**
     * Remove coordinates
     *
     * @param Coordinates $coordinates
     */
    public function removeCoordinates(Coordinates $coordinates): void
    {
        $this->coordinates->detach($coordinates);
    }

    /**
     * Remove all coordinates
     */
    public function removeAllCoordinates(): void
    {
        $coordinates = clone $this->coordinates;
        $this->coordinates->removeAll($coordinates);
    }

    /**
     * Get coordinate group
     *
     * @return ObjectStorage<CoordinateGroup>
     */
    public function getCoordinateGroup(): ObjectStorage
    {
        return $this->coordinateGroup;
    }

    /**
     * Set coordinate group
     *
     * @param ObjectStorage<CoordinateGroup> $coordinateGroup
     */
    public function setCoordinateGroup(ObjectStorage $coordinateGroup): void
    {
        $this->coordinateGroup = $coordinateGroup;
    }

    /**
     * Add coordinate group
     *
     * @param CoordinateGroup $coordinateGroup
     */
    public function addCoordinateGroup(CoordinateGroup $coordinateGroup): void
    {
        $this->coordinateGroup->attach($coordinateGroup);
    }

    /**
     * Remove coordinate group
     *
     * @param CoordinateGroup $coordinateGroup
     */
    public function removeCoordinateGroup(CoordinateGroup $coordinateGroup): void
    {
        $this->coordinateGroup->detach($coordinateGroup);
    }

    /**
     * Remove all coordinate groups
     */
    public function removeAllCoordinateGroups(): void
    {
        $coordinateGroup = clone $this->coordinateGroup;
        $this->coordinateGroup->removeAll($coordinateGroup);
    }

    /**
     * Get geometry
     *
     * @return ObjectStorage<Geometry>
     */
    public function getGeometry(): ObjectStorage
    {
        return $this->geometry;
    }

    /**
     * Set geometry
     *
     * @param ObjectStorage<Geometry> $geometry
     */
    public function setGeometry(ObjectStorage $geometry): void
    {
        $this->geometry = $geometry;
    }

    /**
     * Add geometry
     *
     * @param Geometry $geometry
     */
    public function addGeometry(Geometry $geometry): void
    {
        $this->geometry->attach($geometry);
    }

    /**
     * Remove geometry
     *
     * @param Geometry $geometry
     */
    public function removeGeometry(Geometry $geometry): void
    {
        $this->geometry->detach($geometry);
    }

    /**
     * Remove all geometries
     */
    public function removeAllGeometries(): void
    {
        $geometry = clone $this->geometry;
        $this->geometry->removeAll($geometry);
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