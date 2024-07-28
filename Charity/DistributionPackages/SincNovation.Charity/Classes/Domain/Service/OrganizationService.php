<?php
namespace SincNovation\Charity\Domain\Service;

use Neos\Flow\Configuration\ConfigurationManager;
use Neos\Flow\Annotations as Flow;
use Neos\Flow\Mvc\Exception\NoSuchControllerException;

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
     * Retrieves an organization by its name.
     *
     * @param string $organizationName
     * @return Organization|null
     * @throws NoSuchControllerException
     */
    public function getOrganizationByName(string $organizationName): ?Organization
    {
        $organization = $this->organizationRepository->findOneByName($organizationName);
        if ($organization === null) {
            throw new NoSuchControllerException("No organization found with name: $organizationName", 404);
        }
        return $organization;
    }

    public function getOrganizationById(int $organizationId): ?Organization
    {
        $organization = $this->organizationRepository->findByIdentifier($organizationId);
        if ($organization === null) {
            throw new NoSuchControllerException("No organization found with ID: $organizationId", 404);
        }
        return $organization;
    }

}
