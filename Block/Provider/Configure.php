<?php

declare(strict_types=1);

namespace Dathard\Telegram2FA\Block\Provider;

use Magento\Backend\Block\Template;

class Configure extends Template
{
    /**
     * @inheritdoc
     */
    public function getJsLayout()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $googleCharts = $objectManager->create(\Dathard\Telegram2FA\Service\GoogleCharts::class);




        $this->jsLayout['components']['msp-twofactorauth-auth']['postUrl'] =
            $this->getUrl('*/*/authpost');

        $this->jsLayout['components']['msp-twofactorauth-auth']['qrCodeUrl'] =
            $googleCharts->getQRCodeUrl('test test test');

        $this->jsLayout['components']['msp-twofactorauth-auth']['secretCode'] =
            '111111';

        $this->jsLayout['components']['msp-twofactorauth-auth']['successUrl'] =
            $this->getUrl($this->_urlBuilder->getStartupPageUrl());

        return parent::getJsLayout();
    }
}
