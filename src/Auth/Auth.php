<?php

namespace Danil\Api\Auth;

use Danil\Api\Exception\ClientException;
use Danil\Api\Exception\AuthException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\ResponseInterface;

class Auth
{
    private const PARAM_API_KEY = 'api_key';

    private const RESPONSE_KEY_ERROR = 'error';

    private const RESPONSE_KEY_ERROR_DESCRIPTION = 'error_description';

    protected const HOST = 'https://example.com';

    private const ENDPOINT_ACCESS_TOKEN = '/access_token';

    protected const CONNECTION_TIMEOUT = 10;

    protected const HTTP_STATUS_CODE_OK = 200;

    private ClientInterface $client;

    private string $host;

    public function __construct(?ClientInterface $client = null)
    {
        $this->host = static::HOST;
        $this->client = $client ?: new Client([
            'base_uri' => $this->host,
            'timeout' => static::CONNECTION_TIMEOUT,
        ]);
    }

    public function getAccessToken(string $apiKey)
    {
        $params = [
            static::PARAM_API_KEY => $apiKey,
        ];

        try {
            $url = $this->host . static::ENDPOINT_ACCESS_TOKEN . '?' . http_build_query($params);
            $response = $this->client->get($url);
        } catch (GuzzleException $e) {
            throw new ClientException($e);
        }

        return $this->checkAuthResponse($response);
    }

    protected function checkAuthResponse(ResponseInterface $response)
    {
        if ($response->getStatusCode() !== static::HTTP_STATUS_CODE_OK) {
            throw new ClientException("Invalid http status: {$response->getStatusCode()}");
        }

        $body = $response->getBody()->getContents();
        $decode_body = $this->decodeBody($body);

        if (isset($decode_body[static::RESPONSE_KEY_ERROR])) {
            throw new AuthException(
                "{$decode_body[static::RESPONSE_KEY_ERROR_DESCRIPTION]}. Auth error {$decode_body[static::RESPONSE_KEY_ERROR]}"
            );
        }

        return $decode_body;
    }

    protected function decodeBody(string $body)
    {
        $decoded_body = json_decode($body, true);

        if (!is_array($decoded_body)) {
            $decoded_body = [];
        }

        return $decoded_body;
    }
}
