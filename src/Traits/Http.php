<?php

namespace EFive\Bale\Traits;

use InvalidArgumentException;
use EFive\Bale\Exceptions\CouldNotUploadInputFile;
use EFive\Bale\Exceptions\BaleSDKException;
use EFive\Bale\FileUpload\InputFile;
use EFive\Bale\HttpClients\HttpClientInterface;
use EFive\Bale\Objects\BaseObject;
use EFive\Bale\Objects\File;
use EFive\Bale\BaleClient;
use EFive\Bale\BaleRequest;
use EFive\Bale\BaleResponse;

/**
 * Http.
 */
trait Http
{
    use Validator;

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
     * Make this request asynchronous (non-blocking).
     */
    public function setAsyncRequest(bool $isAsyncRequest): self
    {
        $this->isAsyncRequest = $isAsyncRequest;

        return $this;
    }

    public function setHttpClientHandler(HttpClientInterface $httpClientHandler): self
    {
        $this->httpClientHandler = $httpClientHandler;

        return $this;
    }

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
     * Returns the last response returned from API request.
     */
    public function getLastResponse(): ?BaleResponse
    {
        return $this->lastResponse;
    }

    /**
     * Download a file from Bale server by file ID.
     *
     * @param  File|BaseObject|string  $file  Bale File Instance / File Response Object or File ID.
     * @param  string  $filename  Absolute path to dir or filename to save as.
     *
     * @throws BaleSDKException
     */
    public function downloadFile(File|BaseObject|string $file, string $filename): string
    {
        $originalFilename = null;
        if (! $file instanceof File) {
            if ($file instanceof BaseObject) {
                $originalFilename = $file->get('file_name');

                // Try to get file_id from the object or default to the original param.
                $file = $file->get('file_id', $file);
            }

            if (! is_string($file)) {
                throw new InvalidArgumentException(
                    'Invalid $file param provided. Please provide one of file_id, File or Response object containing file_id'
                );
            }

            $file = $this->getFile(['file_id' => $file]);
        }

        // No filename provided.
        if (pathinfo($filename, PATHINFO_EXTENSION) === '') {
            // Attempt to use the original file name if there is one or fallback to the file_path filename.
            $filename .= DIRECTORY_SEPARATOR.($originalFilename ?: basename($file->file_path));
        }

        $baleRequest = $this->resolveBaleRequest('GET', '');

        return $this->getClient()->download($file->file_path, $filename, $baleRequest);
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

    /**
     * Sends a multipart/form-data request to Bale Bot API and returns the result.
     * Used primarily for file uploads.
     *
     *
     * @throws CouldNotUploadInputFile
     * @throws BaleSDKException
     */
    protected function uploadFile(string $endpoint, array $params, string $inputFileField): BaleResponse
    {
        //Check if the field in the $params array (that is being used to send the relative file), is a file id.
        if (! isset($params[$inputFileField])) {
            throw CouldNotUploadInputFile::missingParam($inputFileField);
        }

        $params = $this->replyMarkupToString($params);

        if ($this->hasFileId($inputFileField, $params)) {
            return $this->post($endpoint, $params);
        }

        //Sending an actual file requires it to be sent using multipart/form-data
        return $this->post($endpoint, $this->prepareMultipartParams($params, $inputFileField), true);
    }

    /**
     * Prepare Multipart Params for File Upload.
     *
     *
     * @throws CouldNotUploadInputFile
     */
    protected function prepareMultipartParams(array $params, string $inputFileField): array
    {
        $this->validateInputFileField($params, $inputFileField);

        //Iterate through all param options and convert to multipart/form-data.
        return collect($params)
            ->reject(static fn ($value): bool => $value === null)
            ->map(fn ($contents, $name) => $this->generateMultipartData($contents, $name))
            ->values()
            ->all();
    }

    /**
     * @throws CouldNotUploadInputFile
     */
    protected function validateInputFileField(array $params, $inputFileField): void
    {
        if (! isset($params[$inputFileField])) {
            throw CouldNotUploadInputFile::missingParam($inputFileField);
        }

        // All file-paths, urls, or file resources should be provided by using the InputFile object
        if ($params[$inputFileField] instanceof InputFile) {
            return;
        }

        if (! (is_string($params[$inputFileField]) && ! $this->is_json($params[$inputFileField]))) {
            return;
        }

        throw CouldNotUploadInputFile::inputFileParameterShouldBeInputFileEntity($inputFileField);
    }

    /**
     * Generates the multipart data required when sending files to bale.
     */
    protected function generateMultipartData(mixed $contents, string $name): array
    {
        if (! $this->isInputFile($contents)) {
            return ['name' => $name, 'contents' => $contents];
        }

        $filename = $contents->getFilename();
        $contents = $contents->getContents();

        return ['name' => $name, 'contents' => $contents, 'filename' => $filename];
    }
}