<?php

declare(strict_types=1);

namespace Dathard\Telegram2FA\Service;

class GoogleCharts
{
    const ROOT_URL = 'https://chart.googleapis.com/chart';

    /**
     * @param string $text
     * @param string $size
     * @return string
     */
    public function getQRCodeUrl(string $text, string $size = '300x300'): string
    {
        $params = [
            'cht'   => 'qr', // chart type
            'chs'   => $size, // chart size
            'chl'   => $text,
            'choe'  => 'UTF-8' // chart output encoding
        ];

        return self::ROOT_URL . '?' . http_build_query($params);
    }
}
