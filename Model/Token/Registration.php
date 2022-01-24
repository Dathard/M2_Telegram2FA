<?php

declare(strict_types=1);

namespace Dathard\Telegram2FA\Model\Token;

use Magento\Framework\Model\AbstractModel;

/**
 * @since 1.0.0
 */
class Registration extends AbstractModel
{
    /**
     * @inheritDoc
     */
    public function _construct()
    {
        $this->_init(\Dathard\Telegram2FA\Model\ResourceModel\Token\Registration::class);
    }
}
