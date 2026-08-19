<?php

namespace EFive\Bale\Tests\Unit;

use EFive\Bale\Api;
use EFive\Bale\BotsManager;
use EFive\Bale\Exceptions\BaleBotNotFoundException;
use EFive\Bale\Tests\TestCase;

class BotsManagerTest extends TestCase
{
    public function test_manager_instantiates_default_bot(): void
    {
        $config = [
            'default' => 'bot1',
            'bots' => [
                'bot1' => [
                    'token' => 'token_for_bot_1',
                ],
                'bot2' => [
                    'token' => 'token_for_bot_2',
                ],
            ],
        ];

        $manager = new BotsManager($config);

        $defaultBot = $manager->bot();
        $this->assertInstanceOf(Api::class, $defaultBot);
        $this->assertSame('token_for_bot_1', $defaultBot->getAccessToken());

        $bot2 = $manager->bot('bot2');
        $this->assertInstanceOf(Api::class, $bot2);
        $this->assertSame('token_for_bot_2', $bot2->getAccessToken());
    }

    public function test_manager_throws_exception_if_bot_not_found(): void
    {
        $config = [
            'default' => 'bot1',
            'bots' => [
                'bot1' => ['token' => 'token_1'],
            ],
        ];

        $manager = new BotsManager($config);

        $this->expectException(BaleBotNotFoundException::class);
        $manager->bot('non_existent');
    }
}
