<?php
declare(strict_types=1);

# This file is part of the extension CHF Map for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFMap\Domain\Model;

defined('TYPO3') or die();

/**
 * Model for FeatureCollection
 */
class FeatureCollection extends AbstractFeature
{
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

        $this->setType('featureCollection');
    }
}
