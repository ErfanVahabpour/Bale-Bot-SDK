<?php

namespace EFive\Bale\Objects\Payments;

use EFive\Bale\Objects\BaseObject;
use EFive\Bale\Objects\User;

/**
 * Class PreCheckoutQuery.
 *
 * @link https://docs.bale.ai/#precheckoutquery
 *
 * @property string $id Unique query identifier.
 * @property User $from User who sent the query.
 * @property string $currency Three-letter ISO 4217 currency code.
 * @property int $total_amount Total price in the smallest units of the currency.
 * @property string $invoice_payload Bot specified invoice payload.
 */
class PreCheckoutQuery extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'from' => User::class,
        ];
    }
}
