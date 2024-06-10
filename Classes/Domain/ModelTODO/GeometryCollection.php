<?php
declare(strict_types=1);

# This file is part of the extension CHF Map for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFMap\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Cascade;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

defined('TYPO3') or die();

/**
 * Model for geometry collections
 */
class GeometryCollection extends AbstractGeometry
{
    /**
     * List of geometries in this geometry
     * 
     * @var ObjectStorage<SingleGeometry|MultiGeometry>
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
     * @return ObjectStorage<SingleGeometry|MultiGeometry>
     */
    public function getGeometry(): ObjectStorage
    {
        return $this->geometry;
    }

    /**
     * Set geometry
     *
     * @param ObjectStorage<SingleGeometry|MultiGeometry> $geometry
     */
    public function setGeometry(ObjectStorage $geometry): void
    {
        $this->geometry = $geometry;
    }

    /**
     * Add geometry
     *
     * @param SingleGeometry|MultiGeometry $geometry
     */
    public function addGeometry(SingleGeometry|MultiGeometry $geometry): void
    {
        $this->geometry->attach($geometry);
    }

    /**
     * Remove geometry
     *
     * @param SingleGeometry|MultiGeometry $geometry
     */
    public function removeGeometry(SingleGeometry|MultiGeometry $geometry): void
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
