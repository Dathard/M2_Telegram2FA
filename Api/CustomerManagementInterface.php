<?php

declare(strict_types=1);

namespace Dathard\Telegram2FA\Api;

/**
 * @since 1.0.0
 */
interface CustomerManagementInterface
{
    /**
     * @return string
     */
    public function updateChatsData();
}
