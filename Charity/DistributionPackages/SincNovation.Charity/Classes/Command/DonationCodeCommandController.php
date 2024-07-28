<?php
namespace SincNovation\Charity\Command;

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Cli\CommandController;
use SincNovation\Charity\Domain\Model\DonationCode;
use SincNovation\Charity\Domain\Repository\DonationCodeRepository;

class DonationCodeCommandController extends CommandController
{
    /**
     * @Flow\Inject
     * @var DonationCodeRepository
     */
    protected $donationCodeRepository;

    /**
     * Import donation codes from a CSV file.
     *
     * @param string $csvFile Path to the CSV file
     * @return void
     */
    public function importCommand(string $csvFile)
    {
        if (!file_exists($csvFile)) {
            $this->outputLine('File not found.');
            return;
        }

        $file = fopen($csvFile, 'r');

        // Skip the header row
        fgetcsv($file);

        while (($line = fgetcsv($file)) !== false) {
            $code = trim($line[0]);
            if (empty($code) || $this->donationCodeRepository->findOneByCode($code)) {
                $this->outputLine('Invalid or duplicate code: %s', [$code]);
                continue;
            }
            $donationCode = new DonationCode();
            $donationCode->setCode($code);
            $donationCode->setIsUsed(false);
            $this->donationCodeRepository->add($donationCode);
        }
        fclose($file);
        $this->outputLine('Import completed.');
    }
}
