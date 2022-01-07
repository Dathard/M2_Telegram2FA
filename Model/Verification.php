<?php

declare(strict_types=1);

namespace Dathard\Telegram2FA\Model;

use Magento\User\Api\Data\UserInterface;

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
