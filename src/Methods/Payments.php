<?php

namespace EFive\Bale\Methods;

use Illuminate\Support\Arr;
use EFive\Bale\Exceptions\BaleSDKException;
use EFive\Bale\Objects\Message;
use EFive\Bale\Traits\Http;

/**
 * Trait Payments.
 *
 * @mixin Http
 */
trait Payments
{
    /**
     * Send invoices.
     *
     * <code>
     * $params = [
     *      'chat_id'                        => '',  // int            - Required. Unique identifier for the target chat or username of the target channel (in the format "@channelusername")
     *      'title'                          => '',  // string         - Required. Product name, 1-32 characters
     *      'description'                    => '',  // string         - Required. Product description, 1-255 characters
     *      'payload'                        => '',  // string         - Required. Bot-defined invoice payload, 1-128 bytes. This will not be displayed to the user, use for your internal processes.
     *      'provider_token'                 => '',  // string         - Required. Payments provider token, obtained via Botfather
     *      'prices'                         => '',  // LabeledPrice[] - Required. Price breakdown, a list of components (e.g. product price, tax, discount, delivery cost, delivery tax, bonus, etc.)
     *      'photo_url'                      => '',  // string         - (Optional). URL of the product photo for the invoice. Can be a photo of the goods or a marketing image for a service. People like it better when they see what they are paying for.
     *      'reply_to_message_id'            => '',  // int            - (Optional). If the message is a reply, ID of the original message
     *      'reply_markup'                   => '',  // string         - (Optional). A JSON-serialized object for an inline keyboard. If empty, one 'Pay total price' button will be shown. If not empty, the first button must be a Pay button.
     * ]
     * </code>
     *
     * @link https://docs.bale.ai/#%D9%BE%D8%B1%D8%AF%D8%A7%D8%AE%D8%AA
     *
     * @throws BaleSDKException
     */
    public function sendInvoice(array $params): Message
    {
        $params['prices'] = json_encode(Arr::wrap($params['prices']), JSON_THROW_ON_ERROR);
        $response = $this->post('sendInvoice', $params);

        return new Message($response->getDecodedBody());
    }
}