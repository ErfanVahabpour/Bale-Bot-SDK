<?php

namespace EFive\Bale\Exceptions;

final class BaleBotNotFoundException extends BaleSDKException
{
    public static function create(string $name): self
    {
        return new BaleBotNotFoundException(sprintf('Bot [%s] is not configured.', $name));
    }
}