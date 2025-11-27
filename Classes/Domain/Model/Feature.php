<?php
declare(strict_types=1);

# This file is part of the extension CHF Map for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFMap\Domain\Model;

use Digicademy\CHFBase\Domain\Model\AbstractBase;
use Digicademy\CHFBase\Domain\Model\Traits\ImportTrait;
use Digicademy\CHFBase\Domain\Model\Traits\IsHighlightTrait;
use Digicademy\CHFBase\Domain\Model\Traits\IsTeaserTrait;
use Digicademy\CHFBase\Domain\Model\Traits\LabelTrait;
use Digicademy\CHFBase\Domain\Model\Traits\LinkRelationTrait;
use Digicademy\CHFBase\Domain\Model\Traits\ParentResourceTrait;
use Digicademy\CHFBase\Domain\Validator\StringOptionsValidator;
use Digicademy\CHFBib\Domain\Model\Traits\SourceRelationTrait;
use Digicademy\CHFPub\Domain\Model\Traits\PublicationRelationTrait;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Attribute\Validate;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

defined('TYPO3') or die();

/**
 * Model for AbstractFeature
 */
class AbstractFeature extends AbstractBase
{
    use ImportTrait;
    use IsHighlightTrait;
    use IsTeaserTrait;
    use LabelTrait;
    use LinkRelationTrait;
    use ParentResourceTrait;

    /**
     * Name of the feature
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options' => [
            'maximum' => 255,
        ],
    ])]
    protected string $title = '';

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
            ],
        ],
    ])]
    protected string $projection = 'worldGeodeticSystem';

    /**
     * Brief information about the feature
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options' => [
            'maximum' => 2000,
        ],
    ])]
    protected string $description = '';

    /**
     * JSON data describing the feature
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'NotEmpty',
    ])]
    protected string $geoJson = '{}';

    /**
     * Construct object
     *
     * @return Feature
     */
    public function __construct()
    {
        parent::__construct();
        $this->initializeObject();

        $this->setIri('fe');
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->label = new ObjectStorage();
        $this->linkRelation = new ObjectStorage();
        $this->parentResource = new ObjectStorage();
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getCode(): string
    {
        return $this->title;
    }

    /**
     * Set title
     *
     * @param string $title
     */
    public function setCode(string $title): void
    {
        $this->title = $title;
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
     * Get description
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Set description
     *
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * Get GeoJSON
     *
     * @return string
     */
    public function getGeoJson(): string
    {
        return $this->geoJson;
    }

    /**
     * Set GeoJSON
     *
     * @param string $geoJson
     */
    public function setGeoJson(string $geoJson): void
    {
        $this->geoJson = $geoJson;
    }
}

# If CHF Bib and CHF Pub are available
if (ExtensionManagementUtility::isLoaded('chf_bib') && ExtensionManagementUtility::isLoaded('chf_pub')) {

    /**
     * Model for Feature (with source-relation and publication-relation properties)
     */
    class Feature extends AbstractFeature
    {
        use PublicationRelationTrait;
        use SourceRelationTrait;

        /**
         * Initialize object
         */
        public function initializeObject(): void
        {
            $this->label = new ObjectStorage();
            $this->sourceRelation = new ObjectStorage();
            $this->linkRelation = new ObjectStorage();
            $this->publicationRelation = new ObjectStorage();
        }
    }

# If only CHF Bib is available
} elseif (ExtensionManagementUtility::isLoaded('chf_bib')) {

    /**
     * Model for Feature (with source-relation property)
     */
    class Feature extends AbstractFeature
    {
        use SourceRelationTrait;

        /**
         * Initialize object
         */
        public function initializeObject(): void
        {
            $this->label = new ObjectStorage();
            $this->sourceRelation = new ObjectStorage();
            $this->linkRelation = new ObjectStorage();
        }
    }

# If only CHF Pub is available
} elseif (ExtensionManagementUtility::isLoaded('chf_pub')) {

    /**
     * Model for Feature (with publication-relation property)
     */
    class Feature extends AbstractFeature
    {
        use PublicationRelationTrait;

        /**
         * Initialize object
         */
        public function initializeObject(): void
        {
            $this->label = new ObjectStorage();
            $this->linkRelation = new ObjectStorage();
            $this->publicationRelation = new ObjectStorage();
        }
    }

# If no relevant extensions are available
} else {

    /**
     * Model for Feature
     */
    class Feature extends AbstractFeature
    {}
}
