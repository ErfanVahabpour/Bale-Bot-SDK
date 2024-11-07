<?php

namespace EFive\Bale\Objects;

/**
 * Class Document.
 *
 * @link https://docs.bale.ai/#document
 *
 * @property string $file_id Unique file identifier.
 * @property string $file_unique_id Unique identifier for this file, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file.
 * @property PhotoSize|null $thumbnail (Optional). Document thumbnail as defined by sender.
 * @property string|null $file_name (Optional). Original filename as defined by sender.
 * @property string|null $mime_type (Optional). MIME type of the file as defined by sender.
 * @property int|null $file_size (Optional). File size.
 */
class Document extends BaseObject
{
    /**
     * {@inheritdoc}
     *
     * @return array{thumbnail: string}
     */
    public function relations(): array
    {
        return [
            'thumbnail' => PhotoSize::class,
        ];
    }
}