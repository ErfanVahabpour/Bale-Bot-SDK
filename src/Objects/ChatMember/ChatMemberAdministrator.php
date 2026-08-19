<?php

namespace EFive\Bale\Objects\ChatMember;

/**
 * Class ChatMemberAdministrator.
 *
 * @link https://docs.bale.ai/#chatmemberadministrator
 *
 * @property string $status The member's status in the chat, always "administrator".
 * @property bool $can_be_edited True, if the bot is allowed to edit administrator privileges of that user.
 * @property bool $is_anonymous True, if the user's presence in the chat is hidden.
 * @property bool|null $can_manage_chat (Optional). True, if the administrator can access the chat event log and other admin features.
 * @property bool|null $can_delete_messages (Optional). True, if the administrator can delete messages of other users.
 * @property bool|null $can_restrict_members (Optional). True, if the administrator can restrict, ban or unban chat members.
 * @property bool|null $can_promote_members (Optional). True, if the administrator can add new administrators.
 * @property bool|null $can_change_info (Optional). True, if the administrator can change chat title, photo and description.
 * @property bool|null $can_invite_users (Optional). True, if the administrator can invite new users to the chat.
 * @property bool|null $can_post_messages (Optional). True, if the administrator can post in the channel.
 * @property bool|null $can_edit_messages (Optional). True, if the administrator can edit messages of other users.
 * @property bool|null $can_pin_messages (Optional). True, if the administrator can pin messages.
 * @property string|null $custom_title (Optional). Custom title for this user.
 */
class ChatMemberAdministrator extends ChatMember
{
}
