<?php

declare(strict_types=1);

# This file is part of the extension DA Map for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\DAMap\Controller;

use Psr\Http\Message\ResponseInterface;
use Digicademy\DAMap\Domain\Model\Feature;
use Digicademy\DAMap\Domain\Repository\FeatureRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * Controller for features
 */
class FeatureController extends ActionController
{
    private FeatureRepository $featureRepository;

    public function injectFeatureRepository(FeatureRepository $featureRepository): void
    {
        $this->featureRepository = $featureRepository;
    }

    public function indexAction(): ResponseInterface
    {
        $this->view->assign('features', $this->featureRepository->findAll());
        return $this->htmlResponse();
    }

    public function showAction(Feature $feature): ResponseInterface
    {
        $this->view->assign('feature', $feature);
        return $this->htmlResponse();
    }
}

?>
