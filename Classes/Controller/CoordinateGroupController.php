<?php

declare(strict_types=1);

# This file is part of the extension DA Map for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\DAMap\Controller;

use Psr\Http\Message\ResponseInterface;
use Digicademy\DAMap\Domain\Model\CoordinateGroup;
use Digicademy\DAMap\Domain\Repository\CoordinateGroupRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * Controller for coordinate groups
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

?>
