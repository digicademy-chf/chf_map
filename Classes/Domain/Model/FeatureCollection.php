<?php
declare(strict_types=1);

# This file is part of the extension CHF Map for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFMap\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\ORM\Cascade;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

defined('TYPO3') or die();

/**
 * Model for FeatureCollection
 */
class FeatureCollection extends AbstractFeature
{
    /**
     * List of features
     * 
     * @var ?ObjectStorage<Feature>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ?ObjectStorage $feature = null;

    /**
     * Construct object
     *
     * @param MapResource $parentResource
     * @param string $uuid
     * @return FeatureCollection
     */
    public function __construct(MapResource $parentResource, string $uuid)
    {
        parent::__construct($parentResource, $uuid);
        $this->initializeObject();

        $this->setType('featureCollection');
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->feature ??= new ObjectStorage();
    }

    /**
     * Get feature
     *
     * @return ObjectStorage<Feature>
     */
    public function getFeature(): ?ObjectStorage
    {
        return $this->feature;
    }

    /**
     * Set feature
     *
     * @param ObjectStorage<Feature> $feature
     */
    public function setFeature(ObjectStorage $feature): void
    {
        $this->feature = $feature;
    }

    /**
     * Add feature
     *
     * @param Feature $feature
     */
    public function addFeature(Feature $feature): void
    {
        $this->feature?->attach($feature);
    }

    /**
     * Remove feature
     *
     * @param Feature $feature
     */
    public function removeFeature(Feature $feature): void
    {
        $this->feature?->detach($feature);
    }

    /**
     * Remove all features
     */
    public function removeAllFeature(): void
    {
        $feature = clone $this->feature;
        $this->feature->removeAll($feature);
    }
}
