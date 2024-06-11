<?php
declare(strict_types=1);

# This file is part of the extension CHF Map for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFMap\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use Digicademy\CHFBase\Domain\Model\AbstractRelation;

defined('TYPO3') or die();

/**
 * Model for VariantRelation
 */
class VariantRelation extends AbstractRelation
{
    /**
     * List of features that are variants of each other
     * 
     * @var ?ObjectStorage<Feature|FeatureCollection>
     */
    #[Lazy()]
    protected ?ObjectStorage $feature;

    /**
     * Construct object
     *
     * @param object $parentResource
     * @param string $uuid
     * @param Feature|FeatureCollection $feature
     * @return VariantRelation
     */
    public function __construct(object $parentResource, string $uuid, Feature|FeatureCollection $feature)
    {
        parent::__construct($parentResource, $uuid);
        $this->initializeObject();

        $this->setType('variantRelation');
        $this->addFeature($feature);
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
     * @return ObjectStorage<Feature|FeatureCollection>
     */
    public function getFeature(): ?ObjectStorage
    {
        return $this->feature;
    }

    /**
     * Set feature
     *
     * @param ObjectStorage<Feature|FeatureCollection> $feature
     */
    public function setFeature(ObjectStorage $feature): void
    {
        $this->feature = $feature;
    }

    /**
     * Add feature
     *
     * @param Feature|FeatureCollection $feature
     */
    public function addFeature(Feature|FeatureCollection $feature): void
    {
        $this->feature?->attach($feature);
    }

    /**
     * Remove feature
     *
     * @param Feature|FeatureCollection $feature
     */
    public function removeFeature(Feature|FeatureCollection $feature): void
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
