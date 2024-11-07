<?php

namespace EFive\Bale\Objects;

/**
 * Class Location.
 *
 * @link https://docs.bale.ai/#location
 *
 * @property float $longitude Longitude as defined by sender.
 * @property float $latitude Latitude as defined by sender.
 */
class Location extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }
}