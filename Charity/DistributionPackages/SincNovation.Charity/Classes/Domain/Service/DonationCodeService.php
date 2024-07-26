<?php
namespace SincNovation\Charity\Domain\Service;

use Neos\Flow\Annotations as Flow;
use SincNovation\Charity\Domain\Model\DonationCode;
use SincNovation\Charity\Domain\Repository\DonationCodeRepository;

/**
 * @Flow\Scope("singleton")
 */
class DonationCodeService
{
    /**
     * @Flow\Inject
     * @var DonationCodeRepository
     */
    protected $donationCodeRepository;

    /**
     * Imports donation codes from a CSV file.
     *
     * @param string $csvFilePath
     * @return void
     */
    public function importDonationCodes(string $csvFilePath)
    {
        // Implement CSV file reading and donation code importing logic here
    }

    /**
     * Validates if a donation code is valid and available for use.
     *
     * @param string $code
     * @return bool
     */
    public function validateCode(string $code): bool
    {
        $donationCode = $this->donationCodeRepository->findByCode($code);
        return $donationCode !== null && !$donationCode->getIsUsed();
    }

    /**
     * Marks a donation code as used.
     *
     * @param string $code
     * @return void
     */
    public function markCodeAsUsed(string $code)
    {
        $donationCode = $this->donationCodeRepository->findByCode($code);
        if ($donationCode) {
            $donationCode->setIsUsed(true);
            $this->donationCodeRepository->update($donationCode);
        }
    }
}
