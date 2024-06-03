<?php

namespace Lfybk666\Api\Exception\Api;

use Lfybk666\Api\Client\ApiError;
use Lfybk666\Api\Exception\ApiException;

class ApiTimeoutException extends ApiException
{
	public function __construct(ApiError $error)
	{
		parent::__construct(6, 'Method execution was interrupted due to timeout', $error);
	}
}

