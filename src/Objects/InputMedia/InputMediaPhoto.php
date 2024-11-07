<?php

namespace EFive\Bale\Objects\InputMedia;

/**
 * Class InputMediaPhoto.
 *
 * Represents a photo to be sent.
 *
 * @link https://docs.bale.ai/#inputmediaphoto
 *
 * @property string $type Type of the result, must be photo.
 * @property string $media File to send. Pass a file_id to send a file that exists on the Telegram servers (recommended), pass an HTTP URL for Telegram to get a file from the Internet, or pass “attach://<file_attach_name>” to upload a new one using multipart/form-data under <file_attach_name> name.
 * @property string|null $caption (Optional). Caption of the photo to be sent, 0-200 characters
 */
class InputMediaPhoto extends InputMedia
{
}