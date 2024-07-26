<?php
namespace SincNovation\Charity\Domain\Service;

use Neos\Flow\Annotations as Flow;
use SincNovation\Charity\Domain\Model\Donation;
use SincNovation\Charity\Domain\Repository\DonationRepository;

/**
 * @Flow\Scope("singleton")
 */
class DonationService
{
    /**
     * @Flow\Inject
     * @var DonationRepository
     */
    protected $donationRepository;

    /**
     * Creates a new donation.
     *
     * @param int $organizationId
     * @param \DateTimeInterface $date
     * @param string $donationCode
     * @return Donation
     */
    public function createDonation(int $organizationId, \DateTimeInterface $date, string $donationCode): Donation
    {
        $donation = new Donation();
        $donation->setOrganization($organizationId);
        $donation->setDate($date);
        $donation->setDonationCode($donationCode);
        $this->donationRepository->add($donation);
        return $donation;
    }

    /**
     * Retrieves donations by organization.
     *
     * @param int $organizationId
     * @return array|Donation[]
     */
    public function getDonationsByOrganization(int $organizationId): array
    {
        return $this->donationRepository->findByOrganizationId($organizationId)->toArray();
    }

    /**
     * Retrieves all donations.
     *
     * @return array|Donation[]
     */
    public function getAllDonations(): array
    {
        return $this->donationRepository->findAll()->toArray();
    }

    /**
     * Generates a donation report.
     *
     * @return string
     */
    public function generateDonationReport(): string
    {
        // Implement the logic to generate a donation report
        return "Donation report content";
    }
}
