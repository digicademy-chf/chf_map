<?php

declare(strict_types=1);

# This file is part of the extension CHF Map for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFMap\Controller;

use Psr\Http\Message\ResponseInterface;
use Digicademy\CHFMap\Domain\Model\Tiles;
use Digicademy\CHFMap\Domain\Repository\TilesRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * Controller for tiles
 */
class TilesController extends ActionController
{
    private TilesRepository $tilesRepository;

    public function injectTilesRepository(TilesRepository $tilesRepository): void
    {
        $this->tilesRepository = $tilesRepository;
    }

    public function indexAction(): ResponseInterface
    {
        $this->view->assign('tiless', $this->tilesRepository->findAll());
        return $this->htmlResponse();
    }

    public function showAction(Tiles $tiles): ResponseInterface
    {
        $this->view->assign('tiles', $tiles);
        return $this->htmlResponse();
    }
}

?>
