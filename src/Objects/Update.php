<?php

namespace EFive\Bale\Objects;

use Illuminate\Support\Collection;

/**
 * Class Update.
 *
 * @link https://docs.bale.ai/#update
 *
 * @property int $update_id The update's unique identifier. Update identifiers start from a certain positive number and increase sequentially.
 * @property Message|null $message (Optional). New incoming message of any kind - text, photo, sticker, etc.
 * @property EditedMessage|null $edited_message (Optional). New version of a message that is known to the bot and was edited.
 * @property CallbackQuery|null $callback_query (Optional). Incoming callback query.
 */
class Update extends BaseObject
{
    /** @var string|null Cached type of thr Update () */
    protected ?string $updateType = null;

    /**
     * @var string[]
     */
    protected const TYPES = [
        'message',
        'edited_message',
        'inline_query',
        'callback_query',
    ];

    /**
     * {@inheritdoc}
     *
     * @return array{message: string, edited_message: string, callback_query: string}
     */
    public function relations(): array
    {
        return [
            'message' => Message::class,
            'edited_message' => Message::class,
            'callback_query' => CallbackQuery::class,
        ];
    }

    /**
     * @deprecated Will be removed in SDK v4
     * Get recent message.
     */
    public function recentMessage(): self
    {
        return new self($this->last());
    }

    /**
     * Determine if the update is of given type.
     */
    public function isType(string $type): bool
    {
        if ($this->has(strtolower($type))) {
            return true;
        }

        return $this->detectType() === $type;
    }

    /**
     * Update type.
     */
    public function objectType(): ?string
    {
        if ($this->updateType === null) {
            $isWebAppData = (bool) $this->getMessage()->get('web_app_data');
            $updateType = $this->except('update_id')->keys()->first();

            $this->updateType = $isWebAppData ? 'web_app_data' : $updateType;
        }

        return $this->updateType;
    }

    /**
     * Detect type based on properties.
     */
    public function detectType(): ?string
    {
        return $this->keys()
            ->intersect(static::TYPES)
            ->pop();
    }

    /**
     * Get the message contained in the Update.
     */
    public function getMessage(): Collection
    {
        return match ($this->detectType()) {
            'message' => $this->message,
            'edited_message' => $this->editedMessage,
            'callback_query' => $this->callbackQuery->has('message') ? $this->callbackQuery->message : collect(),
            default => collect(),
        };
    }

    /**
     * Get the message contained in the Update.
     */
    public function getRelatedObject(): Message|CallbackQuery
    {
        return $this->{$this->objectType()};
    }

    /**
     * Get chat object (if exists).
     */
    public function getChat(): Collection
    {
        if ($this->has('my_chat_member')) { // message is not available in such case
            return $this->myChatMember->chat;
        }

        if ($this->has('chat_boost')) { // message is not available in such case
            return $this->chat_boost->chat;
        }

        $message = $this->getMessage();

        return $message->has('chat') ? $message->get('chat') : collect();
    }

    public function hasCommand(): bool
    {
        return (bool) $this->getMessage()->get('entities', collect())->contains('type', 'bot_command');
    }
}