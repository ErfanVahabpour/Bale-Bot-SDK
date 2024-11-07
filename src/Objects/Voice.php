<?php

namespace EFive\Bale\Objects;

/**
 * Class Voice.
 *
 * @link https://docs.bale.ai/#voice
 *
 * @property string $file_id Unique identifier for this file.
 * @property string $file_unique_id Unique identifier for this file, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file.
 */
class Voice extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }
}