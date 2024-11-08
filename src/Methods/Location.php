<?php

namespace EFive\Bale\Methods;

use EFive\Bale\Exceptions\BaleSDKException;
use EFive\Bale\Objects\Message as MessageObject;

/**
 * Class Location.
 *
 * @mixin Http
 */
trait Location
{
    /**
     * Send point on the map.
     *
     * <code>
     * $params = [
     *       'chat_id'                     => '',  // int|string - Required. Unique identifier for the target chat or username of the target channel (in the format "@channelusername")
     *       'latitude'                    => '',  // float      - Required. Latitude of location
     *       'longitude'                   => '',  // float      - Required. Longitude of location
     *       'horizontal_accuracy          => '',  // float      - (Optional). The radius of uncertainty for the location, measured in meters; 0-1500
     *       'reply_to_message_id'         => '',  // int        - (Optional). If the message is a reply, ID of the original message
     *       'reply_markup'                => '',  // string     - (Optional). Additional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
     * ]
     * </code>
     *
     * @link https://docs.bale.ai/#sendlocation
     *
     * @throws BaleSDKException
     */
    public function sendLocation(array $params): MessageObject
    {
        $response = $this->post('sendLocation', $params);

        return new MessageObject($response->getDecodedBody());
    }
}