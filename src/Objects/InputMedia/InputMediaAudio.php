<?php

namespace EFive\Bale\Objects\InputMedia;

use EFive\Bale\FileUpload\InputFile;

/**
 * Class InputMediaAudio.
 * Represents an audio file to be treated as music to be sent.
 *
 * @link https://docs.bale.ai/#inputmediaaudio
 *
 * @property string $type Type of the result, must be audio.
 * @property string $media File to send. Pass a file_id to send a file that exists on the Telegram servers (recommended), pass an HTTP URL for Telegram to get a file from the Internet, or pass “attach://<file_attach_name>” to upload a new one using multipart/form-data under <file_attach_name> name.
 * @property InputFile|string|null $thumbnail (Optional). Thumbnail of the file sent. The thumbnail should be in JPEG format and less than 200 kB in size. A thumbnail‘s width and height should not exceed 90. Ignored if the file is not uploaded using multipart/form-data. Thumbnails can’t be reused and can be only uploaded as a new file, so you can pass “attach://<file_attach_name>” if the thumbnail was uploaded using multipart/form-data under <file_attach_name>
 * @property string|null $caption (Optional). Caption of the audio to be sent, 0-200 characters
 * @property int|null $duration (Optional). Duration of the audio in seconds
 * @property string|null $performer (Optional). Performer of the audio
 * @property string|null $title (Optional). Title of the audio
 */
class InputMediaAudio extends InputMedia
{
    /**
     * {@inheritdoc}
     *
     * @return array{thumbnail: string}
     */
    public function relations(): array
    {
        return [
            'thumbnail' => InputFile::class,
        ];
    }
}