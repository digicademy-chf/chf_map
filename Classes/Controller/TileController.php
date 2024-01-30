<?php
defined('TYPO3') or die();
declare(strict_types=1);

# This file is part of the extension CHF Map for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFMap\Controller;

use Psr\Http\Message\ResponseInterface;
use Digicademy\CHFMap\Domain\Model\Tile;
use Digicademy\CHFMap\Domain\Repository\TileRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * Controller for Tile
 */
class TileController extends ActionController
{
    private TileRepository $tileRepository;

    public function injectTileRepository(TileRepository $tileRepository): void
    {
        $this->tileRepository = $tileRepository;
    }

    public function indexAction(): ResponseInterface
    {
        $this->view->assign('tiles', $this->tileRepository->findAll());
        return $this->htmlResponse();
    }

    public function showAction(Tile $tile): ResponseInterface
    {
        $this->view->assign('tile', $tile);
        return $this->htmlResponse();
    }
}
