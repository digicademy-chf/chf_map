<?php
declare(strict_types=1);

# This file is part of the extension CHF Map for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFMap\Domain\Model;

use Digicademy\CHFBase\Domain\Model\Traits\HiddenTrait;
use Digicademy\CHFBase\Domain\Model\Traits\ParentResourceTrait;
use Digicademy\CHFBase\Domain\Validator\StringOptionsValidator;
use Digicademy\CHFLex\Domain\Model\Traits\ParentFrequencyTrait;
use Digicademy\CHFMap\Domain\Model\Traits\GeodataTrait;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Attribute\ORM\Cascade;
use TYPO3\CMS\Extbase\Attribute\ORM\Lazy;
use TYPO3\CMS\Extbase\Attribute\Validate;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

defined('TYPO3') or die();

/**
 * Model for AbstractDistribution
 */
class AbstractDistribution extends AbstractEntity
{
    use HiddenTrait;
    use ParentResourceTrait;

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
    protected ?string $postalCodeSystem = null;

    /**
     * Point representation of the area
     * 
     * @var ObjectStorage<Coordinates>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $coordinates;

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
        $this->coordinates = new ObjectStorage();
        $this->parentResource = new ObjectStorage();
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
}

# If CHF Lex and CHF Map are available
if (ExtensionManagementUtility::isLoaded('chf_lex') && ExtensionManagementUtility::isLoaded('chf_map')) {

    /**
     * Model for Distribution (with geodata and parent-frequency properties)
     */
    class Distribution extends AbstractDistribution
    {
        use GeodataTrait;
        use ParentFrequencyTrait;
    }

# If only CHF Lex is available
} elseif (ExtensionManagementUtility::isLoaded('chf_lex')) {

    /**
     * Model for Distribution (with parent-frequency property)
     */
    class Distribution extends AbstractDistribution
    {
        use ParentFrequencyTrait;
    }

# If only CHF Map is available
} elseif (ExtensionManagementUtility::isLoaded('chf_map')) {

    /**
     * Model for Distribution (with geodata property)
     */
    class Distribution extends AbstractDistribution
    {
        use GeodataTrait;
    }

# If no relevant extensions are available
} else {

    /**
     * Model for Distribution
     */
    class Distribution extends AbstractDistribution
    {}
}
