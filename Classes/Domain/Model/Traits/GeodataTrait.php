<?php
declare(strict_types=1);

# This file is part of the extension CHF Map for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFMap\Domain\Model\Traits;

use Digicademy\CHFMap\Domain\Model\Feature;
use TYPO3\CMS\Extbase\Attribute\ORM\Lazy;
use TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy;

defined('TYPO3') or die();

/**
 * Trait for models to include a geodata property
 */
trait GeodataTrait
{
    /**
     * Feature to represent this location or distribution
     * 
     * @var Feature|LazyLoadingProxy|null
     */
    #[Lazy()]
    protected Feature|LazyLoadingProxy|null $geodata = null;

    /**
     * Get geodata
     * 
     * @return Feature
     */
    public function getGeodata(): Feature
    {
        if ($this->geodata instanceof LazyLoadingProxy) {
            $this->geodata->_loadRealInstance();
        }
        return $this->geodata;
    }

    /**
     * Set geodata
     * 
     * @param Feature
     */
    public function setGeodata(Feature $geodata): void
    {
        $this->geodata = $geodata;
    }
}
