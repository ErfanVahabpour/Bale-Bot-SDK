<?php

namespace EFive\Bale\Objects;

/**
 * Class CopyTextButton.
 *
 * @link https://docs.bale.ai/#copytextbutton
 *
 * @property string $text The text to be copied to the clipboard; 1-256 characters.
 */
class CopyTextButton extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }
}
