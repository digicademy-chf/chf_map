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
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Model for features
 */
class Feature extends AbstractFeature
{
    /**
     * Number used as the size of the feature, if possible
     * 
     * @var int|null
     */
    #[Validate([
        'validator' => 'Number',
    ])]
    protected ?int $weight = null;

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
                'pixels',
            ],
        ],
    ])]
    protected string $projection = '';

    /**
     * List of geometries in this feature
     * 
     * @var ObjectStorage<Geometry>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $geometry;

    /**
     * Construct object
     *
     * @param MapResource $parent_id
     * @param string $uuid
     * @param string $projection
     * @return Feature
     */
    public function __construct(MapResource $parent_id, string $uuid, string $projection)
    {
        $this->initializeObject();

        $this->setParentId($parent_id);
        $this->setUuid($uuid);
        $this->setType('Feature');
        $this->setProjection($projection);
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        parent::initializeObject();

        $this->geometry = new ObjectStorage();
    }

    /**
     * Get weight
     *
     * @return int
     */
    public function getWeight(): int
    {
        return $this->weight;
    }

    /**
     * Set weight
     *
     * @param int $weight
     */
    public function setWeight(int $weight): void
    {
        $this->weight = $weight;
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
}

?>