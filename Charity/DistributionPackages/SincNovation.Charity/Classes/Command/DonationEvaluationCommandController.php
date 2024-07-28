<?php
namespace SincNovation\Charity\Command;

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Cli\CommandController;

use SincNovation\Charity\Domain\Repository\DonationRepository;
use SincNovation\Charity\Domain\Repository\DonationCodeRepository;

/**
 * @Flow\Scope("singleton")
 */
class DonationEvaluationCommandController extends CommandController
{

    /**
     * @Flow\Inject
     * @var DonationRepository
     */
    protected $donationRepository;

    /**
     * @Flow\Inject
     * @var DonationCodeRepository
     */
    protected $donationCodeRepository;

    public function evaluateCommand(): void
    {
        // Get the total number of donations
        $totalDonations = $this->donationRepository->countAll();

        // Get the total number of unused donation codes
        $unusedCodes = $this->donationCodeRepository->countUnusedCodes();

        // Get donation counts by organization
        $donationsByOrganization = $this->donationRepository->countDonationsByOrganization();

        // Output the donation status
        $this->outputLine('Donation Status Evaluation:');
        $this->outputLine('---------------------------');
        $this->outputLine('Total Donations: %d', [$totalDonations]);
        $this->outputLine('Unused Donation Codes: %d', [$unusedCodes]);
        $this->outputLine('Donations by Organization:');

        foreach ($donationsByOrganization as $organization => $count) {
            $this->outputLine('  Organization %s: %d donations', [$organization, $count]);
        }

    }


}