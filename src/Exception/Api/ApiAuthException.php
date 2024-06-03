<?php

namespace Danil\Api\Exception\Api;

use Danil\Api\Client\ApiError;
use Danil\Api\Exception\ApiException;

class ApiAuthException extends ApiException
{
	public function __construct(ApiError $error)
	{
		parent::__construct(2, 'User authorization failed', $error);
	}
}

