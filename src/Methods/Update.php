<?php

namespace EFive\Bale\Methods;

use Psr\Http\Message\RequestInterface;
use EFive\Bale\Events\UpdateEvent;
use EFive\Bale\Events\UpdateWasReceived;
use EFive\Bale\Exceptions\BaleSDKException;
use EFive\Bale\Objects\Update as UpdateObject;
use EFive\Bale\Objects\WebhookInfo;
use EFive\Bale\Traits\Http;

/**
 * Class Update.
 *
 * @mixin Http
 */
trait Update
{
    /**
     * Use this method to receive incoming updates using long polling.
     *
     * <code>
     * $params = [
     *   'offset'  => '',
     *   'limit'   => '',
     * ];
     * </code>
     *
     * @link https://docs.bale.ai/#getupdates
     *
     * @param  array  $params  [
     *
     * @var int Optional. Identifier of the first update to be returned. Must be greater by one than the highest among the identifiers of previously received updates. By default, updates starting with the earliest unconfirmed update are returned. An update is considered confirmed as soon as getUpdates is called with an offset higher than its update_id. The negative offset can be specified to retrieve updates starting from -offset update from the end of the updates queue. All previous updates will forgotten.
     * @var int Optional. Limits the number of updates to be retrieved. Values between 1—100 are accepted. Defaults to 100.
     *
     * ]
     *
     * @return UpdateObject[]
     *
     * @throws BaleSDKException
     */
    public function getUpdates(array $params = [], bool $shouldDispatchEvents = true): array
    {
        $response = $this->get('getUpdates', $params);

        return collect($response->getResult())
            ->map(function ($data) use ($shouldDispatchEvents): UpdateObject {
                $update = new UpdateObject($data);

                if ($shouldDispatchEvents) {
                    $this->dispatchUpdateEvent($update);
                }

                return $update;
            })
            ->all();
    }

    /**
     * Set a Webhook to receive incoming updates via an outgoing webhook.
     *
     * <code>
     * $params = [
     *   'url'         => '',
     * ];
     * </code>
     *
     * @link https://docs.bale.ai/#setwebhook
     *
     * @param  array  $params  [
     *
     * @var string Required. HTTPS url to send updates to. Use an empty string to remove webhook integration
     *
     * ]
     *
     * @throws BaleSDKException
     */
    public function setWebhook(array $params): bool
    {
        $this->validateHookUrl($params['url']);

        return $this->post('setWebhook', $params)->getResult();
    }

    /**
     * remove webhook.
     *
     *
     * @link https://docs.bale.ai/#removeWebhook
     *
     *
     * @throws BaleSDKException
     */
    public function removeWebhook(): bool
    {
        return $this->post('setWebhook', ['url' => ""])->getResult();
    }

    /**
     * Get current webhook status.
     *
     * @link https://docs.bale.ai/#getwebhookinfo
     *
     * @throws BaleSDKException
     */
    public function getWebhookInfo(): WebhookInfo
    {
        $response = $this->get('getWebhookInfo');

        return new WebhookInfo($response->getDecodedBody());
    }

    /**
     * Alias for getWebhookUpdate.
     */
    public function getWebhookUpdates(bool $shouldDispatchEvents = true): UpdateObject
    {
        return $this->getWebhookUpdate($shouldDispatchEvents);
    }

    /**
     * Returns a webhook update sent by Bale.
     * Works only if you set a webhook.
     *
     * @see setWebhook
     */
    public function getWebhookUpdate(bool $shouldDispatchEvents = true, ?RequestInterface $request = null): UpdateObject
    {
        $body = $this->getRequestBody($request);

        $update = new UpdateObject($body);

        if ($shouldDispatchEvents) {
            $this->dispatchUpdateEvent($update);
        }

        return $update;
    }

    private function getRequestBody(?RequestInterface $request): mixed
    {
        $rawBody = $request instanceof RequestInterface ? (string) $request->getBody() : file_get_contents('php://input');

        return json_decode($rawBody, true);
    }

    /**
     * @throws BaleSDKException
     */
    private function validateHookUrl(string $url): void
    {
        if (filter_var($url, FILTER_VALIDATE_URL) === false) {
            throw new BaleSDKException('Invalid URL Provided');
        }

        if (parse_url($url, PHP_URL_SCHEME) !== 'https') {
            throw new BaleSDKException('Invalid URL, should be a HTTPS url.');
        }
    }

    /** Dispatch Update Event. */
    protected function dispatchUpdateEvent(UpdateObject $update): void
    {
        if (! $this->hasEventDispatcher()) {
            return;
        }

        $dispatcher = $this->eventDispatcher();

        $dispatcher->dispatch(new UpdateWasReceived($this, $update));
        $dispatcher->dispatch(new UpdateEvent($this, $update));

        $updateType = $update->objectType();
        if (is_string($updateType)) {
            $dispatcher->dispatch(new UpdateEvent($this, $update, $updateType));

            if (method_exists($update->getMessage(), 'objectType')) {
                $messageType = $update->getMessage()->objectType();

                if ($messageType !== null) {
                    $dispatcher->dispatch(new UpdateEvent($this, $update, sprintf('%s.%s', $updateType, $messageType)));
                }
            }
        }
    }
}