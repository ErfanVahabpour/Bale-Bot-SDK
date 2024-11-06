<?php

namespace EFive\Bale\Objects;

/**
 * Class ChatPhoto.
 *
 * @link https://docs.bale.ai/#chatphoto
 *
 * @property string $small_file_id Identifier for small sized photo (160×160). This identifier is only available until the photo have not been changed.
 * @property string $small_file_unique_id Unique identifier for small sized photo (160×160). This identifier is only available until the photo have not been changed.
 * @property string $big_file_id Identifier for big sized photo (640×640). This identifier is only available until the photo have not been changed.
 * @property string $big_file_unique_id Unique identifier for big sized photo (640×640). This identifier is only available until the photo have not been changed.
 */
class ChatPhoto extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }
}