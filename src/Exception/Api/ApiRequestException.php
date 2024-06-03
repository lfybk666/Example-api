<?php

namespace Lfybk666\Api\Exception\Api;

use Lfybk666\Api\Client\ApiError;
use Lfybk666\Api\Exception\ApiException;

class ApiRequestException extends ApiException
{
	public function __construct(ApiError $error)
	{
		parent::__construct(3, 'Invalid request', $error);
	}
}

