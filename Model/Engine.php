<?php

declare(strict_types=1);

namespace Dathard\Telegram2FA\Model;

use Magento\Framework\DataObject;
use Magento\User\Api\Data\UserInterface;
use MSP\TwoFactorAuth\Api\EngineInterface;

class Engine implements EngineInterface
{
    const CODE = 'telegram';

    /**
     * @var Config
     */
    private $config;

    /**
     * @var Verification
     */
    private $verification;

    /**
     * @param Config $config
     * @param Verification $verification
     */
    public function __construct(
        Config $config,
        Verification $verification
    ) {
        $this->config = $config;
        $this->verification = $verification;
    }

    /**
     * @inheritDoc
     */
    public function isEnabled(): bool
    {
        return $this->config->isEnabled() && ! empty($this->config->getApiKey());
    }

    /**
     * @inheritDoc
     */
    public function verify(UserInterface $user, DataObject $request): bool
    {
        return $this->verification->verify($user, $request);
    }

    /**
     * @inheritDoc
     */
    public function isTrustedDevicesAllowed(): bool
    {
        return false;
    }
}
