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
 * Model for MultiGeometry
 */
class MultiGeometry extends AbstractGeometry
{
    /**
     * Construct object
     *
     * @param string $type
     * @return MultiGeometry
     */
    public function __construct(string $type)
    {
        parent::__construct($type);
    }
}
