<?php
namespace SincNovation\Charity\Controller;

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Mvc\Controller\ActionController;
use \Neos\Flow\Mvc\View\JsonView;

use SincNovation\Charity\Domain\Repository\DonationRepository;
use SincNovation\Charity\Domain\Service\DonationService;
use SincNovation\Charity\Domain\Exception\DonationException;

class DonationController extends ActionController
{
    protected $defaultViewObjectName = JsonView::class;

    /**
     * @Flow\Inject
     * @var \SincNovation\Charity\Domain\Repository\DonationRepository
     */
    protected $donationRepository;

    /**
     * @Flow\Inject
     * @var DonationService
     */
    protected $donationService;

    public function listAction()
    {
        $donations = $this->donationRepository->findAllDonations();
        $this->view->assign('donations', $donations);
    }

    public function createDonationAction()
    {
        try {
            $organizationId = $this->request->getArgument('organizationId');
            $donationCode = $this->request->getArgument('donationCode');
            $date = new \DateTime();

            $donationData = $this->donationService->createDonation($organizationId, $date, $donationCode);

            $response = [
                'success' => true,
                'donation' => $donationData,
            ];
        } catch (DonationException $e) {
            $response = [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        } catch (\Exception $e) {
            $response = [
                'success' => false,
                'error' => 'An unexpected error occurred.',
            ];
        }

        $this->view->assign('value', $response);
    }
    
}