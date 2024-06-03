<?php
declare(strict_types=1);

namespace Lfybk666\Api\Client\Action;

use Lfybk666\Api\Client\ApiRequest;

interface ActionInterface
{
    public function __construct(ApiRequest $request);
}