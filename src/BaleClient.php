<?php

namespace EFive\Bale;

use GuzzleHttp\Promise\PromiseInterface;
use Psr\Http\Message\ResponseInterface;
use EFive\Bale\Exceptions\BaleSDKException;
use EFive\Bale\HttpClients\GuzzleHttpClient;
use EFive\Bale\HttpClients\HttpClientInterface;

final class BaleClient
{
    public const BASE_BOT_URL = 'https://tapi.bale.ai/bot';

    private string $fileUrl = '{BASE_BOT_URL}/file/bot{TOKEN}/{FILE_PATH}';

    private HttpClientInterface $httpClientHandler;

    private string $baseBotUrl;

    public function __construct(?HttpClientInterface $httpClientHandler = null, ?string $baseBotUrl = null)
    {
        $this->httpClientHandler = $httpClientHandler ?? new GuzzleHttpClient();

        $this->baseBotUrl = $baseBotUrl ?? self::BASE_BOT_URL;
    }

    public function getHttpClientHandler(): HttpClientInterface
    {
        return $this->httpClientHandler ?? new GuzzleHttpClient();
    }

    public function setHttpClientHandler(HttpClientInterface $httpClientHandler): self
    {
        $this->httpClientHandler = $httpClientHandler;

        return $this;
    }

    public function sendRequest(BaleRequest $request): BaleResponse
    {
        [$url, $method, $headers, $isAsyncRequest] = $this->prepareRequest($request);
        $options = $this->getOptions($request, $method);

        $rawResponse = $this->httpClientHandler
            ->setTimeOut($request->getTimeOut())
            ->setConnectTimeOut($request->getConnectTimeOut())
            ->send($url, $method, $headers, $options, $isAsyncRequest);

        $response = $this->getResponse($request, $rawResponse);

        if ($response->isError()) {
            throw $response->getThrownException();
        }

        return $response;
    }

    /**
     * Get File URL.
     */
    public function getFileUrl(string $path, BaleRequest $request): string
    {
        $baseFileUrl = str_replace('/bot', '', $this->baseBotUrl);

        return str_replace(
            ['{BASE_BOT_URL}', '{TOKEN}', '{FILE_PATH}'],
            [$baseFileUrl, $request->getAccessToken(), $path],
            $this->fileUrl
        );
    }

    /**
     * Download file from Bale server for given file path.
     *
     * @param  string  $filePath  File path on Bale server.
     * @param  string  $filename  Download path to save file.
     *
     * @throws BaleSDKException
     */
    public function download(string $filePath, string $filename, BaleRequest $request): string
    {
        $fileDir = dirname($filename);

        // Ensure dir is created.
        if (! @mkdir($fileDir, 0755, true) && ! is_dir($fileDir)) {
            throw BaleSDKException::fileDownloadFailed('Directory '.$fileDir.' can\'t be created');
        }

        $response = $this->httpClientHandler
            ->setTimeOut($request->getTimeOut())
            ->setConnectTimeOut($request->getConnectTimeOut())
            ->send(
                $url = $this->getFileUrl($filePath, $request),
                $request->getMethod(),
                $request->getHeaders(),
                ['sink' => $filename],
                $request->isAsyncRequest()
            );

        if ($response->getStatusCode() !== 200) {
            throw BaleSDKException::fileDownloadFailed($response->getReasonPhrase(), $url);
        }

        return $filename;
    }

    public function prepareRequest(BaleRequest $request): array
    {
        $url = $this->baseBotUrl.$request->getAccessToken().'/'.$request->getEndpoint();

        return [$url, $request->getMethod(), $request->getHeaders(), $request->isAsyncRequest()];
    }

    public function getBaseBotUrl(): string
    {
        return $this->baseBotUrl;
    }

    private function getResponse(BaleRequest $request, ResponseInterface|PromiseInterface|null $response): BaleResponse
    {
        return new BaleResponse($request, $response);
    }

    private function getOptions(BaleRequest $request, string $method): array
    {
        return $method === 'POST' ? $request->getPostParams() : ['query' => $request->getParams()];
    }
}