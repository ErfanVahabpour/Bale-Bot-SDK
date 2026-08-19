<?php

namespace EFive\Bale\Tests\Unit;

use EFive\Bale\Api;
use EFive\Bale\Events\AbstractEvent;
use EFive\Bale\Events\EventDispatcherFactory;
use EFive\Bale\Events\HasEventName;
use EFive\Bale\Events\IlluminateEventDispatcher;
use EFive\Bale\Events\UpdateEvent;
use EFive\Bale\Events\UpdateWasReceived;
use EFive\Bale\Objects\Update;
use EFive\Bale\Tests\TestCase;

class EventsTest extends TestCase
{
    public function test_event_dispatcher_factory_creates_illuminate_dispatcher(): void
    {
        $dispatcher = EventDispatcherFactory::create();

        $this->assertInstanceOf(IlluminateEventDispatcher::class, $dispatcher);
    }

    public function test_subscribe_and_dispatch_event(): void
    {
        $dispatcher = new IlluminateEventDispatcher();
        $received = false;

        $dispatcher->subscribeTo('custom.event', function ($event) use (&$received) {
            $received = true;
        });

        $event = new class implements HasEventName {
            public function eventName(): string
            {
                return 'custom.event';
            }
        };

        $dispatcher->dispatch($event);

        $this->assertTrue($received);
    }

    public function test_update_event_dispatching_on_api(): void
    {
        $api = new Api('test_token_123456');
        $receivedUpdate = null;

        $api->on('update', function (UpdateEvent $event) use (&$receivedUpdate) {
            $receivedUpdate = $event->update;
        });

        $update = new Update([
            'update_id' => 100,
            'message' => [
                'message_id' => 1,
                'date' => 1600000000,
                'text' => 'Hello',
                'chat' => ['id' => 1, 'type' => 'private'],
            ],
        ]);

        $api->eventDispatcher()->dispatch(new UpdateEvent($api, $update));

        $this->assertNotNull($receivedUpdate);
        $this->assertSame(100, $receivedUpdate->update_id);
    }
}
