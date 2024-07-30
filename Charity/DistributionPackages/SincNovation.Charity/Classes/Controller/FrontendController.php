<?php
namespace SincNovation\Charity\Controller;

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Mvc\Controller\ActionController;

/**
 * @Flow\Scope("singleton")
 */
class FrontendController extends ActionController
{

    public function customAction()
    {
        // Render the home template
        $this->view->assign('variable', 'value');
    }

}