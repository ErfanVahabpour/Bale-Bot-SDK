<?php

namespace EFive\Bale\Objects;

/**
 * Class ChatFullInfo.
 *
 * @link https://docs.bale.ai/#chatfullinfo
 *
 * @property int $id Unique identifier for this chat.
 * @property string $type Type of chat, can be either 'private', 'group' or 'channel'.
 * @property string|null $title (Optional). Title, for channels and group chats.
 * @property string|null $username (Optional). Username, for private chats and channels if available.
 * @property string|null $first_name (Optional). First name of the other party in a private chat.
 * @property string|null $last_name (Optional). Last name of the other party in a private chat.
 * @property ChatPhoto|null $photo (Optional). Chat photo.
 * @property string|null $description (Optional). Description, for groups, supergroups and channel chats.
 * @property string|null $invite_link (Optional). Primary invite link, for groups, supergroups and channel chats.
 * @property int|null $member_count (Optional). Number of members in the chat.
 */
class ChatFullInfo extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'photo' => ChatPhoto::class,
        ];
    }
}
