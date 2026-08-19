<?php

namespace EFive\Bale\Objects\Payments;

use EFive\Bale\Objects\BaseObject;

/**
 * Class Transaction.
 *
 * @link https://docs.bale.ai/#transaction
 *
 * @property string $status Transaction status.
 * @property string|null $payment_charge_id (Optional). Payment charge identifier.
 */
class Transaction extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }
}
