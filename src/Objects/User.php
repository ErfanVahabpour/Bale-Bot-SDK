<?php

namespace EFive\Bale\Objects;

/**
 * Class User.
 *
 * @link https://docs.bale.ai/#user
 *
 * @property int $id Unique identifier for this user or bot.
 * @property bool $is_bot True, if this user is a bot
 * @property string $first_name User's or bot's first name.
 * @property string|null $last_name (Optional). User's or bot's last name.
 * @property string|null $username (Optional). User's or bot's username.
 * @property string|null $language_code (Optional). IETF language tag of the user's language
 */
class User extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }
}