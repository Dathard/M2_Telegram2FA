<?php

declare(strict_types=1);

namespace Dathard\Telegram2FA\Block\Provider;

use Dathard\Telegram2FA\Model\Bot;
use Dathard\Telegram2FA\Model\TokenManager;
use Magento\Backend\Block\Template;
use Magento\Backend\Block\Template\Context;

/**
 * @since 1.0.0
 */
class Configure extends Template
{
    /**
     * @var Bot
     */
    private $bot;

    /**
     * @var TokenManager
     */
    private $tokenManager;

    /**
     * @param Bot $bot
     * @param TokenManager $tokenManager
     * @param Context $context
     * @param array $data
     */
    public function __construct(
        Bot $bot,
        TokenManager $tokenManager,
        Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->bot = $bot;
        $this->tokenManager = $tokenManager;
    }

    /**
     * @inheritdoc
     */
    public function getJsLayout()
    {
        $this->jsLayout['components']['msp-twofactorauth-auth']['postUrl'] =
            $this->getUrl('*/*/authpost');

        $this->jsLayout['components']['msp-twofactorauth-auth']['qrCodeUrl'] =
            $this->bot->getBotUrlAsQRCode();

        $this->jsLayout['components']['msp-twofactorauth-auth']['secretCode'] =
            $this->tokenManager->getRegistrationToken();

        $this->jsLayout['components']['msp-twofactorauth-auth']['successUrl'] =
            $this->getUrl($this->_urlBuilder->getStartupPageUrl());

        return parent::getJsLayout();
    }
}
