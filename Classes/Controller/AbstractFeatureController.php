<?php
declare(strict_types=1);

# This file is part of the extension CHF Map for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFMap\Controller;

use Psr\Http\Message\ResponseInterface;
use Digicademy\CHFMap\Domain\Model\AbstractFeature;
use Digicademy\CHFMap\Domain\Repository\AbstractFeatureRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

defined('TYPO3') or die();

/**
 * Controller for AbstractFeature
 */
class AbstractFeatureController extends ActionController
{
    private AbstractFeatureRepository $abstractFeatureRepository;

    public function injectAbstractFeatureRepository(AbstractFeatureRepository $abstractFeatureRepository): void
    {
        $this->abstractFeatureRepository = $abstractFeatureRepository;
    }

    public function indexAction(): ResponseInterface
    {
        $this->view->assign('features', $this->abstractFeatureRepository->findAll());
        return $this->htmlResponse();
    }

    public function showAction(AbstractFeature $abstractFeature): ResponseInterface
    {
        $this->view->assign('feature', $abstractFeature);
        return $this->htmlResponse();
    }
}
