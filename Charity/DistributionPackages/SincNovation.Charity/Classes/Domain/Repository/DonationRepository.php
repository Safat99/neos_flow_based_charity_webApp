<?php
namespace SincNovation\Charity\Domain\Repository;

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Persistence\Repository;
use Doctrine\ORM\EntityManagerInterface;

use SincNovation\Charity\Domain\Model\Donation;

/**
 * @Flow\Scope("singleton")
 */
class DonationRepository extends Repository
{

    /**
     * @Flow\Inject
     * @var EntityManagerInterface
     */
    protected $entityManager;

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

    public function findAllDonations()
    {
        return $this->findAll();
    }

    public function countDonationsByOrganization(): array
    {
        $connection = $this->entityManager->getConnection();
        $sql = '
            SELECT o.name as organization, COUNT(cd.id) as donation_count
            FROM organizations o
            JOIN charity_donation cd ON o.id = cd.organization_id
            GROUP BY o.id
        ';
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAllAssociative();

        // Map the result to a more readable format
        $donationsByOrganization = [];
        foreach ($result as $row) {
            $donationsByOrganization[$row['organization']] = $row['donation_count'];
        }

        return $donationsByOrganization;
    }
}
