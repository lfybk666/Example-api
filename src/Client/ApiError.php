<?php
declare(strict_types=1);

namespace Danil\Api\Client;

class ApiError
{
    protected const ERROR_CODE = 'error_code';
    protected const ERROR_MSG = 'error_msg';

    protected ?int $errorCode = null;

    protected ?string $errorMsg = null;


    public function __construct(array $error)
    {
        if (array_key_exists(static::ERROR_CODE, $error)) {
            $this->errorCode = (int)$error[static::ERROR_CODE];
        }

        if (array_key_exists(static::ERROR_MSG, $error)) {
            $this->errorMsg = (string)$error[static::ERROR_MSG];
        }
    }

    public function getErrorCode(): ?int
    {
        return $this->errorCode;
    }

    public function getErrorMsg(): ?string
    {
        return $this->errorMsg;
    }
}
