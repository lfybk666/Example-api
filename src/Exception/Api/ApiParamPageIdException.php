<?php

namespace Danil\Api\Exception\Api;

use Danil\Api\Client\ApiError;
use Danil\Api\Exception\ApiException;

class ApiParamPageIdException extends ApiException
{
	public function __construct(ApiError $error)
	{
		parent::__construct(7, 'Page not found', $error);
	}
}

