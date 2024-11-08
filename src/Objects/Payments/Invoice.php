<?php

namespace EFive\Bale\Objects\Payments;

use EFive\Bale\Objects\BaseObject;

/**
 * @link ?
 *
 * @property string $title Product name
 * @property string $description Product description
 * @property string $start_parameter Unique bot deep-linking parameter that can be used to generate this invoice
 * @property string $currency Three-letter ISO 4217 currency code
 * @property int $total_amount Total price in the smallest units of the currency (integer, not float/double)
 */
class Invoice extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
        ];
    }
}