<?php

declare(strict_types=1);

namespace EFive\Bale\Commands;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use InvalidArgumentException;
use EFive\Bale\Answers\AnswerBus;
use EFive\Bale\Api;
use EFive\Bale\Exceptions\BaleSDKException;
use EFive\Bale\Objects\MessageEntity;
use EFive\Bale\Objects\Update;

/**
 * Class CommandBus.
 */
class CommandBus extends AnswerBus
{
    /**
     * @var array<string, Command> Holds all commands. Keys are command names (without leading slashes).
     */
    private array $commands = [];

    /**
     * @var array<string, Command> Holds all commands' aliases. Keys are command names (without leading slashes).
     */
    private array $commandAliases = [];

    /**
     * Instantiate Command Bus.
     */
    public function __construct(?Api $bale = null)
    {
        $this->bale = $bale;
    }

    /**
     * Returns the list of commands.
     *
     * @return array<string, Command>
     */
    public function getCommands(): array
    {
        return $this->commands;
    }

    /**
     * Add a list of commands.
     *
     * @param  iterable<CommandInterface|class-string<CommandInterface>>  $commands
     *
     * @throws BaleSDKException
     */
    public function addCommands(iterable $commands): self
    {
        foreach ($commands as $command) {
            $this->addCommand($command);
        }

        return $this;
    }

    /**
     * Add a command to the commands list.
     *
     * @param  CommandInterface|class-string<CommandInterface>  $command  Either an object or fully qualified class name (FQCN) of the command class.
     *
     * @throws BaleSDKException
     */
    public function addCommand(CommandInterface|string $command): self
    {
        $command = $this->resolveCommand($command);

        /*
         * At this stage we definitely have a proper command to use.
         *
         * @var Command $command
         */
        $this->commands[$command->getName()] = $command;

        foreach ($command->getAliases() as $alias) {
            $this->checkForConflicts($command, $alias);
            $this->commandAliases[$alias] = $command;
        }

        return $this;
    }

    /**
     * Remove a command from the list.
     *
     * @param  string  $name  Command's name without leading slash
     */
    public function removeCommand(string $name): self
    {
        unset($this->commands[$name]);

        return $this;
    }

    /**
     * Removes a list of commands.
     *
     * @param  list<string>  $names  Command names
     */
    public function removeCommands(array $names): self
    {
        foreach ($names as $name) {
            $this->removeCommand($name);
        }

        return $this;
    }

    /**
     * Parse a Command for a Match.
     *
     * @param  string  $text  Command name with a leading slash
     * @return string Bale command name (without leading slash)
     */
    protected function parseCommand(string $text, int $offset, int $length): string
    {
        if (trim($text) === '') {
            throw new InvalidArgumentException('Message is empty, Cannot parse for command');
        }

        // remove leading slash
        $command = substr(
            $text,
            $offset + 1,
            $length - 1
        );

        // When in group - Ex: /command@MyBot. Just get the command name.
        return Str::of($command)->explode('@')->first();
    }

    /**
     * Handles Inbound Messages and Executes Appropriate Command.
     */
    protected function handler(Update $update): Update
    {
        $message = $update->getMessage();
        $text = $message->get('text');

        // Check if the message starts with a '/' to identify a bot command
        if ($text && strpos($text, '/') === 0) {
            // Process the command
            $this->processCommand($text, $update);
        }

        return $update;
    }

    /**
     * Execute the bot command from the message text.
     */
    private function processCommand(string $text, Update $update): void
    {
        // Split the text into command and arguments
        $parts = explode(' ', trim($text));  // Split by spaces
        $command = substr(array_shift($parts), 1); // Remove the '/' from the command
        $arguments = $parts; // Remaining parts are arguments

        // Execute the command with arguments
        $this->execute($command, $update, $arguments);
    }

    /**
     * Returns all bot_commands detected in the update.
     */
    private function parseCommandsIn(Collection $message): Collection
    {
        return Collection::wrap($message->get('entities'))
            ->filter(static fn (MessageEntity $entity): bool => $entity->type === 'bot_command');
    }

    /**
     * Execute a bot command from the update text.
     *
     * @param  array<string, mixed>  $entity  {@see MessageEntity} object attributes.
     */
    private function process(array $entity, Update $update): void
    {
        $command = $this->parseCommand(
            $update->getMessage()->text,
            $entity['offset'],
            $entity['length']
        );

        $this->execute($command, $update, $entity);
    }

    /**
     * Execute the command.
     *
     * @param  string  $name  Bale command name without leading slash
     * @param  array<string, mixed>  $entity
     */
    protected function execute(string $name, Update $update, array $entity): mixed
    {
        $command = $this->commands[$name]
            ?? $this->commandAliases[$name]
            ?? $this->commands['help']
            ?? collect($this->commands)->first(fn ($command): bool => $command instanceof $name);

        return $command?->make($this->bale, $update, $entity) ?? false;
    }

    /**
     * @param  CommandInterface|class-string<CommandInterface>  $command
     *
     * @throws BaleSDKException
     */
    private function resolveCommand(CommandInterface|string $command): CommandInterface
    {
        if (! is_a($command, CommandInterface::class, true)) {
            throw new BaleSDKException(
                sprintf(
                    'Command class "%s" should be an instance of "%s"',
                    is_object($command) ? $command::class : $command,
                    CommandInterface::class
                )
            );
        }

        $commandInstance = $this->buildDependencyInjectedClass($command);

        if ($commandInstance instanceof Command && $this->bale) {
            $commandInstance->setBale($this->getBale());
        }

        return $commandInstance;
    }

    /**
     * @throws BaleSDKException
     */
    private function checkForConflicts(CommandInterface $command, string $alias): void
    {
        if (isset($this->commands[$alias])) {
            throw new BaleSDKException(
                sprintf(
                    '[Error] Alias [%s] conflicts with command name of "%s" try with another name or remove this alias from the list.',
                    $alias,
                    $command::class
                )
            );
        }

        if (isset($this->commandAliases[$alias])) {
            throw new BaleSDKException(
                sprintf(
                    '[Error] Alias [%s] conflicts with another command\'s alias list: "%s", try with another name or remove this alias from the list.',
                    $alias,
                    $command::class
                )
            );
        }
    }
}