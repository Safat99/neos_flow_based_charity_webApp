<?php
namespace SincNovation\Charity\Controller;

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Mvc\Controller\ActionController;
use \Neos\Flow\Mvc\View\JsonView;

class DonationController extends ActionController
{
    /**
     * @Flow\Inject
     * @var \SincNovation\Charity\Domain\Repository\DonationRepository
     */
    protected $donationRepository;
    protected $defaultViewObjectName = JsonView::class;

    public function indexAction()
    {
        $donations = $this->donationRepository->findAll();
        $this->view->assign('donations', $donations);
    }

    // Other actions
}