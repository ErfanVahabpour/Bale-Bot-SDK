<?php

namespace EFive\Bale\Traits;

use EFive\Bale\Exceptions\BaleSDKException;
use EFive\Bale\HttpClients\HttpClientInterface;
use EFive\Bale\BaleClient;
use EFive\Bale\BaleRequest;
use EFive\Bale\BaleResponse;

/**
 * Http.
 */
trait Http
{
    /** @var string Bale Bot API Access Token. */
    protected string $accessToken;

    /** @var BaleClient|null The Bale client service. */
    protected ?BaleClient $client = null;

    /** @var HttpClientInterface|null Http Client Handler */
    protected ?HttpClientInterface $httpClientHandler = null;

    /** @var string|null Base Bot Url */
    protected ?string $baseBotUrl = null;

    /** @var bool Indicates if the request to Bale will be asynchronous (non-blocking). */
    protected bool $isAsyncRequest = false;

    /** @var int Timeout of the request in seconds. */
    protected int $timeOut = 60;

    /** @var int Connection timeout of the request in seconds. */
    protected int $connectTimeOut = 10;

    /** @var BaleResponse|null Stores the last request made to Bale Bot API. */
    protected ?BaleResponse $lastResponse = null;

    /**
     * Sends a GET request to Bale Bot API and returns the result.
     *
     * @throws BaleSDKException
     */
    protected function get(string $endpoint, array $params = []): BaleResponse
    {
        $params = $this->replyMarkupToString($params);

        return $this->sendRequest('GET', $endpoint, $params);
    }

    /**
     * Sends a POST request to Bale Bot API and returns the result.
     *
     * @param  bool  $fileUpload  Set true if a file is being uploaded.
     *
     * @throws BaleSDKException
     */
    protected function post(string $endpoint, array $params = [], bool $fileUpload = false): BaleResponse
    {
        $params = $this->normalizeParams($params, $fileUpload);

        return $this->sendRequest('POST', $endpoint, $params);
    }

    private function normalizeParams(array $params, $fileUpload): array
    {
        if ($fileUpload) {
            return ['multipart' => $params];
        }

        return ['form_params' => $this->replyMarkupToString($params)];
    }

    /**
     * Converts a reply_markup field in the $params to a string.
     */
    protected function replyMarkupToString(array $params): array
    {
        if (isset($params['reply_markup']) && is_array($params['reply_markup'])) {
            $params['reply_markup'] = (string) json_encode($params['reply_markup']);
        }

        return $params;
    }

    /**
     * Sends a request to Bale Bot API and returns the result.
     *
     * @throws BaleSDKException
     */
    protected function sendRequest(string $method, string $endpoint, array $params = []): BaleResponse
    {
        $blaeRequest = $this->resolveBaleRequest($method, $endpoint, $params);

        return $this->lastResponse = $this->getClient()->sendRequest($blaeRequest);
    }

    /**
     * Instantiates a new BaleRequest entity.
     */
    protected function resolveBaleRequest(string $method, string $endpoint, array $params = []): BaleRequest
    {
        return (new BaleRequest(
            $this->getAccessToken(),
            $method,
            $endpoint,
            $params,
            $this->isAsyncRequest()
        ))
            ->setTimeOut($this->getTimeOut())
            ->setConnectTimeOut($this->getConnectTimeOut());
    }

    public function setBaseBotUrl(string $baseBotUrl): self
    {
        $this->baseBotUrl = rtrim($baseBotUrl, '/');

        return $this;
    }

    /**
     * Returns Bale Bot API Access Token.
     */
    public function getAccessToken(): string
    {
        return $this->accessToken;
    }

    /**
     * Sets the bot access token to use with API requests.
     *
     * @param  string  $accessToken  The bot access token to save.
     */
    public function setAccessToken(string $accessToken): self
    {
        $this->accessToken = $accessToken;

        return $this;
    }

    /**
     * Check if this is an asynchronous request (non-blocking).
     */
    public function isAsyncRequest(): bool
    {
        return $this->isAsyncRequest;
    }

    public function getTimeOut(): int
    {
        return $this->timeOut;
    }

    public function setTimeOut(int $timeOut): self
    {
        $this->timeOut = $timeOut;

        return $this;
    }

    public function getConnectTimeOut(): int
    {
        return $this->connectTimeOut;
    }

    public function setConnectTimeOut(int $connectTimeOut): self
    {
        $this->connectTimeOut = $connectTimeOut;

        return $this;
    }

    /**
     * Returns the BaleClient service.
     */
    public function getClient(): BaleClient
    {
        if ($this->client === null) {
            $this->client = new BaleClient($this->httpClientHandler, $this->baseBotUrl);
        }

        return $this->client;
    }
}