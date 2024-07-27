<?php
namespace SincNovation\Charity\Controller;

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Mvc\Controller\ActionController;
use \Neos\Flow\Mvc\View\JsonView;

use SincNovation\Charity\Domain\Service\OrganizationService;

/**
 * @Flow\Scope("singleton")
 */
class OrganizationController extends ActionController
{

    protected $defaultViewObjectName = JsonView::class;
    
    /**
     * @var OrganizationService
     * @Flow\Inject
     */
    protected $organizationService;


    /**
     * Fetches all organizations from the settings.yaml
     *
     * @return void
     */
    public function listFromSettingsAction()
    {
        $organizations = $this->organizationService->getOrganizationsFromSettings();
        $this->view->assign('value', ['organizations'=> $organizations]);
    }

    /**
     * Fetches all organizations from the database
     *
     * @return void
     */
    public function listAction()
    {
        $organizations = $this->organizationService->getAllOrganizations();
        $this->view->assign('value', ['organizations'=> $organizations]);
    }

    public function indexAction() {
        $this->view->assign('value', ['message' => 'Hello organizations']);
    }
}
