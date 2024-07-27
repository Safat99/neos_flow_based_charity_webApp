<?php
namespace SincNovation\Charity\Domain\Service;

use Neos\Flow\Configuration\ConfigurationManager;
use Neos\Flow\Annotations as Flow;
use SincNovation\Charity\Domain\Model\Organization;
use SincNovation\Charity\Domain\Repository\OrganizationRepository;

/**
 * @Flow\Scope("singleton")
 */
class OrganizationService
{
    /**
     * @Flow\Inject
     * @var OrganizationRepository
     */
    protected $organizationRepository;

    /**
     * @var ConfigurationManager
     * @Flow\Inject
     */
    protected $configurationManager;

    /**
     * @return array
     */
    public function getOrganizationsFromSettings()
    {
        $settings = $this->configurationManager->getConfiguration(ConfigurationManager::CONFIGURATION_TYPE_SETTINGS, 'SincNovation.Charity');
        return $settings['organizations'] ?? [];
    }

    /**
     * Stores organizations from Settings.yaml into the database
     */
    public function storeOrganizationsFromSettings()
    {
        $settings = $this->configurationManager->getConfiguration(ConfigurationManager::CONFIGURATION_TYPE_SETTINGS, 'SincNovation.Charity');
        $organizations = $settings['organizations'] ?? [];

        foreach ($organizations as $orgData) {
            $organization = new Organization();
            $organization->setName($orgData['name']);
            $organization->setImageUrl($orgData['imageUrl']);
            $organization->setDescription($orgData['description']);
            $organization->setLink($orgData['link']);
            $this->organizationRepository->add($organization);
        }
    }


    /**
     * Retrieves all organizations from database
     *
     * @return array|Organization[]
     */
    public function getAllOrganizations(): array
    {
        return $this->organizationRepository->findAllOrganizations()->toArray();
    }

    /**
     * Gets an organization by its identifier.
     *
     * @param int $organizationId
     * @return Organization|null
     */
    public function getOrganizationById(int $organizationId): ?Organization
    {
        return $this->organizationRepository->findByIdentifier($organizationId);
    }
}
