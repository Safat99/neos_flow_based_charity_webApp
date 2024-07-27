<?php
namespace SincNovation\Charity\Command;

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Cli\CommandController;
use SincNovation\Charity\Domain\Service\OrganizationService;

/**
 * @Flow\Scope("singleton")
 */
class OrganizationCommandController extends CommandController
{
    /**
     * @Flow\Inject
     * @var OrganizationService
     */
    protected $organizationService;

    /**
     * Stores organizations from Settings.yaml into the database
     */
    public function importFromSettingsCommand()
    {
        $this->organizationService->storeOrganizationsFromSettings();
        $this->outputLine('Organizations imported from Settings.yaml into the database.');
    }
}