<?php
defined('TYPO3') or die();
declare(strict_types=1);

# This file is part of the extension CHF Map for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFMap\Controller;

use Psr\Http\Message\ResponseInterface;
use Digicademy\CHFMap\Domain\Model\CoordinateGroup;
use Digicademy\CHFMap\Domain\Repository\CoordinateGroupRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * Controller for CoordinateGroup
 */
class CoordinateGroupController extends ActionController
{
    private CoordinateGroupRepository $coordinateGroupRepository;

    public function injectCoordinateGroupRepository(CoordinateGroupRepository $coordinateGroupRepository): void
    {
        $this->coordinateGroupRepository = $coordinateGroupRepository;
    }

    public function indexAction(): ResponseInterface
    {
        $this->view->assign('coordinateGroups', $this->coordinateGroupRepository->findAll());
        return $this->htmlResponse();
    }

    public function showAction(CoordinateGroup $coordinateGroup): ResponseInterface
    {
        $this->view->assign('coordinateGroup', $coordinateGroup);
        return $this->htmlResponse();
    }
}
