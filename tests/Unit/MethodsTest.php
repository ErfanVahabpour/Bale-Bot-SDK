<?php

namespace EFive\Bale\Tests\Unit;

use EFive\Bale\Api;
use EFive\Bale\BaleResponse;
use EFive\Bale\HttpClients\HttpClientInterface;
use EFive\Bale\Objects\ChatFullInfo;
use EFive\Bale\Objects\ChatMember\ChatMember;
use EFive\Bale\Objects\Message;
use EFive\Bale\Objects\MessageId;
use EFive\Bale\Objects\Payments\Transaction;
use EFive\Bale\Objects\User;
use EFive\Bale\Tests\TestCase;
use GuzzleHttp\Psr7\Response;
use Mockery;

class MethodsTest extends TestCase
{
    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    private function createMockApi(string $jsonResponseBody, int $statusCode = 200): Api
    {
        $mockClient = Mockery::mock(HttpClientInterface::class);
        $mockClient->shouldReceive('setTimeOut')->andReturnSelf();
        $mockClient->shouldReceive('setConnectTimeOut')->andReturnSelf();
        $mockClient->shouldReceive('send')
            ->andReturn(new Response($statusCode, ['Content-Type' => 'application/json'], $jsonResponseBody));

        return new Api('test_token_123', false, $mockClient);
    }

    public function test_get_me(): void
    {
        $api = $this->createMockApi(json_encode([
            'ok' => true,
            'result' => [
                'id' => 123456789,
                'is_bot' => true,
                'first_name' => 'MyBot',
                'username' => 'my_bot',
            ],
        ]));

        $user = $api->getMe();

        $this->assertInstanceOf(User::class, $user);
        $this->assertSame(123456789, $user->id);
        $this->assertTrue($user->is_bot);
        $this->assertSame('MyBot', $user->first_name);
    }

    public function test_send_message(): void
    {
        $api = $this->createMockApi(json_encode([
            'ok' => true,
            'result' => [
                'message_id' => 42,
                'date' => 1600000000,
                'text' => 'Hello World',
                'chat' => ['id' => 100, 'type' => 'private'],
            ],
        ]));

        $msg = $api->sendMessage([
            'chat_id' => 100,
            'text' => 'Hello World',
        ]);

        $this->assertInstanceOf(Message::class, $msg);
        $this->assertSame(42, $msg->message_id);
        $this->assertSame('Hello World', $msg->text);
    }

    public function test_copy_message(): void
    {
        $api = $this->createMockApi(json_encode([
            'ok' => true,
            'result' => [
                'message_id' => 99,
            ],
        ]));

        $msgId = $api->copyMessage([
            'chat_id' => 100,
            'from_chat_id' => 200,
            'message_id' => 42,
        ]);

        $this->assertInstanceOf(MessageId::class, $msgId);
        $this->assertSame(99, $msgId->message_id);
    }

    public function test_send_chat_action(): void
    {
        $api = $this->createMockApi(json_encode([
            'ok' => true,
            'result' => true,
        ]));

        $result = $api->sendChatAction([
            'chat_id' => 100,
            'action' => 'typing',
        ]);

        $this->assertTrue($result);
    }

    public function test_delete_webhook(): void
    {
        $api = $this->createMockApi(json_encode([
            'ok' => true,
            'result' => true,
        ]));

        $result = $api->deleteWebhook();

        $this->assertTrue($result);
    }

    public function test_edit_message_caption(): void
    {
        $api = $this->createMockApi(json_encode([
            'ok' => true,
            'result' => [
                'message_id' => 42,
                'date' => 1600000000,
                'caption' => 'New Caption',
                'chat' => ['id' => 100, 'type' => 'private'],
            ],
        ]));

        $msg = $api->editMessageCaption([
            'chat_id' => 100,
            'message_id' => 42,
            'caption' => 'New Caption',
        ]);

        $this->assertInstanceOf(Message::class, $msg);
        $this->assertSame('New Caption', $msg->caption);
    }

