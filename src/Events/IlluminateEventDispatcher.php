<?php

namespace EFive\Bale\Events;

use Illuminate\Events\Dispatcher;

class IlluminateEventDispatcher implements EventDispatcherListenerContract
{
    private Dispatcher $dispatcher;

    public function __construct(?Dispatcher $dispatcher = null)
    {
        $this->dispatcher = $dispatcher ?? new Dispatcher();
    }

    public function subscribeTo(string $event, callable $listener, int $priority = 0): void
    {
        $this->dispatcher->listen($event, $listener);
    }

    public function dispatch(object $event): object
    {
        $eventName = $event instanceof HasEventName ? $event->eventName() : get_class($event);

        $this->dispatcher->dispatch($eventName, [$event]);

        return $event;
    }

    public function getDispatcher(): Dispatcher
    {
        return $this->dispatcher;
    }
}
