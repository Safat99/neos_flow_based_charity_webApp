<?php
namespace SincNovation\Charity\Controller;

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Mvc\Controller\ActionController;
use Neos\Flow\Mvc\View\JsonView;
use SincNovation\Charity\Domain\Service\DonationCodeService;

/**
 * @Flow\Scope("singleton")
 */
class DonationCodeController extends ActionController
{
    protected $defaultViewObjectName = JsonView::class;

    /**
     * @var DonationCodeService
     * @Flow\Inject
     */
    protected $donationCodeService;

    /**
     * Validate a donation code
     *
     * @return void
     */
    public function validateAction()
    {
        $code = $this->request->getArgument('code');

        $validationResult = $this->donationCodeService->validateCode($code);

        if (!$validationResult['exists']) {
            $this->view->assign('value', [
                'status' => 'error',
                'message' => 'Code not found'
            ]);
        } elseif ($validationResult['isUsed']) {
            $this->view->assign('value', [
                'status' => 'error',
                'message' => 'Der eingegebene Code wurde bereits eingelöst. The entered code has already been redeemed.'
            ]);
        } else {
            $this->view->assign('value', [
                'status' => 'success',
                'message' => 'Code is valid',
                'code' => $code
            ]);
        }
    }
}
