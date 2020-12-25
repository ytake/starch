<?php
declare(strict_types=1);

namespace Ytake\Starch;

use ReflectionClass;
use ReflectionMethod;
use RuntimeException;

final class Injector
{
    /**
     * @param ReflectionClass $reflection
     */
    public function __construct(
        private ReflectionClass $reflection
    ) {
    }

    /**
     * @return Reflection
     */
    public function getReflectionClass(): Reflection
    {
        $arguments = [];
        $constructor = $this->reflection->getConstructor();
        if ($this->reflection->isInstantiable()) {
            if ($constructor instanceof ReflectionMethod) {
                if ($constructor->getNumberOfParameters() !== 0) {
                    foreach ($constructor->getParameters() as $parameter) {
                        $arguments[] = (string)$parameter->getType();
                    }
                    return new Reflection($this->reflection, $arguments);
                }
            }
            return new Reflection($this->reflection, []);
        }
        throw new RuntimeException('reflection error');
    }
}
