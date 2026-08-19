<?php

namespace EFive\Bale\Objects\ChatMember;

/**
 * Class ChatMemberRestricted.
 *
 * @link https://docs.bale.ai/#chatmemberrestricted
 *
 * @property string $status The member's status in the chat, always "restricted".
 * @property bool $is_member True, if the user is a member of the chat at the moment of the request.
 * @property bool|null $can_send_messages (Optional). True, if the user is allowed to send text messages, contacts, locations and venues.
 * @property bool|null $can_send_media_messages (Optional). True, if the user is allowed to send audios, documents, photos, videos, video notes and voice notes.
 * @property bool|null $can_send_polls (Optional). True, if the user is allowed to send polls.
 * @property bool|null $can_send_other_messages (Optional). True, if the user is allowed to send animations, games, stickers and use inline bots.
 * @property bool|null $can_add_web_page_previews (Optional). True, if the user is allowed to add web page previews to their messages.
 * @property bool|null $can_change_info (Optional). True, if the user is allowed to change the chat title, photo and other settings.
 * @property bool|null $can_invite_users (Optional). True, if the user is allowed to invite new users to the chat.
 * @property bool|null $can_pin_messages (Optional). True, if the user is allowed to pin messages.
 * @property int|null $until_date (Optional). Date when restrictions will be lifted for this user; unix time.
 */
class ChatMemberRestricted extends ChatMember
{
}
