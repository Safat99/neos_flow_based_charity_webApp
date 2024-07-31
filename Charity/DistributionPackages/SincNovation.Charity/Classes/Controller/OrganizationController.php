<?php
namespace SincNovation\Charity\Controller;

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Mvc\Controller\ActionController;
use \Neos\Flow\Mvc\View\JsonView;
use Neos\Flow\Mvc\Exception\NoSuchControllerException;

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
    public function listFromSettingsAction() {
        $organizations = $this->organizationService->getOrganizationsFromSettings();
        $this->view->assign('value', ['organizations'=> $organizations]);
    }

    /**
     * Fetches all organizations from the database
     *
     * @return void
     */
    public function listAction() {
        $organizations = $this->organizationService->getAllOrganizations();
        $this->view->assign('value', ['organizations'=> $organizations]);
    }

    // details of a organization: viewOrganizationByName or viewOrganizationById
    public function viewAction(string $identifier) {
        try {
            if (ctype_digit($identifier)) {
                $organization = $this->organizationService->getOrganizationById((int)$identifier);
            } else {
                $organization = $this->organizationService->getOrganizationByName($identifier);
            }
    
            if ($organization === null) {
                $errorMessage = ctype_digit($identifier) 
                    ? "No organization found with ID: {$identifier}" 
                    : "No organization found with name: {$identifier}";
                throw new NoSuchControllerException($errorMessage, 404);
            }
    
            $this->view->assign('value', $organization);
    
        } catch (\Exception $e) {
            $this->view->assign('value', ['error' => $e->getMessage()]);
        }
    }
}
