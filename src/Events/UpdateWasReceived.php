<?php

namespace EFive\Bale\Events;

use EFive\Bale\Api;
use EFive\Bale\Objects\Update;

/**
 * Class UpdateWasReceived.
 */
final class UpdateWasReceived extends AbstractEvent
{
    /**
     * UpdateWasReceived constructor.
     */
    public function __construct(public Api $bale, public Update $update)
    {
    }

    public function eventName(): string
    {
        return self::class;
    }

    /**
     * Backwards compatibility method
     *
     * @deprecated use eventName instead
     */
    public function getName(): string
    {
        return self::class;
    }
}