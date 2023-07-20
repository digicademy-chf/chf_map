<?php

declare(strict_types=1);

# This file is part of the extension DA Map for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\DAMap\Controller;

use Psr\Http\Message\ResponseInterface;
use Digicademy\DAMap\Domain\Model\Geometry;
use Digicademy\DAMap\Domain\Repository\GeometryRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * Controller for geometries
 */
class GeometryController extends ActionController
{
    private GeometryRepository $geometryRepository;

    public function injectGeometryRepository(GeometryRepository $geometryRepository): void
    {
        $this->geometryRepository = $geometryRepository;
    }

    public function indexAction(): ResponseInterface
    {
        $this->view->assign('geometries', $this->geometryRepository->findAll());
        return $this->htmlResponse();
    }

    public function showAction(Geometry $geometry): ResponseInterface
    {
        $this->view->assign('geometry', $geometry);
        return $this->htmlResponse();
    }
}

?>
