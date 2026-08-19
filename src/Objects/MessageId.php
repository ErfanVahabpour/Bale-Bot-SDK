<?php

namespace EFive\Bale\Objects;

/**
 * Class MessageId.
 *
 * @link https://docs.bale.ai/#messageid
 *
 * @property int $message_id Unique message identifier.
 */
class MessageId extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }
}
