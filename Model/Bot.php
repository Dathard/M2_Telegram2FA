<?php

declare(strict_types=1);

namespace Dathard\Telegram2FA\Model;

use Dathard\Telegram2FA\Service\GoogleCharts;
use Dathard\Telegram2FA\Service\TelegramBotApi;

/**
 * @since 1.0.0
 */
class Bot
{
    /**
     * @var GoogleCharts
     */
    private $googleCharts;

    /**
     * @var TelegramBotApi
     */
    private $botApiService;

    /**
     * @param Config $config
     * @param GoogleCharts $googleCharts
     * @param TelegramBotApi $botApiService
     */
    public function __construct(
        Config $config,
        GoogleCharts $googleCharts,
        TelegramBotApi $botApiService
    ) {
        $this->googleCharts = $googleCharts;
        $this->botApiService = $botApiService;
        $this->botApiService->setApiKey($config->getApiKey());
    }

    public function getBotUrl(): string
    {
        return (string) $this->botApiService->getBotData()->getUrl();
    }

    public function getBotUrlAsQRCode(): string
    {
        return $this->googleCharts->getQRCodeUrl($this->getBotUrl());
    }
}
