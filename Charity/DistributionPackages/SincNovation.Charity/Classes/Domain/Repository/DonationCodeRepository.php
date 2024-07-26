<?php
namespace SincNovation\Charity\Domain\Repository;

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Persistence\Repository;

/**
 * @Flow\Scope("singleton")
 */
class DonationCodeRepository extends Repository
{
    /**
     * Finds a DonationCode by its code value.
     *
     * @param string $code
     * @return \SincNovation\Charity\Domain\Model\DonationCode|null
     */
    public function findOneByCode(string $code)
    {
        $query = $this->createQuery();
        return $query->matching($query->equals('code', $code))->execute()->getFirst();
    }

    /**
     * Finds all unused donation codes.
     *
     * @return array|\Neos\Flow\Persistence\QueryResultInterface
     */
    public function findUnusedCodes()
    {
        $query = $this->createQuery();
        return $query->matching($query->equals('isUsed', false))->execute();
    }

    /**
     * Marks a donation code as used.
     *
     * @param string $code
     * @return void
     */
    public function markCodeAsUsed(string $code)
    {
        $donationCode = $this->findOneByCode($code);
        if ($donationCode !== null) {
            $donationCode->setIsUsed(true);
            $this->update($donationCode);
        }
    }
}
