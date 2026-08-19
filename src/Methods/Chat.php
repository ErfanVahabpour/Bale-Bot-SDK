<?php

namespace EFive\Bale\Methods;

use EFive\Bale\Exceptions\BaleSDKException;
use EFive\Bale\Objects\ChatFullInfo;
use EFive\Bale\Objects\ChatMember\ChatMember;
use EFive\Bale\Traits\Http;

/**
 * Class Chat.
 *
 * @mixin Http
 */
trait Chat
{
    /**
     * Ban a user in a group, a supergroup or a channel.
     *
     * In the case of supergroups, the user will not be able to return to the group on their own using
     * invite links etc., unless unbanned first.
     *
     * The bot must be an administrator in the group for this to work.
     *
     * <code>
     * $params = [
     *      'chat_id'         => '',  // int|string - Required. Unique identifier for the target group or username of the target supergroup (in the format "@supergroupusername")
     *      'user_id'         => '',  // int        - Required. Unique identifier of the target user.
     *      'until_date'      => '',  // int        - (Optional). Date when the user will be unbanned; unix time.
     * ]
     * </code>
     *
     * @link https://docs.bale.ai/#banchatmember
     *
     * @throws BaleSDKException
     */
    public function banChatMember(array $params): bool
    {
        return $this->post('banChatMember', $params)->getResult();
    }

    /**
     * Unban a previously banned user in a supergroup or channel.
     *
     * The bot must be an administrator for this to work.
     *
     * <code>
     * $params = [
     *      'chat_id'         => '',  // int|string - Required. Unique identifier for the target group or username of the target supergroup (in the format "@supergroupusername")
     *      'user_id'         => '',  // int        - Required. Unique identifier of the target user.
     *      'only_if_banned'  => '',  // bool       - (Optional). Do nothing if the user is not banned.
     * ]
     * </code>
     *
     * @link https://docs.bale.ai/#unbanchatmember
     *
     * @throws BaleSDKException
     */
    public function unbanChatMember(array $params): bool
    {
        return $this->post('unbanChatMember', $params)->getResult();
    }

    /**
     * Promote or demote a user in a supergroup or a channel.
     *
     * The bot must be an administrator in the chat for this to work and must have the appropriate admin rights.
     *
     * <code>
     * $params = [
     *      'chat_id'              => '',  // int|string - Required. Unique identifier for the target chat or username of the target channel (in the format "@channelusername")
     *      'user_id'              => '',  // int        - Required. Unique identifier of the target user
     *      'is_anonymous'         => '',  // bool       - (Optional). Pass True, if the administrator's presence in the chat is hidden
     *      'can_manage_chat'      => '',  // bool       - (Optional). Pass True, if the administrator can access the chat event log, chat statistics, message statistics in channels, see channel members, see anonymous administrators in supergroups and ignore slow mode.
     *      'can_post_messages'    => '',  // bool       - (Optional). Pass True, if the administrator can post in the channel; channels only
     *      'can_edit_messages'    => '',  // bool       - (Optional). Pass True, if the administrator can edit messages of other users and can pin messages; channels only
     *      'can_delete_messages'  => '',  // bool       - (Optional). Pass True, if the administrator can delete messages of other users
     *      'can_promote_members'  => '',  // bool       - (Optional). Pass True, if the administrator can add new administrators with a subset of their own privileges or demote administrators that he has promoted, directly or indirectly (promoted by administrators that were appointed by him)
     *      'can_change_info'      => '',  // bool       - (Optional). Pass True, if the administrator can change chat title, photo and other settings
     *      'can_invite_users'     => '',  // bool       - (Optional). Pass True, if the administrator can invite new users to the chat
     *      'can_pin_messages'     => '',  // bool       - (Optional). Pass True, if the administrator can pin messages, supergroups only
     * ]
     * </code>
     *
     * @link https://docs.bale.ai/#promotechatmember
     *
     * @throws BaleSDKException
     */
    public function promoteChatMember(array $params): bool
    {
        return $this->post('promoteChatMember', $params)->getResult();
    }

    /**
     * Set a new profile photo for the chat.
     *
     * The bot must be an administrator in the group for this to work.
     *
     * <code>
     * $params = [
     *      'chat_id'  => '',                     // string|int - Required. Unique identifier for the target chat or username of the target channel (in the format "@channelusername")
     *      'photo'    => InputFile::file($file), // InputFile  - Required. New chat photo, uploaded using multipart/form-data
     * ]
     * </code>
     *
     * @link https://docs.bale.ai/#setchatphoto
     *
     * @throws BaleSDKException
     */
    public function setChatPhoto(array $params): bool
    {
        return $this->uploadFile('setChatPhoto', $params, 'photo')->getResult();
    }

