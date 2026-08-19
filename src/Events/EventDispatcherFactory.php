<?php

namespace EFive\Bale\Events;

class EventDispatcherFactory
{
    public static function create(): EventDispatcherListenerContract
    {
        return new IlluminateEventDispatcher();
    }
}
