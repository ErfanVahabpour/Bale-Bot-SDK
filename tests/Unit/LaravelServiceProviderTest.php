<?php

namespace EFive\Bale\Tests\Unit;

use EFive\Bale\Api;
use EFive\Bale\BotsManager;
use EFive\Bale\Laravel\BaleServiceProvider;
use EFive\Bale\Laravel\Facades\Bale;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

class LaravelServiceProviderTest extends OrchestraTestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            BaleServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app): array
    {
        return [
            'Bale' => Bale::class,
        ];
    }

    protected function defineEnvironment($app): void
    {
        $app['config']->set('bale.default', 'mybot');
        $app['config']->set('bale.bots.mybot', [
            'token' => '123456:abcdef',
        ]);
    }

    public function test_service_provider_registers_bindings(): void
    {
        $manager = $this->app->make(BotsManager::class);
        $this->assertInstanceOf(BotsManager::class, $manager);

        $api = $this->app->make(Api::class);
        $this->assertInstanceOf(Api::class, $api);
        $this->assertSame('123456:abcdef', $api->getAccessToken());
    }

    public function test_facade_resolves_bots_manager(): void
    {
        $bot = Bale::bot('mybot');

        $this->assertInstanceOf(Api::class, $bot);
        $this->assertSame('123456:abcdef', $bot->getAccessToken());
    }
}
