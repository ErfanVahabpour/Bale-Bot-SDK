<?php

namespace EFive\Bale\Objects\InputMedia;

use EFive\Bale\FileUpload\InputFile;

/**
 * Class InputMediaDocument.
 *
 * Represents a general file to be sent.
 *
 * @link https://docs.bale.ai/#inputmediadocument
 *
 * @property string $type Type of the result, must be document.
 * @property string $media File to send. Pass a file_id to send a file that exists on the Bale servers (recommended), pass an HTTP URL for Bale to get a file from the Internet, or pass “attach://<file_attach_name>” to upload a new one using multipart/form-data under <file_attach_name> name.
 * @property InputFile|string|null $thumbnail (Optional). Thumbnail of the file sent. The thumbnail should be in JPEG format and less than 200 kB in size. A thumbnail‘s width and height should not exceed 90. Ignored if the file is not uploaded using multipart/form-data. Thumbnails can’t be reused and can be only uploaded as a new file, so you can pass “attach://<file_attach_name>” if the thumbnail was uploaded using multipart/form-data under <file_attach_name>
 * @property string|null $caption (Optional). Caption of the document to be sent, 0-200 characters
 */
class InputMediaDocument extends InputMedia
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