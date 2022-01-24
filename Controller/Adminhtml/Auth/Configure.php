<?php

declare(strict_types=1);

namespace Dathard\Telegram2FA\Controller\Adminhtml\Auth;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use MSP\TwoFactorAuth\Controller\Adminhtml\AbstractAction;

/**
 * @since 1.0.0
 */
class Configure extends AbstractAction
{
    /**
     * @var PageFactory
     */
    private $pageFactory;

    /**
     * @param Context $context
     * @param PageFactory $pageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $pageFactory
    ) {
        parent::__construct($context);
        $this->pageFactory = $pageFactory;
    }

    /**
     * @inheritdoc
     */
    public function execute()
    {
        return $this->pageFactory->create();
    }
}
