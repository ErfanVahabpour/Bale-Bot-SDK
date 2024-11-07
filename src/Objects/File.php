<?php

namespace EFive\Bale\Objects;

/**
 * Class File.
 *
 * @link https://docs.bale.ai/#file
 *
 * @property string $file_id Unique identifier for this file.
 * @property string $file_unique_id Unique identifier for this file, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file.
 * @property int|null $file_size (Optional). File size, if known.
 * @property string|null $file_path (Optional). File path. Use 'https://tapi.bale.ai/file/bot<token>/<file_path>' to get the file.
 */
class File extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }
}