<?php

namespace Danil\Api\Exception\Api;

use Danil\Api\Client\ApiError;
use Danil\Api\Exception\ApiException;

class ApiServerException extends ApiException
{
	public function __construct(ApiError $error)
	{
		parent::__construct(4, 'Internal server error', $error);
	}
}

