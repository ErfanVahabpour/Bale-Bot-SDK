<?php

namespace EFive\Bale\Objects\Payments;

use EFive\Bale\Objects\BaseObject;

/**
 * @link ?
 *
 * @property string $label Portion label
 * @property int $amount Price of the product in the smallest units of the currency (integer, not float/double).
 */
class LabeledPrice extends BaseObject
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