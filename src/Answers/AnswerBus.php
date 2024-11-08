<?php

namespace EFive\Bale\Answers;

use BadMethodCallException;
use Illuminate\Contracts\Container\Container;
use EFive\Bale\Traits\Bale;

/**
 * Class AnswerBus.
 */
abstract class AnswerBus
{
    use Bale;

    /**
     * Handle calls to missing methods.
     *
     * @return mixed
     *
     * @throws BadMethodCallException
     */
    public function __call(string $method, array $parameters)
    {
        if (method_exists($this, $method)) {
            return $this->$method(...$parameters);
        }

        throw new BadMethodCallException(sprintf('Method [%s] does not exist.', $method));
    }

    /**
     * Use PHP Reflection and Laravel Container to instantiate the answer with type hinted dependencies.
     */
    protected function buildDependencyInjectedClass(object|string $class): object
    {
        if (is_object($class)) {
            return $class;
        }

        if (! $this->bale->hasContainer()) {
            return new $class();
        }

        $container = $this->bale->getContainer();

        if ($container instanceof Container) {
            return $container->make($class);
        }

        return $container->get($class);
    }
}