    /**
     * Use this method for your bot to leave a group, supergroup or channel.
     *
     * <code>
     * $params = [
     *      'chat_id'  => '',  // string|int - Unique identifier for the target chat or username of the target supergroup or channel (in the format "@channelusername")
     * ]
     * </code>
     *
     * @link https://docs.bale.ai/#leavechat
     *
     * @throws BaleSDKException
     */
    public function leaveChat(array $params): bool
    {
        return $this->get('leaveChat', $params)->getResult();
    }

    /**
     * Get up to date information about the chat (current name of the user for one-on-one conversations,
     * current username of a user, group or channel, etc.).
     *
     * <code>
     * $params = [
     *      'chat_id'  => '',  // string|int - Unique identifier for the target chat or username of the target supergroup or channel (in the format "@channelusername")
     * ]
     * </code>
     *
     * @link https://docs.bale.ai/#getchat
     *
     * @throws BaleSDKException
     */
    public function getChat(array $params): ChatFullInfo
    {
        $response = $this->get('getChat', $params);

        return new ChatFullInfo($response->getDecodedBody());
    }

    /**
     * Get a list of administrators in a chat, which aren't bots.
     *
     * <code>
     * $params = [
     *      'chat_id'  => '',  // string|int - Unique identifier for the target chat or username of the target supergroup or channel (in the format "@channelusername")
     * ]
     * </code>
     *
     * @link https://docs.bale.ai/#getchatadministrators
     *
     * @return ChatMember[]
     *
     * @throws BaleSDKException
     */
    public function getChatAdministrators(array $params): array
    {
        $response = $this->get('getChatAdministrators', $params);

        return collect($response->getResult())
            ->map(fn ($data): ChatMember => ChatMember::factory($data))
            ->all();
    }

    /**
     * Get the number of members in a chat.
     *
     * <code>
     * $params = [
     *      'chat_id'  => '',  // string|int - Unique identifier for the target chat or username of the target supergroup or channel (in the format "@channelusername").
     * ]
     * </code>
     *
     * @link https://docs.bale.ai/#getchatmemberscount
     *
     * @throws BaleSDKException
     */
    public function getChatMembersCount(array $params): int
    {
        return $this->get('getChatMembersCount', $params)->getResult();
    }

    /**
     * Alias of getChatMembersCount.
     *
     * @link https://docs.bale.ai/#getchatmemberscount
     *
     * @throws BaleSDKException
     */
    public function getChatMemberCount(array $params): int
    {
        return $this->getChatMembersCount($params);
    }

    /**
     * Get information about a member of a chat.
     *
     * <code>
     * $params = [
     *      'chat_id'  => '',  // string|int - Required. Unique identifier for the target chat or username of the target supergroup or channel (in the format "@channelusername")
     *      'user_id'  => '',  // int        - Required. Unique identifier of the target user
     * ]
     * </code>
     *
     * @link https://docs.bale.ai/#getchatmember
     *
     * @throws BaleSDKException
     */
    public function getChatMember(array $params): ChatMember
    {
        $response = $this->get('getChatMember', $params);

        return ChatMember::factory($response->getResult());
    }

    /**
     * Pin a message in a group, a supergroup, or a channel.
     *
     * The bot must be an administrator in the chat for this to work and must have the ‘can_pin_messages’ admin right in the supergroup
     * or ‘can_edit_messages’ admin right in the channel.
     *
     * <code>
     * $params = [
     *      'chat_id'               => '',  // string|int - Required. Unique identifier for the target chat or username of the target channel (in the format "@channelusername")
     *      'message_id'            => '',  // int        - Required. Identifier of a message to pin
     * ]
     * </code>
     *
     * @link https://docs.bale.ai/#pinchatmessage
     *
     * @throws BaleSDKException
     */
    public function pinChatMessage(array $params): bool
    {
        return $this->post('pinChatMessage', $params)->getResult();
    }

    /**
     * Unpin a message in a group, a supergroup, or a channel.
     *
     * The bot must be an administrator in the chat for this to work and must have the ‘can_pin_messages’ admin right in the supergroup
     * or ‘can_edit_messages’ admin right in the channel.
     *
     * The bot must be an administrator in the group for this to work.
     *
     * <code>
     * $params = [
     *      'chat_id'     => '',  // string|int - Required. Unique identifier for the target chat or username of the target channel (in the format "@channelusername")
     *      'message_id'  => '',  // int        - (Optional). Identifier of a message to unpin. If not specified, the most recent pinned message (by sending date) will be unpinned.
     * ]
     * </code>
     *
     * @link https://docs.bale.ai/#unpinchatmessage
     *
     * @throws BaleSDKException
     */
    public function unpinChatMessage(array $params): bool
    {
        return $this->post('unpinChatMessage', $params)->getResult();
    }

