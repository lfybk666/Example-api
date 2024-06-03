<?php

namespace Danil\Api\Exception\Api;

use Danil\Api\Client\ApiError;
use Danil\Api\Exception\ApiException;

class ApiClientVersionDeprecatedException extends ApiException
{
	public function __construct(ApiError $error)
	{
		parent::__construct(5, 'Client version deprecated', $error);
	}
}

