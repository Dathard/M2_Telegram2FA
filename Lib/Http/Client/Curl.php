<?php

declare(strict_types=1);

namespace Dathard\Telegram2FA\Lib\Http\Client;

use Magento\Framework\HTTP\Client\Curl as CurlClient;

class Curl extends CurlClient
{
    /**
     * Make request
     *
     * @param string $method
     * @param string $uri
     * @param string|array $params
     * @return void
     */
    public function request(string $method ,string $uri, $params = []): void
    {
        $this->makeRequest("GET", $uri, $params);
    }

    /**
     * Make GET request
     *
     * @param string $uri uri relative to host, ex. "/index.php"
     * @param array $params
     * @return void
     */
    public function get($uri, array $params = []): void
    {
        if ($params) {
            $uri .= ((parse_url($uri, PHP_URL_QUERY)) ? "&" : "?")
                . \preg_replace('/%5B(\d+)?%5D=/', '[]=', \http_build_query($params));
        }
        $this->makeRequest("GET", $uri);
    }
}
