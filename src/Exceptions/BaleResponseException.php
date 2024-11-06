<?php

namespace EFive\Bale\Exceptions;

use EFive\Bale\BaleResponse;

/**
 * Class BaleResponseException.
 */
final class BaleResponseException extends BaleSDKException
{
    /** @var array Decoded response. */
    private array $responseData = [];

    /**
     * Creates a BaleResponseException.
     *
     * @param  BaleResponse  $response  The response that threw the exception.
     * @param  BaleSDKException|null  $previousException  The more detailed exception.
     */
    public function __construct(private BaleResponse $response, ?BaleSDKException $previousException = null)
    {
        $this->responseData = $response->getDecodedBody();

        $errorMessage = $this->get('description', 'Unknown error from API Response.');
        $errorCode = $this->get('error_code', -1);

        parent::__construct($errorMessage, $errorCode, $previousException);
    }

    /**
     * Checks isset and returns that or a default value.
     *
     * @param  string  $key
     * @return mixed
     */
    public function get($key, mixed $default = null)
    {
        return $this->responseData[$key] ?? $default;
    }

    /**
     * A factory for creating the appropriate exception based on the response from Bale.
     *
     * @param  BaleResponse  $response  The response that threw the exception.
     */
    public static function create(BaleResponse $response): self
    {
        $data = $response->getDecodedBody();

        $code = null;
        $message = null;
        if (isset($data['ok'], $data['error_code']) && $data['ok'] === false) {
            $code = $data['error_code'];
            $message = $data['description'] ?? 'Unknown error from API.';
        }

        // Others
        return new self($response, new BaleOtherException($message, $code));
    }

    /**
     * Returns the HTTP status code.
     */
    public function getHttpStatusCode(): ?int
    {
        return $this->response->getHttpStatusCode();
    }

    /**
     * Returns the error type.
     */
    public function getErrorType(): string
    {
        return $this->get('type', '');
    }

    /**
     * Returns the raw response used to create the exception.
     */
    public function getRawResponse(): string
    {
        return $this->response->getBody();
    }

    /**
     * Returns the decoded response used to create the exception.
     */
    public function getResponseData(): array
    {
        return $this->responseData;
    }

    /**
     * Returns the response entity used to create the exception.
     */
    public function getResponse(): BaleResponse
    {
        return $this->response;
    }
}