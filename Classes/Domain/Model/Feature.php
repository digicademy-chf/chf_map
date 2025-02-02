<?php
declare(strict_types=1);

# This file is part of the extension CHF Map for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFMap\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\Validate;
use Digicademy\CHFBase\Domain\Validator\StringOptionsValidator;

defined('TYPO3') or die();

/**
 * Model for Feature
 */
class Feature extends AbstractFeature
{
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
     * Construct object
     *
     * @param MapResource $parentResource
     * @param string $uuid
     * @return Feature
     */
    public function __construct(MapResource $parentResource, string $uuid)
    {
        parent::__construct($parentResource, $uuid);

        $this->setType('feature');
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
}
