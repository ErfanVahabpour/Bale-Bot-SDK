<?php

namespace EFive\Bale\Objects;

/**
 * Class CallbackQuery.
 *
 * @link https://docs.bale.ai/#callbackquery
 *
 * @property int $id Unique message identifier.
 * @property User $from Sender.
 * @property Message|null $message (Optional). Message with the callback button that originated the query. Note that message content and message date will not be available if the message is too old.
 * @property string|null $data (Optional). Data associated with the callback button. Be aware that a bad client can send arbitrary data in this field.
 */
class CallbackQuery extends BaseObject
{
    /**
     * {@inheritdoc}
     *
     * @return array{from: string, message: string}
     */
    public function relations(): array
    {
        return [
            'from' => User::class,
            'message' => Message::class,
        ];
    }
}