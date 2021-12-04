<?php

declare(strict_types=1);

namespace Dathard\Telegram2FA\Api;

interface CustomerManagementInterface
{
    /**
     * @return string
     */
    public function updateData();
}
