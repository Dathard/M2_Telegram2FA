<?php

declare(strict_types=1);

namespace Dathard\Telegram2FA\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;

/**
 * @since 1.0.0
 */
class Config
{
    const XML_PATH_ENABLED = 'msp_securitysuite_twofactorauth/telegram/enabled';
    const XML_PATH_API_KEY = 'msp_securitysuite_twofactorauth/telegram/api_key';

    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * Return true if this provider has been enabled by admin
     *
     * @return bool
     */
    public function isEnabled(): bool
    {
        return (bool) $this->scopeConfig->getValue(static::XML_PATH_ENABLED);
    }

    /**
     * Get API key
     *
     * @return string
     */
    public function getApiKey(): string
    {
        return (string) $this->scopeConfig->getValue(static::XML_PATH_API_KEY);
    }
}
