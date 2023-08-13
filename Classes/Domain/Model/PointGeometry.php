<?php

declare(strict_types=1);

# This file is part of the extension DA Map for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\DAMap\Domain\Model;

/**
 * Model for point geometries
 */
class PointGeometry extends AbstractSingleGeometry
{
    /**
     * Construct object
     *
     * @return PointGeometry
     */
    public function __construct()
    {
        $this->initializeObject();

        $this->setType('Point');
    }
}

?>