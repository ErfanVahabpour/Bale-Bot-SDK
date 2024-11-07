<?php

namespace EFive\Bale\Objects;

/**
 * Class PhotoSize.
 *
 * @link https://docs.bale.ai/#photosize
 *
 * @property string $file_id Unique identifier for this file.
 * @property string $file_unique_id Unique identifier for this file, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file.
 * @property int $width Photo width.
 * @property int $height Photo height.
 * @property int|null $file_size (Optional). File size.
 */
class PhotoSize extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }
}