    public function test_edit_message_reply_markup(): void
    {
        $api = $this->createMockApi(json_encode([
            'ok' => true,
            'result' => [
                'message_id' => 42,
                'date' => 1600000000,
                'chat' => ['id' => 100, 'type' => 'private'],
            ],
        ]));

        $msg = $api->editMessageReplyMarkup([
            'chat_id' => 100,
            'message_id' => 42,
            'reply_markup' => ['inline_keyboard' => []],
        ]);

        $this->assertInstanceOf(Message::class, $msg);
    }

    public function test_get_chat(): void
    {
        $api = $this->createMockApi(json_encode([
            'ok' => true,
            'result' => [
                'id' => -100123,
                'type' => 'supergroup',
                'title' => 'Developers',
            ],
        ]));

        $chat = $api->getChat(['chat_id' => -100123]);

        $this->assertInstanceOf(ChatFullInfo::class, $chat);
        $this->assertSame(-100123, $chat->id);
        $this->assertSame('Developers', $chat->title);
    }

    public function test_get_chat_administrators(): void
    {
        $api = $this->createMockApi(json_encode([
            'ok' => true,
            'result' => [
                [
                    'status' => 'creator',
                    'is_anonymous' => false,
                    'user' => ['id' => 1, 'is_bot' => false, 'first_name' => 'Owner'],
                ],
                [
                    'status' => 'administrator',
                    'can_delete_messages' => true,
                    'user' => ['id' => 2, 'is_bot' => false, 'first_name' => 'Mod'],
                ],
            ],
        ]));

        $admins = $api->getChatAdministrators(['chat_id' => -100123]);

        $this->assertCount(2, $admins);
        $this->assertInstanceOf(ChatMember::class, $admins[0]);
        $this->assertSame('creator', $admins[0]->status);
        $this->assertSame('administrator', $admins[1]->status);
    }

    public function test_get_chat_member(): void
    {
        $api = $this->createMockApi(json_encode([
            'ok' => true,
            'result' => [
                'status' => 'member',
                'user' => ['id' => 55, 'is_bot' => false, 'first_name' => 'Member1'],
            ],
        ]));

        $member = $api->getChatMember(['chat_id' => -100123, 'user_id' => 55]);

        $this->assertInstanceOf(ChatMember::class, $member);
        $this->assertSame('member', $member->status);
    }

    public function test_answer_callback_query(): void
    {
        $api = $this->createMockApi(json_encode([
            'ok' => true,
            'result' => true,
        ]));

        $result = $api->answerCallbackQuery([
            'callback_query_id' => 'cb_123',
            'text' => 'Thanks!',
        ]);

        $this->assertTrue($result);
    }

    public function test_ask_review(): void
    {
        $api = $this->createMockApi(json_encode([
            'ok' => true,
            'result' => true,
        ]));

        $result = $api->askReview(['user_id' => 100]);

        $this->assertTrue($result);
    }

    public function test_create_invoice_link(): void
    {
        $api = $this->createMockApi(json_encode([
            'ok' => true,
            'result' => 'https://ble.ir/invoice/12345',
        ]));

        $link = $api->createInvoiceLink([
            'title' => 'VIP Subscription',
            'description' => '1 Month VIP',
            'payload' => 'sub_1m',
            'provider_token' => 'prov_tok_123',
            'prices' => [['label' => 'VIP', 'amount' => 50000]],
        ]);

        $this->assertSame('https://ble.ir/invoice/12345', $link);
    }

    public function test_answer_pre_checkout_query(): void
    {
        $api = $this->createMockApi(json_encode([
            'ok' => true,
            'result' => true,
        ]));

        $result = $api->answerPreCheckoutQuery([
            'pre_checkout_query_id' => 'pcq_123',
            'ok' => true,
        ]);

        $this->assertTrue($result);
    }

    public function test_inquire_transaction(): void
    {
        $api = $this->createMockApi(json_encode([
            'ok' => true,
            'result' => [
                'status' => 'paid',
                'payment_charge_id' => 'chg_12345',
            ],
        ]));

        $tx = $api->inquireTransaction(['payment_charge_id' => 'chg_12345']);

        $this->assertInstanceOf(Transaction::class, $tx);
        $this->assertSame('paid', $tx->status);
        $this->assertSame('chg_12345', $tx->payment_charge_id);
    }
}
