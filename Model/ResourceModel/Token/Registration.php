<?php

declare(strict_types=1);

namespace Dathard\Telegram2FA\Model\ResourceModel\Token;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * @since 1.0.0
 */
class Registration extends AbstractDb
{
    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init('dt_telegram2fa_registration_tokens', 'id');
    }
}
