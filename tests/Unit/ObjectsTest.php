<?php

namespace EFive\Bale\Tests\Unit;

use EFive\Bale\Objects\Animation;
use EFive\Bale\Objects\Audio;
use EFive\Bale\Objects\BotCommand;
use EFive\Bale\Objects\CallbackQuery;
use EFive\Bale\Objects\Chat;
use EFive\Bale\Objects\ChatFullInfo;
use EFive\Bale\Objects\ChatPhoto;
use EFive\Bale\Objects\Contact;
use EFive\Bale\Objects\CopyTextButton;
use EFive\Bale\Objects\Document;
use EFive\Bale\Objects\File;
use EFive\Bale\Objects\Location;
use EFive\Bale\Objects\Message;
use EFive\Bale\Objects\MessageEntity;
use EFive\Bale\Objects\MessageId;
use EFive\Bale\Objects\PhotoSize;
use EFive\Bale\Objects\ResponseParameters;
use EFive\Bale\Objects\Sticker;
use EFive\Bale\Objects\Update;
use EFive\Bale\Objects\User;
use EFive\Bale\Objects\Video;
use EFive\Bale\Objects\Voice;
use EFive\Bale\Objects\WebAppData;
use EFive\Bale\Objects\WebAppInfo;
use EFive\Bale\Objects\WebhookInfo;
use EFive\Bale\Tests\TestCase;

class ObjectsTest extends TestCase
{
    public function test_user_object(): void
    {
        $user = new User([
            'id' => 123456,
            'is_bot' => false,
            'first_name' => 'John',
            'last_name' => 'Doe',
            'username' => 'johndoe',
            'language_code' => 'en',
        ]);

        $this->assertSame(123456, $user->id);
        $this->assertFalse($user->is_bot);
        $this->assertSame('John', $user->first_name);
        $this->assertSame('Doe', $user->last_name);
        $this->assertSame('johndoe', $user->username);
        $this->assertSame('en', $user->language_code);
    }

    public function test_chat_object(): void
    {
        $chat = new Chat([
            'id' => 987654,
            'type' => 'private',
            'first_name' => 'John',
            'username' => 'johndoe',
        ]);

        $this->assertSame(987654, $chat->id);
        $this->assertSame('private', $chat->type);
        $this->assertSame('John', $chat->first_name);
    }

    public function test_chat_full_info_object(): void
    {
        $chatFull = new ChatFullInfo([
            'id' => -1001234567,
            'type' => 'supergroup',
            'title' => 'Test Group',
            'username' => 'testgroup',
            'description' => 'A test group description',
            'invite_link' => 'https://ble.ir/join/test',
            'member_count' => 42,
            'photo' => [
                'small_file_id' => 'photo_sm_123',
                'big_file_id' => 'photo_bg_123',
            ],
        ]);

        $this->assertSame(-1001234567, $chatFull->id);
        $this->assertSame('supergroup', $chatFull->type);
        $this->assertSame('Test Group', $chatFull->title);
        $this->assertSame('A test group description', $chatFull->description);
        $this->assertSame('https://ble.ir/join/test', $chatFull->invite_link);
        $this->assertSame(42, $chatFull->member_count);
        $this->assertInstanceOf(ChatPhoto::class, $chatFull->photo);
        $this->assertSame('photo_sm_123', $chatFull->photo->small_file_id);
    }

    public function test_message_id_object(): void
    {
        $msgId = new MessageId(['message_id' => 54321]);

        $this->assertSame(54321, $msgId->message_id);
    }

    public function test_web_app_data_and_info(): void
    {
        $webAppData = new WebAppData([
            'data' => '{"action":"confirm"}',
            'button_text' => 'Open App',
        ]);
        $this->assertSame('{"action":"confirm"}', $webAppData->data);
        $this->assertSame('Open App', $webAppData->button_text);

        $webAppInfo = new WebAppInfo([
            'url' => 'https://app.example.com',
        ]);
        $this->assertSame('https://app.example.com', $webAppInfo->url);
    }

