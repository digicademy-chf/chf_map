<?php
declare(strict_types=1);

# This file is part of the extension CHF Map for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFMap\Controller;

use Psr\Http\Message\ResponseInterface;
use Digicademy\CHFMap\Domain\Model\Coordinates;
use Digicademy\CHFMap\Domain\Repository\CoordinatesRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

defined('TYPO3') or die();

/**
 * Controller for Coordinates
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
