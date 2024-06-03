<?php
declare(strict_types=1);

namespace Lfybk666\Api\Client;

use Lfybk666\Api\Client\Action\ActionInterface;
use Lfybk666\Api\Exception\ClientException;

/**
 * @method \Lfybk666\Api\Action\Comments comments()
 */
class ApiClient
{
    protected const API_HOST = 'http://example.com/';

    private ApiRequest $request;

    private array $instances = [];

    public function __construct()
    {
        $this->request = new ApiRequest(self::API_HOST);
    }

    public function getRequest(): ApiRequest
    {
        return $this->request;
    }

    public function __call(string $name, array $_): ActionInterface
    {
        $name = strtolower($name);

        $class = '\\Lfybk666\\Api\\Actions\\' . ucfirst($name);
        if (!class_exists($class)) {
            throw new ClientException("Class {$class} not found");
        }

        if (!array_key_exists($name, $this->instances)) {
            $this->instances[$name] = new $class($this->request);
        }

        return $this->instances[$name];
    }
}
