<?php

namespace EFive\Bale\Objects;

/**
 * Class Animation.
 *
 * @link https://docs.bale.ai/#animation
 *
 * @property string $file_id Unique file identifier.
 * @property string $file_unique_id Unique identifier for this file, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file.
 * @property int $width Video width as defined by sender.
 * @property int $height Video height as defined by sender.
 * @property int $duration Duration of the video in seconds as defined by sender.
 * @property PhotoSize|null $thumbnail (Optional). Animation thumbnail as defined by sender.
 * @property string|null $file_name (Optional). Original animation filename as defined by sender.
 * @property string|null $mime_type (Optional). MIME type of the file as defined by sender.
 * @property int|null $file_size (Optional). File size.
 */
class Animation extends BaseObject
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