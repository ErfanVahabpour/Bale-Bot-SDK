<?php

namespace EFive\Bale\Tests\Unit;

use EFive\Bale\Objects\ChatMember\ChatMember;
use EFive\Bale\Objects\ChatMember\ChatMemberAdministrator;
use EFive\Bale\Objects\ChatMember\ChatMemberMember;
use EFive\Bale\Objects\ChatMember\ChatMemberOwner;
use EFive\Bale\Objects\ChatMember\ChatMemberRestricted;
use EFive\Bale\Objects\User;
use EFive\Bale\Tests\TestCase;

class ChatMemberTest extends TestCase
{
    public function test_factory_creates_owner(): void
    {
        $member = ChatMember::factory([
            'status' => 'creator',
            'is_anonymous' => false,
            'custom_title' => 'Founder',
            'user' => [
                'id' => 10,
                'is_bot' => false,
                'first_name' => 'Boss',
            ],
        ]);

        $this->assertInstanceOf(ChatMemberOwner::class, $member);
        $this->assertSame('creator', $member->status);
        $this->assertFalse($member->is_anonymous);
        $this->assertSame('Founder', $member->custom_title);
        $this->assertInstanceOf(User::class, $member->user);
        $this->assertSame(10, $member->user->id);
    }

    public function test_factory_creates_administrator(): void
    {
        $member = ChatMember::factory([
            'status' => 'administrator',
            'can_be_edited' => true,
            'is_anonymous' => false,
            'can_manage_chat' => true,
            'can_delete_messages' => true,
            'can_pin_messages' => true,
            'user' => [
                'id' => 20,
                'is_bot' => false,
                'first_name' => 'Admin',
            ],
        ]);

        $this->assertInstanceOf(ChatMemberAdministrator::class, $member);
        $this->assertSame('administrator', $member->status);
        $this->assertTrue($member->can_delete_messages);
        $this->assertTrue($member->can_pin_messages);
    }

    public function test_factory_creates_member(): void
    {
        $member = ChatMember::factory([
            'status' => 'member',
            'user' => [
                'id' => 30,
                'is_bot' => false,
                'first_name' => 'Regular',
            ],
        ]);

        $this->assertInstanceOf(ChatMemberMember::class, $member);
        $this->assertSame('member', $member->status);
    }

    public function test_factory_creates_restricted(): void
    {
        $member = ChatMember::factory([
            'status' => 'restricted',
            'is_member' => true,
            'can_send_messages' => false,
            'until_date' => 1700000000,
            'user' => [
                'id' => 40,
                'is_bot' => false,
                'first_name' => 'Muted',
            ],
        ]);

        $this->assertInstanceOf(ChatMemberRestricted::class, $member);
        $this->assertSame('restricted', $member->status);
        $this->assertFalse($member->can_send_messages);
        $this->assertSame(1700000000, $member->until_date);
    }
}
