<?php

namespace EFive\Bale\Events;

abstract class AbstractEvent implements HasEventName
{
    abstract public function eventName(): string;
}
