<?php

declare(strict_types=1);

namespace Dathard\Telegram2FA\Service;

use Dathard\Telegram2FA\Lib\Http\Client\Curl;
use Dathard\Telegram2FA\Lib\Http\Client\CurlFactory;
use Magento\Framework\DataObject;
use Magento\Framework\DataObjectFactory;
use Magento\Framework\Webapi\Rest\Request;
use Psr\Log\LoggerInterface;

class TelegramBotApi
{
    const API_REQUEST_URI = 'https://api.telegram.org/bot';

    /**
     * @var null|string
     */
    private $apiKey;

    /**
     * @var CurlFactory
     */
    private $curlFactory;

    /**
     * @var DataObjectFactory
     */
    private $dataObjectFactory;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param CurlFactory $curlFactory
     * @param DataObjectFactory $dataObjectFactory
     * @param LoggerInterface $logger
     */
    public function __construct(
        CurlFactory $curlFactory,
        DataObjectFactory $dataObjectFactory,
        LoggerInterface $logger
    ) {
        $this->curlFactory = $curlFactory;
        $this->dataObjectFactory = $dataObjectFactory;
        $this->logger = $logger;
    }

    /**
     * @param string $apiKey
     * @return void
     */
    public function setApiKey(string $apiKey): void
    {
        $this->apiKey = $apiKey;
    }

    /**
     * @return DataObject|null
     */
    public function getBotData()
    {
        if (! $this->apiKey) {
            return null;
        }

        $response = $this->makeRequest('getMe');

        if (! $response || $response['status'] != 200) {
            return null;
        }

        $response = json_decode($response['body'], true);

        return $this->convertToDataObject($response['result']);
    }

    /**
     * @param string $url
     * @param int $maxConnections
     * @return DataObject|null
     */
    public function setWebhook(string $url, int $maxConnections = 40)
    {
        if (! $this->apiKey) {
            return null;
        }

        $response = $this->makeRequest(
            'setWebhook',
            [
                'url' => $url,
                'maxConnections' => $maxConnections
            ],
            Request::HTTP_METHOD_POST
        );

        if (! $response || $response['status'] != 200) {
            return null;
        }

        return $this->convertToDataObject(json_decode($response['body'], true));
    }

    /**
     * @param int $chatId
     * @param string $text
     * @return DataObject|null
     */
    public function sendMessage(int $chatId, string $text)
    {
        if (! $this->apiKey) {
            return null;
        }

        $response = $this->makeRequest(
            'sendMessage',
            [
                'chat_id' => $chatId,
                'text' => $text
            ]
        );

        if (! $response || $response['status'] != 200) {
            return null;
        }

        $response = json_decode($response['body'], true);

        return $this->convertToDataObject($response['result']);
    }

    /**
     * Do API request with provided params
     *
     * @param string $apiMethod
     * @param array $params
     * @param string $requestMethod
     * @return array|null
     */
    public function makeRequest(
        string $apiMethod,
        array $params = [],
        string $requestMethod = Request::HTTP_METHOD_GET
    ) {
        $uriEndpoint = self::API_REQUEST_URI . "{$this->apiKey}/{$apiMethod}";

        /** @var Curl $curl */
        $curl = $this->curlFactory->create();
        $curl->setHeaders(['Content-Type' => 'application/json']);

        try {
            switch ($requestMethod) {
                case Request::HTTP_METHOD_POST:
                    $params = json_encode($params);
                    $curl->post($uriEndpoint, $params);
                    break;
                case Request::HTTP_METHOD_GET:
                    $curl->get($uriEndpoint, $params);
                    break;
                default:
                    $curl->request($requestMethod, $uriEndpoint, $params);
            }
        } catch (\Exception $exception) {
            $logData = [
                'type' => 'Telegram 2FA',
                'message' => $exception->getMessage()
            ];
            $this->logger->critical(print_r($logData, true));

            return null;
        }

        return [
            'status' => $curl->getStatus(),
            'body' => $curl->getBody()
        ];
    }

    /**
     * @param array $data
     * @return DataObject
     */
    private function convertToDataObject(array $data): DataObject
    {
        return $this->dataObjectFactory->create()
            ->addData($data);
    }
}
