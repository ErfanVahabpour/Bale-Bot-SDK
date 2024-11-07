<?php

namespace EFive\Bale\Objects\InputMedia;

use EFive\Bale\Objects\BaseObject;

/**
 * Class InputMedia.
 *
 * @link https://docs.bale.ai/#inputmedia
 *
 * This object represents the content of a media message to be sent.
 */
class InputMedia extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
        ];
    }
}