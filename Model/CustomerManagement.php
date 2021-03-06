<?php

declare(strict_types=1);

namespace Dathard\Telegram2FA\Model;

use Dathard\Telegram2FA\Api\CustomerManagementInterface;

/**
 * @since 1.0.0
 */
class CustomerManagement implements CustomerManagementInterface
{
    /**
     * @inheritDoc
     */
    public function updateChatsData()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $request = $objectManager->get(\Magento\Framework\App\RequestInterface::class);
        file_put_contents(BP . '/var/log/webhook_data.log', print_r($request->getContent(), true) . PHP_EOL, FILE_APPEND);
    }
}
