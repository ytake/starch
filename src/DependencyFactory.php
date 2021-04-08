<?php

declare(strict_types=1);

namespace Ytake\Starch;

use ReflectionClass;
use ReflectionException;

final class DependencyFactory
{
    /**
     * @param class-string $concrete
     * @return DependencyInterface
     * @throws ReflectionException
     */
    public function makeInstance(
        string $concrete
    ): DependencyInterface {
        $inject = new Injector(new ReflectionClass($concrete));
        $reflection = $inject->getReflectionClass();
        return new Dependency(
            $reflection->getClass(),
            $reflection->getTypehintTexts()
        );
    }

    /**
     * @param ProviderInterface $provider
     * @return DependencyInterface
     */
    public function makeInstanceByProvider(
        ProviderInterface $provider
    ): DependencyInterface {
        return new DependencyProvider($provider);
    }
}
