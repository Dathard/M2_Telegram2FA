<?php

declare(strict_types=1);

namespace Dathard\Telegram2FA\Model;

use Dathard\Telegram2FA\Api\CustomerManagementInterface;

class CustomerManagement implements CustomerManagementInterface
{
    /**
     * @inheritDoc
     */
    public function updateData()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $request = $objectManager->get(\Magento\Framework\App\RequestInterface::class);
        file_put_contents(BP . '/var/log/webhook_data.log', print_r($request->getContent(), true) . PHP_EOL, FILE_APPEND);
    }
}
