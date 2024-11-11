<?php
declare(strict_types=1);

# This file is part of the extension CHF Map for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFMap\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

defined('TYPO3') or die();

/**
 * Model for Coordinates
 */
class Coordinates extends AbstractEntity
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
     * Decimal notation of the longitude with a decimal period (if necessary)
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'Float',
    ])]
    protected string $longitude = '';

    /**
     * Decimal notation of the latitude with a decimal period (if necessary)
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'Float',
    ])]
    protected string $latitude = '';

    /**
     * Decimal notation of the height in meters with a decimal period (if necessary)
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'Float',
    ])]
    protected string $altitude = '';

    /**
     * Construct object
     *
     * @param string $longitude
     * @param string $latitude
     * @return Coordinates
     */
    public function __construct(string $longitude, string $latitude)
    {
        $this->setLongitude($longitude);
        $this->setLongitude($latitude);
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
     * Get longitude
     *
     * @return string
     */
    public function getLongitude(): string
    {
        return $this->longitude;
    }

    /**
     * Set longitude
     *
     * @param string $longitude
     */
    public function setLongitude(string $longitude): void
    {
        $this->longitude = $longitude;
    }

    /**
     * Get latitude
     *
     * @return string
     */
    public function getLatitude(): string
    {
        return $this->latitude;
    }

    /**
     * Set latitude
     *
     * @param string $latitude
     */
    public function setLatitude(string $latitude): void
    {
        $this->latitude = $latitude;
    }

    /**
     * Get altitude
     *
     * @return string
     */
    public function getAltitude(): string
    {
        return $this->altitude;
    }

    /**
     * Set altitude
     *
     * @param string $altitude
     */
    public function setAltitude(string $altitude): void
    {
        $this->altitude = $altitude;
    }
}
