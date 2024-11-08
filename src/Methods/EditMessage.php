<?php

namespace EFive\Bale\Methods;

use EFive\Bale\Exceptions\BaleSDKException;
use EFive\Bale\Objects\Message;
use EFive\Bale\Traits\Http;

/**
 * Class EditMessage.
 *
 * @mixin Http
 */
trait EditMessage
{
    /**
     * Edit text messages sent by the bot or via the bot (for inline bots).
     *
     * <code>
     * $params = [
     *       'chat_id'                   => '',  // int|string - (Optional). Required if inline_message_id is not specified. Unique identifier for the target chat or username of the target channel (in the format "@channelusername")
     *       'message_id'                => '',  // int        - (Optional). Required if inline_message_id is not specified. Identifier of the sent message
     *       'text'                      => '',  // string     - Required. New text of the message.
     *       'reply_markup'              => '',  // string     - (Optional). A JSON-serialized object for an inline keyboard.
     * ]
     * </code>
     *
     * @link https://docs.bale.ai/#editmessagetext
     *
     * @return Message|bool
     *
     * @throws BaleSDKException
     */
    public function editMessageText(array $params): Message
    {
        $response = $this->post('editMessageText', $params);

        return new Message($response->getDecodedBody());
    }

    /**
     * Delete a message, including service messages, with the following limitations:.
     *
     * - A message can only be deleted if it was sent less than 48 hours ago.
     * - Bots can delete outgoing messages in private chats, groups, and supergroups.
     * - Bots can delete incoming messages in private chats.
     * - Bots granted can_post_messages permissions can delete outgoing messages in channels.
     * - If the bot is an administrator of a group, it can delete any message there.
     * - If the bot has can_delete_messages permission in a supergroup or a channel, it can delete any message there.
     *
     * <code>
     * $params = [
     *       'chat_id'     => '',  // int|string - Required. Unique identifier for the target chat or username of the target channel (in the format "@channelusername")
     *       'message_id'  => '',  // int        - Required. Identifier of the message to delete.
     * ]
     * </code>
     *
     * @link https://docs.bale.ai/#deletemessage
     *
     * @return bool
     *
     * @throws BaleSDKException
     */
    public function deleteMessage(array $params)
    {
        return $this->post('deleteMessage', $params)->getResult();
    }
}