<?php

namespace Danil\Api\Exception;

use Danil\Api\Client\ApiError;

class ApiException extends BaseException
{
    protected int $errorCode;

    protected string $description;

    protected string $errorMessage;

    protected ApiError $error;

    public function __construct(int $error_code, string $description, ApiError $error)
    {
        $this->errorCode = $error_code;
        $this->description = $description;
        $this->errorMessage = $error->getErrorMsg();
        $this->error = $error;
        parent::__construct($error->getErrorMsg(), $error_code);
    }

    public function getErrorCode(): int
    {
        return $this->errorCode;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }

    public function getError(): ApiError
    {
        return $this->error;
    }
}
