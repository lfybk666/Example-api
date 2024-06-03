<?php
declare(strict_types=1);

namespace Danil\Api\Client;

use Danil\Api\Client\Model\BaseEntity;
use Danil\Api\Exception\Api\ExceptionMapper;
use Danil\Api\Exception\ClientException;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class ApiRequest
{
    protected const PARAM_ACCESS_TOKEN = 'access_token';

    protected const KEY_ERROR = 'error';

    protected const KEY_RESPONSE = 'response';

    protected const CONNECTION_TIMEOUT = 10;

    protected const HTTP_STATUS_CODE_OK = 200;

    protected const HTTP_STATUS_CODE_CREATED = 201;

    protected string $host;

    protected ClientInterface $client;


    public function __construct(string $host, ?ClientInterface $client = null)
    {
        $this->host = $host;
        $this->client = $client ?: new Client([
            'base_uri' => $host,
            'timeout'  => static::CONNECTION_TIMEOUT,
        ]);
    }

    public function get(string $method, string $accessToken, array $params = array())
    {
        $params = $this->formatParams($params);
        $params[static::PARAM_ACCESS_TOKEN] = $accessToken;

        try {
            $response = $this->client->get("{$this->host}/{$method}?" . http_build_query($params));
        } catch (GuzzleException $exception) {
            throw new ClientException($exception->getMessage());
        }

        return $this->parseResponse($response);
    }

    public function post(BaseEntity $entity, string $method, string $accessToken, array $params = array())
    {
        $params = $this->formatParams($params);
        $params[static::PARAM_ACCESS_TOKEN] = $accessToken;

        try {
            $response = $this->client->post(
                "{$this->host}/{$method}?" . http_build_query($params),
                ['json' => $entity]
            );
        } catch (GuzzleException $exception) {
            throw new ClientException($exception->getMessage());
        }

        return $this->parseResponse($response);
    }

    public function put(BaseEntity $entity, int $id, string $method, string $accessToken, array $params = array())
    {
        $params = $this->formatParams($params);
        $params[static::PARAM_ACCESS_TOKEN] = $accessToken;

        try {
            $response = $this->client->put(
                "{$this->host}/{$method}/{$id}?" . http_build_query($params),
                ['json' => $entity]
            );
        } catch (GuzzleException $exception) {
            throw new ClientException($exception->getMessage());
        }

        return $this->parseResponse($response);
    }

    private function parseResponse(ResponseInterface $response)
    {
        if (
            $response->getStatusCode() !== static::HTTP_STATUS_CODE_OK
            ||
            $response->getStatusCode() !== static::HTTP_STATUS_CODE_CREATED
        ) {
            throw new ClientException("Invalid http status: {$response->getStatusCode()}");
        }

        $body = $response->getBody()->getContents();
        $decode_body = $this->decodeBody($body);

        if (isset($decode_body[static::KEY_ERROR])) {
            $error = $decode_body[static::KEY_ERROR];
            $api_error = new ApiError($error);
            throw ExceptionMapper::parse($api_error);
        }

        if (isset($decode_body[static::KEY_RESPONSE])) {
            return $decode_body[static::KEY_RESPONSE];
        }

        return $decode_body;
    }

    private function formatParams(array $params): array
    {
        foreach ($params as $key => $value) {
            if (is_array($value)) {
                $params[$key] = implode(',', $value);
            } elseif (is_bool($value)) {
                $params[$key] = $value ? 1 : 0;
            }
        }
        return $params;
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
