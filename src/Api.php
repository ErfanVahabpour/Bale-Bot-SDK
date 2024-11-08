<?php

namespace EFive\Bale;

use BadMethodCallException;
use EFive\Bale\Events\HasEventDispatcher;
use EFive\Bale\Exceptions\BaleSDKException;
use EFive\Bale\HttpClients\HttpClientInterface;
use EFive\Bale\Methods\Chat;
use EFive\Bale\Methods\EditMessage;
use EFive\Bale\Methods\Get;
use EFive\Bale\Methods\Location;
use EFive\Bale\Methods\Message;
use EFive\Bale\Methods\Payments;
use EFive\Bale\Methods\Stickers;
use EFive\Bale\Methods\Update;
use EFive\Bale\Traits\Http;

class Api
{
    use HasEventDispatcher;
    use Chat;
    use EditMessage;
    use Get;
    use Location;
    use Message;
    use Payments;
    use Stickers;
    use Update;
    use Http;

    /** @var string Version number of the Bale Bot PHP SDK. */
    public const VERSION = '1.0.0';

    /** @var string The name of the environment variable that contains the Bale Bot API Access Token. */
    public const BOT_TOKEN_ENV_NAME = 'BALE_BOT_TOKEN';

    /**
     * Instantiates a new Bale super-class object.
     *
     *
     * @param  string|null  $token  The Bale Bot API Access Token.
     * @param  string|null  $baseBotUrl  (Optional) Custom base bot url.
     * @param  HttpClientInterface|null  $httpClientHandler  (Optional) Custom HTTP Client Handler.
     * @param  string|null  $baseBotUrl  (Optional) Custom base bot url.
     *
     * @throws BaleSDKException
     */
    public function __construct(?string $token = null, bool $async = false, ?HttpClientInterface $httpClientHandler = null, ?string $baseBotUrl = null)
    {
        $this->setAccessToken($token ?? getenv(self::BOT_TOKEN_ENV_NAME));
        $this->validateAccessToken();

        if ($async) {
            $this->setAsyncRequest($async);
        }

        $this->httpClientHandler = $httpClientHandler;

        $this->baseBotUrl = $baseBotUrl;
    }

    /**
     * @throws BaleSDKException
     */
    private function validateAccessToken(): void
    {
        if ($this->getAccessToken() === '' || $this->getAccessToken() === '0') {
            throw BaleSDKException::tokenNotProvided(self::BOT_TOKEN_ENV_NAME);
        }
    }

    /**
     * Magic method to process any dynamic method calls.
     *
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        if (method_exists($this, $method)) {
            return $this->$method(...$parameters);
        }

        // If the method does not exist on the API, try the commandBus.
        if (preg_match('#^\w+Commands?#', $method, $matches)) {
            return $this->getCommandBus()->{$matches[0]}(...$parameters);
        }

        throw new BadMethodCallException(sprintf('Method [%s] does not exist.', $method));
    }
}