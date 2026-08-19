<?php

namespace EFive\Bale\Objects;

/**
 * Class WebAppInfo.
 *
 * @link https://docs.bale.ai/#webappinfo
 *
 * @property string $url An HTTPS URL of a Web App to be opened with additional data.
 */
class WebAppInfo extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }
}
