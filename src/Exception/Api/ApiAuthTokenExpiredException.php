<?php

namespace Danil\Api\Exception\Api;

use Danil\Api\Client\ApiError;
use Danil\Api\Exception\ApiException;

class ApiAuthTokenExpiredException extends ApiException
{
	public function __construct(ApiError $error)
	{
		parent::__construct(8, 'Auth token has expired', $error);
	}
}

