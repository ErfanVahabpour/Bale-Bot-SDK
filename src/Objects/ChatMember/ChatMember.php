<?php

namespace EFive\Bale\Objects\ChatMember;

use EFive\Bale\Objects\BaseObject;
use EFive\Bale\Objects\User;

/**
 * Class ChatMember.
 *
 * @link https://docs.bale.ai/#chatmember
 *
 * @property string $status The member's status in the chat.
 * @property User $user Information about the user.
 */
class ChatMember extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'user' => User::class,
        ];
    }

    /**
     * Create the appropriate ChatMember subclass based on status.
     */
    public static function factory(array $data): self
    {
        return match ($data['status'] ?? null) {
            'creator' => new ChatMemberOwner($data),
            'administrator' => new ChatMemberAdministrator($data),
            'member' => new ChatMemberMember($data),
            'restricted' => new ChatMemberRestricted($data),
            default => new self($data),
        };
    }
}
