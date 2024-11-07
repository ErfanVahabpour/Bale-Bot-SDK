<?php

namespace EFive\Bale\Events;

use EFive\Bale\Api;
use EFive\Bale\Objects\Update;

final class UpdateEvent extends AbstractEvent implements HasEventName
{
    /**
     * @var string
     */
    public const NAME = 'update';

    public function __construct(
        public Api $bale,
        public Update $update,
        protected string $name = self::NAME
    ) {
    }

    public function eventName(): string
    {
        return $this->name;
    }

    public function getName(): string
    {
        return $this->name;
    }
}