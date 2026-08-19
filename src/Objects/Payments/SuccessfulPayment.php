<?php

namespace EFive\Bale\Objects\Payments;

use EFive\Bale\Objects\BaseObject;

/**
 * Class SuccessfulPayment.
 *
 * @link https://docs.bale.ai/#successfulpayment
 *
 * @property string $currency Three-letter ISO 4217 currency code.
 * @property int $total_amount Total price in the smallest units of the currency.
 * @property string $invoice_payload Bot specified invoice payload.
 * @property string|null $shipping_option_id (Optional). Identifier of the shipping option chosen by the user.
 * @property string $telegram_payment_charge_id Telegram payment identifier.
 * @property string $provider_payment_charge_id Provider payment identifier.
 */
class SuccessfulPayment extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }
}
