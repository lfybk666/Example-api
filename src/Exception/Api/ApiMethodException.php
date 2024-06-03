<?php

namespace Danil\Api\Exception\Api;

use Danil\Api\Client\ApiError;
use Danil\Api\Exception\ApiException;

class ApiMethodException extends ApiException
{
	public function __construct(ApiError $error)
	{
		parent::__construct(1, 'Unknown method passed', $error);
	}
}

