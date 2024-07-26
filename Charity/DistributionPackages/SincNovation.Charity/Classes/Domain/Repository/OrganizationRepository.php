<?php
namespace SincNovation\Charity\Domain\Repository;

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Persistence\Repository;

/**
 * @Flow\Scope("singleton")
 */
class OrganizationRepository extends Repository
{
    /**
     * Finds an Organization by its name.
     *
     * @param string $name
     * @return \SincNovation\Charity\Domain\Model\Organization|null
     */
    public function findOneByName(string $name)
    {
        $query = $this->createQuery();
        return $query->matching($query->equals('name', $name))->execute()->getFirst();
    }

    /**
     * Finds all organizations.
     *
     * @return array|\Neos\Flow\Persistence\QueryResultInterface
     */
    public function findAllOrganizations()
    {
        return $this->findAll();
    }
}
