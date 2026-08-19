<?php

namespace EFive\Bale\Objects\ChatMember;

/**
 * Class ChatMemberOwner.
 *
 * @link https://docs.bale.ai/#chatmemberowner
 *
 * @property string $status The member's status in the chat, always "creator".
 * @property bool $is_anonymous True, if the user's presence in the chat is hidden.
 * @property string|null $custom_title (Optional). Custom title for this user.
 */
class ChatMemberOwner extends ChatMember
{
}
