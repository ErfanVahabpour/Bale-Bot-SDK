<?php

namespace EFive\Bale\Tests\Unit;

use EFive\Bale\Objects\Payments\Invoice;
use EFive\Bale\Objects\Payments\LabeledPrice;
use EFive\Bale\Objects\Payments\PreCheckoutQuery;
use EFive\Bale\Objects\Payments\SuccessfulPayment;
use EFive\Bale\Objects\Payments\Transaction;
use EFive\Bale\Objects\User;
use EFive\Bale\Tests\TestCase;

class PaymentsObjectsTest extends TestCase
{
    public function test_invoice_object(): void
    {
        $invoice = new Invoice([
            'title' => 'Product 1',
            'description' => 'Great product',
            'start_parameter' => 'param123',
            'currency' => 'IRR',
            'total_amount' => 50000,
        ]);

        $this->assertSame('Product 1', $invoice->title);
        $this->assertSame('IRR', $invoice->currency);
        $this->assertSame(50000, $invoice->total_amount);
    }

    public function test_labeled_price_object(): void
    {
        $price = new LabeledPrice([
            'label' => 'Item cost',
            'amount' => 25000,
        ]);

        $this->assertSame('Item cost', $price->label);
        $this->assertSame(25000, $price->amount);
    }

    public function test_pre_checkout_query_object(): void
    {
        $query = new PreCheckoutQuery([
            'id' => 'pcq_999',
            'currency' => 'IRR',
            'total_amount' => 100000,
            'invoice_payload' => 'payload_secret_123',
            'from' => [
                'id' => 777,
                'is_bot' => false,
                'first_name' => 'Buyer',
            ],
        ]);

        $this->assertSame('pcq_999', $query->id);
        $this->assertSame('IRR', $query->currency);
        $this->assertSame(100000, $query->total_amount);
        $this->assertSame('payload_secret_123', $query->invoice_payload);
        $this->assertInstanceOf(User::class, $query->from);
        $this->assertSame(777, $query->from->id);
    }

    public function test_successful_payment_object(): void
    {
        $payment = new SuccessfulPayment([
            'currency' => 'IRR',
            'total_amount' => 100000,
            'invoice_payload' => 'payload_secret_123',
            'telegram_payment_charge_id' => 'tpc_123',
            'provider_payment_charge_id' => 'ppc_123',
        ]);

        $this->assertSame('IRR', $payment->currency);
        $this->assertSame(100000, $payment->total_amount);
        $this->assertSame('tpc_123', $payment->telegram_payment_charge_id);
    }

    public function test_transaction_object(): void
    {
        $tx = new Transaction([
            'status' => 'paid',
            'payment_charge_id' => 'charge_abc_123',
        ]);

        $this->assertSame('paid', $tx->status);
        $this->assertSame('charge_abc_123', $tx->payment_charge_id);
    }
}
