<?php

declare(strict_types=1);

namespace Dathard\Telegram2FA\Model;

use Magento\User\Api\Data\UserInterface;

/**
 * @since 1.0.0
 */
class Verification
{
    /**
     * @param UserInterface $user
     * @param $verificationCode
     * @return bool
     */
    public function verify(UserInterface $user, $verificationCode): bool
    {
        return true;
    }
}
