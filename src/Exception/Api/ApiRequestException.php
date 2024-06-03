<?php

namespace Danil\Api\Exception\Api;

use Danil\Api\Client\ApiError;
use Danil\Api\Exception\ApiException;

class ApiRequestException extends ApiException
{
	public function __construct(ApiError $error)
	{
		parent::__construct(3, 'Invalid request', $error);
	}
}

