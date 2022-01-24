<?php

declare(strict_types=1);

namespace Dathard\Telegram2FA\Model\ResourceModel\Token\Registration;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * @since 1.0.0
 */
class Collection extends AbstractCollection
{
    /**
     * @inheritDoc
     */
    protected $_idFieldName = 'id';

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(
            \Dathard\Telegram2FA\Model\Token\Registration::class,
            \Dathard\Telegram2FA\Model\ResourceModel\Token\Registration::class
        );
    }
}
