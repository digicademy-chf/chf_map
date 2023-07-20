<?php

declare(strict_types=1);

# This file is part of the extension DA Map for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\DAMap\Controller;

use Psr\Http\Message\ResponseInterface;
use Digicademy\DAMap\Domain\Model\Coordinates;
use Digicademy\DAMap\Domain\Repository\CoordinatesRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * Controller for coordinates
 */
class CoordinatesController extends ActionController
{
    private CoordinatesRepository $coordinatesRepository;

    public function injectCoordinatesRepository(CoordinatesRepository $coordinatesRepository): void
    {
        $this->coordinatesRepository = $coordinatesRepository;
    }

    public function indexAction(): ResponseInterface
    {
        $this->view->assign('coordinatess', $this->coordinatesRepository->findAll());
        return $this->htmlResponse();
    }

    public function showAction(Coordinates $coordinates): ResponseInterface
    {
        $this->view->assign('coordinates', $coordinates);
        return $this->htmlResponse();
    }
}

?>
