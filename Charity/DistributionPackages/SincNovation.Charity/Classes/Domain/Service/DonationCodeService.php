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
     * Validates if a donation code is valid and available for use.
     *
     * @param string $code
     * @return array
     */
    public function validateCode(string $code): array
    {
        $donationCode = $this->donationCodeRepository->findOneByCode($code);
        
        if ($donationCode === null) {
            return ['exists' => false, 'isUsed' => false];
        }

        return ['exists' => true, 'isUsed' => $donationCode->getIsUsed()];
    }

    /**
     * Marks a donation code as used.
     *
     * @param string $code
     * @return bool
     */
    public function markCodeAsUsed(string $code)
    {
        $donationCode = $this->donationCodeRepository->findByCode($code);
        if ($donationCode) {
            $donationCode->setIsUsed(true);
            $this->donationCodeRepository->update($donationCode);
            return true;
        } else {
            return false;
        }
    }
}