    public function test_copy_text_button(): void
    {
        $btn = new CopyTextButton(['text' => 'Copy this']);
        $this->assertSame('Copy this', $btn->text);
    }

    public function test_response_parameters(): void
    {
        $params = new ResponseParameters([
            'migrate_to_chat_id' => -100999,
            'retry_after' => 15,
        ]);
        $this->assertSame(-100999, $params->migrate_to_chat_id);
        $this->assertSame(15, $params->retry_after);
    }

    public function test_message_relations_and_detection(): void
    {
        $message = new Message([
            'message_id' => 1,
            'date' => 1600000000,
            'chat' => [
                'id' => 100,
                'type' => 'private',
            ],
            'from' => [
                'id' => 200,
                'is_bot' => false,
                'first_name' => 'Alice',
            ],
            'text' => '/help please',
            'entities' => [
                [
                    'type' => 'bot_command',
                    'offset' => 0,
                    'length' => 5,
                ],
            ],
            'photo' => [
                ['file_id' => 'p1', 'file_size' => 100, 'width' => 50, 'height' => 50],
                ['file_id' => 'p2', 'file_size' => 200, 'width' => 100, 'height' => 100],
            ],
        ]);

        $this->assertSame(1, $message->message_id);
        $this->assertInstanceOf(Chat::class, $message->chat);
        $this->assertSame(100, $message->chat->id);
        $this->assertInstanceOf(User::class, $message->from);
        $this->assertSame('Alice', $message->from->first_name);
        $this->assertTrue($message->hasCommand());
        $this->assertTrue($message->isType('text'));
        $this->assertCount(2, $message->photo);
        $this->assertInstanceOf(PhotoSize::class, $message->photo[0]);
    }

    public function test_update_object_with_message(): void
    {
        $update = new Update([
            'update_id' => 1001,
            'message' => [
                'message_id' => 42,
                'date' => 1600000000,
                'text' => 'Hello Bale',
                'chat' => [
                    'id' => 555,
                    'type' => 'private',
                ],
            ],
        ]);

        $this->assertSame(1001, $update->update_id);
        $this->assertTrue($update->isType('message'));
        $this->assertSame('message', $update->objectType());
        $this->assertInstanceOf(Message::class, $update->getRelatedObject());
        $this->assertSame(555, $update->getChat()->get('id'));
    }

    public function test_update_object_with_callback_query(): void
    {
        $update = new Update([
            'update_id' => 1002,
            'callback_query' => [
                'id' => 'cb_123',
                'from' => [
                    'id' => 200,
                    'is_bot' => false,
                    'first_name' => 'Bob',
                ],
                'data' => 'btn_clicked',
            ],
        ]);

        $this->assertSame(1002, $update->update_id);
        $this->assertTrue($update->isType('callback_query'));
        $this->assertSame('callback_query', $update->objectType());
        $this->assertInstanceOf(CallbackQuery::class, $update->getRelatedObject());
    }

    public function test_media_objects(): void
    {
        $audio = new Audio(['file_id' => 'aud1', 'duration' => 120, 'mime_type' => 'audio/mp3']);
        $this->assertSame('aud1', $audio->file_id);
        $this->assertSame(120, $audio->duration);

        $video = new Video(['file_id' => 'vid1', 'duration' => 60, 'width' => 1920, 'height' => 1080]);
        $this->assertSame('vid1', $video->file_id);
        $this->assertSame(1920, $video->width);

        $voice = new Voice(['file_id' => 'vox1', 'duration' => 15]);
        $this->assertSame('vox1', $voice->file_id);

        $doc = new Document(['file_id' => 'doc1', 'file_name' => 'report.pdf']);
        $this->assertSame('report.pdf', $doc->file_name);

        $loc = new Location(['longitude' => 51.3890, 'latitude' => 35.6892]);
        $this->assertSame(51.3890, $loc->longitude);
        $this->assertSame(35.6892, $loc->latitude);

        $contact = new Contact(['phone_number' => '+989123456789', 'first_name' => 'Ali']);
        $this->assertSame('+989123456789', $contact->phone_number);
    }
}
