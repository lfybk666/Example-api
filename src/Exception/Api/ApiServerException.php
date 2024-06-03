<?php

namespace Lfybk666\Api\Exception\Api;

use Lfybk666\Api\Client\ApiError;
use Lfybk666\Api\Exception\ApiException;

class ApiServerException extends ApiException
{
	public function __construct(ApiError $error)
	{
		parent::__construct(4, 'Internal server error', $error);
	}
}

