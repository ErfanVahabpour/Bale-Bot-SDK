<?php

namespace EFive\Bale\Objects;

/**
 * Class WebhookInfo.
 *
 * Contains information about the current status of a webhook.
 *
 * @link https://docs.bale.ai/#webhookinfo
 *
 * @property string $url Webhook URL, may be empty if webhook is not set up
 */
class WebhookInfo extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }
}