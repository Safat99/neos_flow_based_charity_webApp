<?php
namespace SincNovation\Charity\Domain\Service;

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
     * Retrieves all organizations.
     *
     * @return array|Organization[]
     */
    public function getAllOrganizations(): array
    {
        return $this->organizationRepository->findAll()->toArray();
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
