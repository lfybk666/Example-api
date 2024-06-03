<?php
declare(strict_types=1);

namespace Danil\Api\Client\Action;

use Danil\Api\Client\ApiRequest;

interface ActionInterface
{
    public function __construct(ApiRequest $request);
}