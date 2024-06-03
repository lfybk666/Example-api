<?php
declare(strict_types=1);

namespace Test;

use Lfybk666\Api\Auth\Auth;
use PHPUnit\Framework\TestCase;

class AuthApiTest extends TestCase
{
    public function testGetAccessToken()
    {
        $auth = new Auth();

        $accessToken = $auth->getAccessToken('example_api_key');
        $this->assertIsString($accessToken);
    }
}
