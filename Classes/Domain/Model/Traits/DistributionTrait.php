<?php
declare(strict_types=1);

# This file is part of the extension CHF Map for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFMap\Domain\Model\Traits;

use Digicademy\CHFMap\Domain\Model\Distribution;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\ORM\Cascade;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

defined('TYPO3') or die();

/**
 * Trait for models to include a distribution property
 */
trait DistributionTrait
{
    /**
     * Geographic distribution of this frequency
     * 
     * @var ObjectStorage<Distribution>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $distribution;

    /**
     * Get distribution
     *
     * @return ObjectStorage<Distribution>
     */
    public function getDistribution(): ObjectStorage
    {
        return $this->distribution;
    }

    /**
     * Set distribution
     *
     * @param ObjectStorage<Distribution> $distribution
     */
    public function setDistribution(ObjectStorage $distribution): void
    {
        $this->distribution = $distribution;
    }

    /**
     * Add distribution
     *
     * @param Distribution $distribution
     */
    public function addDistribution(Distribution $distribution): void
    {
        $this->distribution->attach($distribution);
    }

    /**
     * Remove distribution
     *
     * @param Distribution $distribution
     */
    public function removeDistribution(Distribution $distribution): void
    {
        $this->distribution->detach($distribution);
    }

    /**
     * Remove all distributions
     */
    public function removeAllDistribution(): void
    {
        $distribution = clone $this->distribution;
        $this->distribution->removeAll($distribution);
    }
}
