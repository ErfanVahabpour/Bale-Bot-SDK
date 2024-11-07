<?php

namespace EFive\Bale\Methods;

use Illuminate\Support\Arr;
use EFive\Bale\Exceptions\BaleSDKException;
use EFive\Bale\Objects\Message as MessageObject;
use EFive\Bale\Traits\Http;

/**
 * Class Message.
 *
 * @mixin Http
 */
trait Message
{
    /**
     * Send text messages.
     *
     * <code>
     * $params = [
     *       'chat_id'                     => '',  // int|string - Required. Unique identifier for the target chat or username of the target channel (in the format "@channelusername")
     *       'text'                        => '',  // string     - Required. Text of the message to be sent
     *       'reply_to_message_id'         => '',  // int        - (Optional). If the message is a reply, ID of the original message
     *       'reply_markup'                => '',  // object     - (Optional). One of either InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
     * ]
     * </code>
     *
     * @link https://docs.bale.ai/#sendmessage
     *
     * @throws BaleSDKException
     */
    public function sendMessage(array $params): MessageObject
    {
        $response = $this->post('sendMessage', $params);

        return new MessageObject($response->getDecodedBody());
    }
}