<?php

namespace EFive\Bale\Objects;

use EFive\Bale\Objects\ChatPhoto;

/**
 * Class Chat.
 *
 * @link https://docs.bale.ai/#chat
 *
 * @property int $id Unique identifier for this chat, not exceeding 1e13 by absolute value.
 * @property string $type Type of chat, can be either 'private', 'group' or 'channel'.
 * @property string|null $title (Optional). Title, for channels and group chats.
 * @property string|null $username (Optional). Username, for private chats and channels if available
 * @property string|null $firstName (Optional). First name of the other party in a private chat
 * @property string|null $lastName (Optional). Last name of the other party in a private chat
 * @property InputMedia|null $photo (Optional). Chat photo. Returned only in getChat.
 */
class Chat extends BaseObject
{
    /**
     * {@inheritdoc}
     *
     * @return array{photo: array}
     */
    public function relations(): array
    {
        return [
            'photo' => ChatPhoto::class
        ];
    }
}