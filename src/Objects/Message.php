<?php

namespace EFive\Bale\Objects;

/**
 * Class Message.
 *
 * @link https://docs.bale.ai/#message
 *
 * @property int $message_id Unique message identifier.
 * @property User|null $from (Optional). Sender, can be empty for messages sent to channels.
 * @property int $date Date the message was sent in Unix time.
 * @property Chat $chat Conversation the message belongs to.
 * @property User|null $forward_from (Optional). For forwarded messages, sender of the original message.
 * @property Chat|null $forward_from_chat (Optional). For messages forwarded from a channel, information about the original channel.
 * @property int|null $forward_from_message_id (Optional). For forwarded channel posts, identifier of the original message in the channel.
 * @property int|null $forward_date (Optional). For forwarded messages, date the original message was sent in Unix time.
 * @property Message|null $reply_to_message (Optional). For replies, the original message. Note that the Message object in this field will not contain further reply_to_message fields even if it itself is a reply.
 * @property int|null $edite_date (Optional). Date the message was last edited in Unix time.
 * @property string|null $text (Optional). For text messages, the actual UTF-8 text of the message, 0-4096 characters.
 * @property Animation|null $animation (Optional). Message is an animation, information about the animation. For backward compatibility, when this field is set, the document field will also be set
 * @property Audio|null $audio (Optional). Message is an audio file, information about the file.
 * @property Document|null $document (Optional). Message is a general file, information about the file.
 * @property PhotoSize[]|null $photo (Optional). Message is a photo, available sizes of the photo.
 * @property Sticker|null $sticker (Optional). Message is a sticker, information about the sticker.
 * @property Video|null $video (Optional). Message is a video, information about the video.
 * @property Voice|null $voice (Optional). Message is a voice message, information about the file..
 * @property string|null $caption (Optional). Caption for the document, photo or video, 0-200 characters.
 * @property Contact|null $contact (Optional). Message is a shared contact, information about the contact.
 * @property Location|null $location (Optional). Message is a shared location, information about the location.
 * @property User[]|null $new_chat_members (Optional). New members that were added to the group or supergroup and information about them (the bot itself may be one of these members).
 * @property User|null $left_chat_member (Optional). A member was removed from the group, information about them (this member may be the bot itself).
 * @property Invoice|null $invoice (Optional). Message is an invoice for a payment, information about the invoice.
 * @property SuccessfulPayment|null $successful_payment (Optional). Message is a service message about a successful payment, information about the payment.
 * @property string|null $reply_markup (Optional). Inline keyboard attached to the message. login_url buttons are represented as ordinary url buttons.
 */
class Message extends BaseObject
{
    /**
     * @var string[]
     */
    protected const TYPES = [
        'text',
        'audio',
        'animation',
        'dice',
        'document',
        'game',
        'photo',
        'sticker',
        'video',
        'video_note',
        'voice',
        'contact',
        'location',
        'venue',
        'poll',
        'new_chat_member',
        'new_chat_members',
        'left_chat_member',
        'new_chat_title',
        'new_chat_photo',
        'delete_chat_photo',
        'group_chat_created',
        'supergroup_chat_created',
        'channel_chat_created',
        'migrate_to_chat_id',
        'migrate_from_chat_id',
        'pinned_message',
        'invoice',
        'successful_payment',
        'passport_data',
        'proximity_alert_triggered',
        'voice_chat_started',
        'voice_chat_ended',
        'voice_chat_participants_invited',
        'web_app_data',
    ];

    /**
     * {@inheritdoc}
     *
     * @return array{from: string, chat: string, forward_from: string, forward_from_chat: string, reply_to_message: class-string<Message>, audio: string, animation: string, document: string, photo: string[], sticker: string, video: string, voice: string, contact: string, location: string, new_chat_member: string, new_chat_members: string[], left_chat_member: string, invoice: string, successful_payment: string}
     */
    public function relations(): array
    {
        return [
            'from' => User::class,
            'chat' => Chat::class,
            'forward_from' => User::class,
            'forward_from_chat' => Chat::class,
            'reply_to_message' => self::class,
            // 'audio' => Audio::class,
            // 'animation' => Animation::class,
            // 'document' => Document::class,
            // 'photo' => [PhotoSize::class],
            // 'sticker' => Sticker::class,
            // 'video' => Video::class,
            // 'voice' => Voice::class,
            // 'contact' => Contact::class,
            // 'location' => Location::class,
            // 'new_chat_member' => ChatMember::class,
            'new_chat_members' => [User::class],
            'left_chat_member' => User::class,
            // 'invoice' => Invoice::class,
            // 'successful_payment' => SuccessfulPayment::class
        ];
    }

    /**
     * Determine if the message is of given type.
     */
    public function isType(string $type): bool
    {
        if ($this->has(strtolower($type))) {
            return true;
        }

        return $this->detectType() === $type;
    }

    /**
     * Detect type based on properties.
     */
    public function objectType(): ?string
    {
        return $this->findType(static::TYPES);
    }

    /**
     * Does this message contain a command entity.
     */
    public function hasCommand(): bool
    {
        return $this->get('entities', collect())->contains('type', 'bot_command');
    }
}