<?php

namespace EFive\Bale;

use Illuminate\Support\Arr;
use Psr\Container\ContainerInterface;
use EFive\Bale\Exceptions\BaleBotNotFoundException;
use EFive\Bale\Exceptions\BaleSDKException;

/**
 * Class BotsManager.
 *
 * @mixin Api
 */
final class BotsManager
{
    private ?ContainerInterface $container = null;

    /** @var array<string, Api> The active bot instances. */
    private array $bots = [];

    /**
     * BaleManager constructor.
     */
    public function __construct(private array $config)
    {
    }

    /**
     * Set the IoC Container.
     *
     * @param  ContainerInterface  $container  Container instance
     */
    public function setContainer(ContainerInterface $container): self
    {
        $this->container = $container;

        return $this;
    }

    /**
     * Get the configuration for a bot.
     *
     *
     * @throws BaleBotNotFoundException
     */
    public function getBotConfig(?string $name = null): array
    {
        $name ??= $this->getDefaultBotName();

        $bots = collect($this->getConfig('bots'));

        $config = $bots->get($name);

        if (! $config) {
            throw BaleBotNotFoundException::create($name);
        }

        return $config + ['bot' => $name];
    }

    /**
     * Get a bot instance.
     *
     *
     * @throws BaleSDKException
     */
    public function bot(?string $name = null): Api
    {
        $name ??= $this->getDefaultBotName();

        if (! isset($this->bots[$name])) {
            $this->bots[$name] = $this->makeBot($name);
        }

        return $this->bots[$name];
    }

    /**
     * Reconnect to the given bot.
     *
     *
     * @throws BaleSDKException
     */
    public function reconnect(?string $name = null): Api
    {
        $name ??= $this->getDefaultBotName();
        $this->disconnect($name);

        return $this->bot($name);
    }

    /**
     * Disconnect from the given bot.
     */
    public function disconnect(?string $name = null): self
    {
        $name ??= $this->getDefaultBotName();
        unset($this->bots[$name]);

        return $this;
    }

    /**
     * Determine if given bot name exists.
     */
    public function hasBot(string $name): bool
    {
        return isset($this->bots[$name]);
    }

    /**
     * Get the specified configuration value for Bale.
     */
    public function getConfig(string $key, mixed $default = null): mixed
    {
        return data_get($this->config, $key, $default);
    }

    /**
     * Get the default bot name.
     */
    public function getDefaultBotName(): ?string
    {
        return $this->getConfig('default');
    }

    /**
     * Set the default bot name.
     */
    public function setDefaultBot(string $name): self
    {
        Arr::set($this->config, 'default', $name);

        return $this;
    }

    /**
     * Return all the created bots.
     *
     * @return array<string, Api>
     */
    public function getBots(): array
    {
        return $this->bots;
    }

    /**
     * Make the bot instance.
     *
     *
     * @throws BaleSDKException
     */
    protected function makeBot(string $name): Api
    {
        $config = $this->getBotConfig($name);

        $token = data_get($config, 'token');

        $bale = new Api(
            $token,
            $this->getConfig('async_requests', false),
            $this->getConfig('http_client_handler', null),
            $this->getConfig('base_bot_url', null)
        );

        return $bale;
    }

    /**
     * Magically pass methods to the default bot.
     *
     * @return mixed
     *
     * @throws BaleSDKException
     */
    public function __call(string $method, array $parameters)
    {
        return $this->bot()->$method(...$parameters);
    }
}