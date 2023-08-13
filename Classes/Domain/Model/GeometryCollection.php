<?php

declare(strict_types=1);

# This file is part of the extension DA Map for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\DAMap\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Cascade;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Model for geometry collections
 */
class GeometryCollection extends AbstractGeometry
{
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
     * Construct object
     *
     * @return GeometryCollection
     */
    public function __construct()
    {
        $this->initializeObject();

        $this->setType('GeometryCollection');
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