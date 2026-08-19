<?php

namespace EFive\Bale\Objects;

/**
 * Class WebAppData.
 *
 * @link https://docs.bale.ai/#webappdata
 *
 * @property string $data The data. Be aware that a bad client can send arbitrary data in this field.
 * @property string $button_text Text of the web_app keyboard button from which the Web App was opened.
 */
class WebAppData extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }
}
