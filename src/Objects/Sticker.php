<?php

namespace EFive\Bale\Objects;

/**
 * Class Sticker.
 *
 * @link https://docs.bale.ai/#sticker
 *
 * @property string $file_id Unique identifier for this file.
 * @property string $file_unique_id Unique identifier for this file, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file.
 * @property string $type can be 'regular' or 'mask'
 * @property int $width Sticker width.
 * @property int $height Sticker height.
 * @property int|null $file_size (Optional). File size.
 */
class Sticker extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }
}