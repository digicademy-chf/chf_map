<?php

declare(strict_types=1);

# This file is part of the extension CHF Map for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFMap\Controller;

use Psr\Http\Message\ResponseInterface;
use Digicademy\CHFMap\Domain\Model\MapResource;
use Digicademy\CHFMap\Domain\Repository\MapResourceRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * Controller for map resources
 */
class MapResourceController extends ActionController
{
    private MapResourceRepository $mapResourceRepository;

    public function injectMapResourceRepository(MapResourceRepository $mapResourceRepository): void
    {
        $this->mapResourceRepository = $mapResourceRepository;
    }

    public function indexAction(): ResponseInterface
    {
        $this->view->assign('mapResources', $this->mapResourceRepository->findAll());
        return $this->htmlResponse();
    }

    public function showAction(MapResource $mapResource): ResponseInterface
    {
        $this->view->assign('mapResource', $mapResource);
        return $this->htmlResponse();
    }
}

?>
