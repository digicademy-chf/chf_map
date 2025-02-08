<?php
declare(strict_types=1);

# This file is part of the extension CHF Map for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFMap\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Cascade;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use Digicademy\CHFBase\Domain\Validator\StringOptionsValidator;
use Digicademy\CHFLex\Domain\Model\Frequency;

defined('TYPO3') or die();

/**
 * Model for Distribution
 */
class Distribution extends AbstractEntity
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
     * Number of occurrences
     * 
     * @var int
     */
    #[Validate([
        'validator' => 'NumberRange',
        'options' => [
            'minimum' => 0,
        ],
    ])]
    protected int $tokens = 0;

    /**
     * Number of occurrences in this area
     * 
     * @var ?int
     */
    #[Validate([
        'validator' => 'NumberRange',
        'options' => [
            'minimum' => 0,
        ],
    ])]
    protected ?int $tokensTotal = null;

    /**
     * Type of occurrences
     * 
     * @var string
     */
    #[Validate([
        'validator' => StringOptionsValidator::class,
        'options'   => [
            'allowed' => [
                'unknown',
                'population',
                'families',
                'births',
                'landlines',
            ],
        ],
    ])]
    protected string $tokenType = 'unknown';

    /**
     * Code of the area
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options'   => [
            'maximum' => 255,
        ],
    ])]
    protected string $postalCode = '';

    /**
     * Country the postal code belongs to
     * 
     * @var string
     */
    #[Validate([
        'validator' => StringOptionsValidator::class,
        'options'   => [
            'allowed' => [
                'de',
            ],
        ],
    ])]
    protected string|null $postalCodeSystem = null;

    /**
     * Representation of the area
     * 
     * @var ?ObjectStorage<Feature>
     */
    #[Lazy()]
    protected ?ObjectStorage $feature = null;

    /**
     * Point representation of the area
     * 
     * @var ?ObjectStorage<Coordinates>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ?ObjectStorage $coordinates = null;

    /**
     * Frequency that this distribution is part of
     * 
     * @var Frequency|LazyLoadingProxy|null
     */
    #[Lazy()]
    protected Frequency|LazyLoadingProxy|null $parentFrequency = null;

    /**
     * Construct object
     *
     * @return Distribution
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
        $this->feature ??= new ObjectStorage();
        $this->coordinates ??= new ObjectStorage();
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
     * Get tokens
     *
     * @return int
     */
    public function getTokens(): int
    {
        return $this->tokens;
    }

    /**
     * Set tokens
     *
     * @param int $tokens
     */
    public function setTokens(int $tokens): void
    {
        $this->tokens = $tokens;
    }

    /**
     * Get tokens total
     *
     * @return int
     */
    public function getTokensTotal(): int
    {
        return $this->tokensTotal;
    }

    /**
     * Set tokens total
     *
     * @param int $tokensTotal
     */
    public function setTokensTotal(int $tokensTotal): void
    {
        $this->tokens = $tokensTotal;
    }

    /**
     * Get token type
     *
     * @return string
     */
    public function getTokenType(): string
    {
        return $this->tokenType;
    }

    /**
     * Set token type
     *
     * @param string $tokenType
     */
    public function setTokenType(string $tokenType): void
    {
        $this->tokenType = $tokenType;
    }

    /**
     * Get postal code
     *
     * @return string
     */
    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    /**
     * Set postal code
     *
     * @param string $postalCode
     */
    public function setPostalCode(string $postalCode): void
    {
        $this->postalCode = $postalCode;
    }

    /**
     * Get postal code system
     *
     * @return string
     */
    public function getPostalCodeSystem(): string
    {
        return $this->postalCodeSystem;
    }

    /**
     * Set postal code system
     *
     * @param string $postalCodeSystem
     */
    public function setPostalCodeSystem(string $postalCodeSystem): void
    {
        $this->postalCodeSystem = $postalCodeSystem;
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

    /**
     * Get coordinates
     *
     * @return ObjectStorage<Coordinates>
     */
    public function getCoordinates(): ?ObjectStorage
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
        $this->coordinates?->attach($coordinates);
    }

    /**
     * Remove coordinates
     *
     * @param Coordinates $coordinates
     */
    public function removeCoordinates(Coordinates $coordinates): void
    {
        $this->coordinates?->detach($coordinates);
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
     * Get parent frequency
     * 
     * @return Frequency
     */
    public function getParentFrequency(): Frequency
    {
        if ($this->parentFrequency instanceof LazyLoadingProxy) {
            $this->parentFrequency->_loadRealInstance();
        }
        return $this->parentFrequency;
    }

    /**
     * Set parent frequency
     * 
     * @param Frequency
     */
    public function setParentFrequency(Frequency $parentFrequency): void
    {
        $this->parentFrequency = $parentFrequency;
    }
}
