<?php

namespace Danil\Api\Exception\Api;

use Danil\Api\Client\ApiError;
use Danil\Api\Exception\ApiException;

class ApiTimeoutException extends ApiException
{
	public function __construct(ApiError $error)
	{
		parent::__construct(6, 'Method execution was interrupted due to timeout', $error);
	}
}

