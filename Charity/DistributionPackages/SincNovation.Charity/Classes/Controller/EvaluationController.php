<?php
namespace SincNovation\Charity\Controller;


use Neos\Flow\Annotations as Flow;
use Neos\Flow\Mvc\Controller\ActionController;
use \Neos\Flow\Mvc\View\JsonView;

use SincNovation\Charity\Domain\Repository\DonationRepository;
use SincNovation\Charity\Domain\Repository\DonationCodeRepository;


/**
 * @Flow\Scope("singleton")
 */
class EvaluationController extends ActionController
{

    protected $defaultViewObjectName = JsonView::class;
    
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

    public function evaluationAction() {

        $totalDonations = $this->donationRepository->countAll();
        $unusedCodes = $this->donationCodeRepository->countUnusedCodes();
        $donationsByOrganization = $this->donationRepository->countDonationsByOrganization();

        $response = [
            'Total Donations:' => $totalDonations,
            'Unused Donation Codes:' => $unusedCodes,
            'Donation Count By Organizaiton' => $donationsByOrganization
        ];

        $this->view->assign('value', $response);

    }
}