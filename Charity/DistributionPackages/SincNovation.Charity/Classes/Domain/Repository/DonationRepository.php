<?php
namespace SincNovation\Charity\Domain\Repository;

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Persistence\Repository;
use SincNovation\Charity\Domain\Model\Donation;

/**
 * @Flow\Scope("singleton")
 */
class DonationRepository extends Repository
{
    /**
     * Finds donations by a specific organization ID.
     *
     * @param int $organizationId
     * @return \Neos\Flow\Persistence\QueryResultInterface
     */
    public function findByOrganizationId(int $organizationId)
    {
        $query = $this->createQuery();
        return $query->matching(
            $query->equals('organization', $organizationId)
        )->execute();
    }

    /**
     * Finds donations by a specific date.
     *
     * @param \DateTimeInterface $date
     * @return \Neos\Flow\Persistence\QueryResultInterface
     */
    public function findByDate(\DateTimeInterface $date)
    {
        $query = $this->createQuery();
        return $query->matching(
            $query->equals('date', $date)
        )->execute();
    }

    /**
     * Finds donations by a specific donation code.
     *
     * @param string $donationCode
     * @return Donation|null
     */
    public function findByDonationCode(string $donationCode): ?Donation
    {
        $query = $this->createQuery();
        return $query->matching(
            $query->equals('donationCode.code', $donationCode)
        )->execute()->getFirst();
    }

    /**
     * Finds all donations with the associated organization.
     *
     * @return \Neos\Flow\Persistence\QueryResultInterface
     */
    public function findAllWithOrganization()
    {
        $query = $this->createQuery();
        return $query->execute();
    }
}
