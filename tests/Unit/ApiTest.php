<?php

namespace EFive\Bale\Tests\Unit;

use BadMethodCallException;
use EFive\Bale\Api;
use EFive\Bale\Exceptions\BaleSDKException;
use EFive\Bale\Tests\TestCase;

class ApiTest extends TestCase
{
    public function test_api_version_is_2_0_0(): void
    {
        $this->assertSame('2.0.0', Api::VERSION);
    }

    public function test_constructor_throws_exception_if_token_not_provided(): void
    {
        putenv(Api::BOT_TOKEN_ENV_NAME.'=');

        $this->expectException(BaleSDKException::class);
        new Api();
    }

    public function test_constructor_with_token(): void
    {
        $api = new Api('test_token_123456');

        $this->assertSame('test_token_123456', $api->getAccessToken());
        $this->assertFalse($api->isAsyncRequest());
    }

    public function test_constructor_with_async_flag(): void
    {
        $api = new Api('test_token_123456', true);

        $this->assertTrue($api->isAsyncRequest());
    }

    public function test_set_and_get_timeouts(): void
    {
        $api = new Api('test_token_123456');
        $api->setTimeOut(30);
        $api->setConnectTimeOut(10);

        $this->assertSame(30, $api->getTimeOut());
        $this->assertSame(10, $api->getConnectTimeOut());
    }

    public function test_magic_call_throws_bad_method_call_for_nonexistent_method(): void
    {
        $api = new Api('test_token_123456');

        $this->expectException(BadMethodCallException::class);
        $api->nonExistentMethod();
    }
}
