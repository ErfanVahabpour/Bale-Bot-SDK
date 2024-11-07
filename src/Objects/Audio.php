<?php

namespace EFive\Bale\Objects;

/**
 * Class Audio.
 *
 * @link https://docs.bale.ai/#audio
 *
 * @property string $file_id Unique identifier for this file.
 * @property string $file_unique_id Unique identifier for this file, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file.
 * @property int $duration Duration of the audio in seconds as defined by sender.
 * @property string|null $title (Optional). Title of the audio as defined by sender or by audio tags.
 * @property string|null $file_name (Optional). Original filename as defined by sender.
 * @property string|null $mime_type (Optional). MIME type of the file as defined by sender.
 * @property int|null $file_size (Optional). File size.
 */
class Audio extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }
}