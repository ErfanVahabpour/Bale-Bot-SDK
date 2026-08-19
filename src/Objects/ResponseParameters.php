<?php

namespace EFive\Bale\Objects;

/**
 * Class ResponseParameters.
 *
 * @link https://docs.bale.ai/#responseparameters
 *
 * @property int|null $migrate_to_chat_id (Optional). The group has been migrated to a supergroup with the specified identifier.
 * @property int|null $retry_after (Optional). In case of exceeding flood control, the number of seconds left to wait before the request can be repeated.
 */
class ResponseParameters extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }
}
