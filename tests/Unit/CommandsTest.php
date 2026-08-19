<?php

namespace EFive\Bale\Tests\Unit;

use EFive\Bale\Api;
use EFive\Bale\Commands\Command;
use EFive\Bale\Commands\HelpCommand;
use EFive\Bale\Objects\Update;
use EFive\Bale\Tests\TestCase;

class CommandsTest extends TestCase
{
    public function test_help_command_initialization(): void
    {
        $cmd = new HelpCommand();

        $this->assertSame('help', $cmd->getName());
        $this->assertNotEmpty($cmd->getDescription());
    }

    public function test_custom_command_creation(): void
    {
        $customCmd = new class extends Command {
            protected string $name = 'start';
            protected string $description = 'Start the bot';

            public function handle(): bool
            {
                return true;
            }
        };

        $this->assertSame('start', $customCmd->getName());
        $this->assertSame('Start the bot', $customCmd->getDescription());
    }

    public function test_api_registers_and_handles_commands(): void
    {
        $api = new Api('test_token_123');

        $executed = false;
        $customCmd = new class($executed) extends Command {
            public function __construct(private bool &$executed)
            {
            }

            protected string $name = 'ping';
            protected string $description = 'Ping command';

            public function handle(): bool
            {
                $this->executed = true;
                return true;
            }
        };

        $api->addCommand($customCmd);
        $commands = $api->getCommands();

        $this->assertArrayHasKey('ping', $commands);

        $update = new Update([
            'update_id' => 1,
            'message' => [
                'message_id' => 10,
                'date' => 1600000000,
                'text' => '/ping',
                'chat' => ['id' => 100, 'type' => 'private'],
                'entities' => [
                    ['type' => 'bot_command', 'offset' => 0, 'length' => 5],
                ],
            ],
        ]);

        $api->processCommand($update);
        $this->assertTrue($executed);
    }
}
