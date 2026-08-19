<?php

namespace EFive\Bale\Events;

use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Events\Dispatcher as EventDispatcher;

interface EventDispatcherListenerContract
{
    public function subscribeTo(string $event, callable $listener, int $priority = 0): void;

    public function dispatch(object $event): object;
}
