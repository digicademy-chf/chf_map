<?php

declare(strict_types=1);

# This file is part of the extension DA Map for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\DAMap\Controller;

use Psr\Http\Message\ResponseInterface;
use Digicademy\DAMap\Domain\Model\AbstractGeometry;
use Digicademy\DAMap\Domain\Repository\AbstractGeometryRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * Controller for geometries
 */
class AbstractGeometryController extends ActionController
{
    private AbstractGeometryRepository $abstractGeometryRepository;

    public function injectAbstractGeometryRepository(AbstractGeometryRepository $abstractGeometryRepository): void
    {
        $this->abstractGeometryRepository = $abstractGeometryRepository;
    }

    public function indexAction(): ResponseInterface
    {
        $this->view->assign('geometries', $this->abstractGeometryRepository->findAll());
        return $this->htmlResponse();
    }

    public function showAction(AbstractGeometry $abstractGeometry): ResponseInterface
    {
        $this->view->assign('geometry', $abstractGeometry);
        return $this->htmlResponse();
    }
}

?>