    /**
     * Unpin/clear the list of pinned messages in a chat.
     *
     * If the chat is not a private chat, the bot must be an administrator in the chat for this to work
     * and must have the 'can_pin_messages' admin right in a supergroup or 'can_edit_messages' admin right
     * in a channel.
     *
     * <code>
     * $params = [
     *      'chat_id'     => '',  // string|int - Required. Unique identifier for the target chat or username of the target channel (in the format "@channelusername")
     * ]
     * </code>
     *
     * @link https://docs.bale.ai/#unpinallchatmessages
     *
     * @throws BaleSDKException
     */
    public function unpinAllChatMessages(array $params): bool
    {
        return $this->post('unpinAllChatMessages', $params)->getResult();
    }

    /**
     * Set the title of a chat.
     *
     * The bot must be an administrator in the group for this to work.
     *
     * <code>
     * $params = [
     *      'chat_id'  => '',  // string|int - Required. Unique identifier for the target chat or username of the target channel (in the format "@channelusername")
     *      'title'    => '',  // string     - Required. New chat title, 1-255 characters
     * ]
     * </code>
     *
     * @link https://docs.bale.ai/#setchattitle
     *
     * @throws BaleSDKException
     */
    public function setChatTitle(array $params): bool
    {
        return $this->post('setChatTitle', $params)->getResult();
    }

    /**
     * Set the description of a supergroup or a channel.
     *
     * The bot must be an administrator in the group for this to work.
     *
     * <code>
     * $params = [
     *      'chat_id'      => '',  // string|int - Required. Unique identifier for the target chat or username of the target channel (in the format "@channelusername")
     *      'description'  => '',  // string     - (Optional). New chat description, 0 - 255 characters.
     * ]
     * </code>
     *
     * @link https://docs.bale.ai/#setchatdescription
     *
     * @throws BaleSDKException
     */
    public function setChatDescription(array $params): bool
    {
        return $this->post('setChatDescription', $params)->getResult();
    }

    /**
     * Delete a chat photo.
     *
     * The bot must be an administrator in the group for this to work.
     *
     * <code>
     * $params = [
     *      'chat_id'  => '',  // string|int - Required. Unique identifier for the target chat or username of the target channel (in the format "@channelusername")
     * ]
     * </code>
     *
     * @link https://docs.bale.ai/#deletechatphoto
     *
     * @throws BaleSDKException
     */
    public function deleteChatPhoto(array $params): bool
    {
        return $this->post('deleteChatPhoto', $params)->getResult();
    }

    /**
     * Create an additional invite link for a chat.
     *
     * The bot must be an administrator in the group for this to work.
     *
     * <code>
     * $params = [
     *      'chat_id'               => '',  // string|int - Required. Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * ]
     * </code>
     *
     * @link https://docs.bale.ai/#createchatinvitelink
     *
     * @throws BaleSDKException
     */
    public function createChatInviteLink(array $params)
    {
        return $this->post('createChatInviteLink', $params)->getDecodedBody();
    }

    /**
     * Revoke an invite link created by the bot.
     *
     * The bot must be an administrator in the group for this to work.
     *
     * <code>
     * $params = [
     *      'chat_id'               => '',  // string|int - Required. Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     *      'invite_link'           => '',  // string     - Required. The invite link to revoke
     * ]
     * </code>
     *
     * @link https://docs.bale.ai/#revokechatinvitelink
     *
     * @throws BaleSDKException
     */
    public function revokeChatInviteLink(array $params)
    {
        return $this->post('revokeChatInviteLink', $params)->getDecodedBody();
    }

    /**
     * Export an invite link to a supergroup or a channel.
     *
     * The bot must be an administrator in the group for this to work.
     *
     * <code>
     * $params = [
     *      'chat_id'  => '',  // string|int - Unique identifier for the target chat or username of the target channel (in the format "@channelusername")
     * ]
     * </code>
     *
     * @link https://docs.bale.ai/#exportchatinvitelink
     *
     * @throws BaleSDKException
     */
    public function exportChatInviteLink(array $params): string
    {
        return $this->post('exportChatInviteLink', $params)->getResult();
    }
}
