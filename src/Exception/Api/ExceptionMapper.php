<?php

namespace Lfybk666\Api\Exception\Api;

use Lfybk666\Api\Client\ApiError;
use Lfybk666\Api\Exception\ApiException;

class ExceptionMapper
{
	public static function parse(ApiError $error)
	{
		switch ($error->getErrorCode()) {
			case 1:
				return new ApiMethodException($error);
			case 2:
				return new ApiAuthException($error);
			case 3:
				return new ApiRequestException($error);
			case 4:
				return new ApiServerException($error);
			case 5:
				return new ApiClientVersionDeprecatedException($error);
			case 6:
				return new ApiTimeoutException($error);
			case 7:
				return new ApiParamPageIdException($error);
            case 8:
                return new ApiAuthTokenExpiredException($error);
			default:
				return new ApiException($error->getErrorCode(), $error->getErrorMsg(), $error);
        }
	}
}
