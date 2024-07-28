<?php
namespace SincNovation\Charity\Domain\Service;

use Neos\Flow\Annotations as Flow;

use SincNovation\Charity\Domain\Model\Donation;
use SincNovation\Charity\Domain\Model\Organization;
use SincNovation\Charity\Domain\Model\DonationCode;
use SincNovation\Charity\Domain\Repository\DonationRepository;
use SincNovation\Charity\Domain\Repository\OrganizationRepository;
use SincNovation\Charity\Domain\Repository\DonationCodeRepository;
use SincNovation\Charity\Domain\Exception\DonationException;
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
     * @Flow\Inject
     * @var OrganizationRepository
     */
    protected $organizationRepository;

    /**
     * @Flow\Inject
     * @var DonationCodeRepository
     */
    protected $donationCodeRepository;

    /**
     * Create a new donation
     *
     * @param int $organizationId
     * @param \DateTimeInterface $date
     * @param string $donationCode
     * @return array
     * @throws DonationException if the organization or donation code is not found
     */
    public function createDonation(int $organizationId, \DateTimeInterface $date, string $donationCode): array
    {
        $organization = $this->organizationRepository->findByIdentifier($organizationId);
        if ($organization === null) {
            throw new DonationException("Organization not found");
        }

        $donationCodeEntity = $this->donationCodeRepository->findOneByCode($donationCode);
        if ($donationCodeEntity === null || $donationCodeEntity->getIsUsed()) {
            throw new DonationException("Invalid or already used donation code");
        }

        $donation = new Donation();
        $donation->setOrganization($organization);
        $donation->setDate($date);
        $donation->setDonationCode($donationCodeEntity);
        $this->donationRepository->add($donation);

        // Mark the donation code as used
        $donationCodeEntity->setIsUsed(true);
        $this->donationCodeRepository->update($donationCodeEntity);

        return [
            'id' => $donation->getId(),
            'organization' => [
                'id' => $organization->getId(),
                'name' => $organization->getName(),
            ],
            'date' => $donation->getDate()->format(\DateTime::ATOM),
            'donationCode' => $donationCodeEntity->getCode(),
        ];
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
