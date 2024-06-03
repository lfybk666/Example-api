<?php

namespace Lfybk666\Api\Exception\Api;

use Lfybk666\Api\Client\ApiError;
use Lfybk666\Api\Exception\ApiException;

class ApiAuthTokenExpiredException extends ApiException
{
	public function __construct(ApiError $error)
	{
		parent::__construct(8, 'Auth token has expired', $error);
	}
}

