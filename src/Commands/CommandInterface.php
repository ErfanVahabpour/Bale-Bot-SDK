<?php

namespace EFive\Bale\Commands;

use EFive\Bale\Api;
use EFive\Bale\Objects\Update;

/**
 * Interface CommandInterface.
 */
interface CommandInterface
{
    public function getName(): string;

    public function getAliases(): array;

    public function getDescription(): string;

    public function getArguments(): array;

    public function make(Api $bale, Update $update, array $entity);
}