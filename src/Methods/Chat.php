<?php

namespace EFive\Bale\Methods;

use EFive\Bale\Exceptions\BaleSDKException;
use EFive\Bale\Objects\Chat as ChatObject;
use EFive\Bale\Traits\Http;

/**
 * Class Chat.
 *
 * @mixin Http
 */
trait Chat
{
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
    public function getChat(array $params): ChatObject
    {
        $response = $this->get('getChat', $params);

        return new ChatObject($response->getDecodedBody());
    }    
}
