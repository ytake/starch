<?php

declare(strict_types=1);

namespace Tests;

use ReflectionException;
use Ytake\Starch\Container;
use Ytake\Starch\Scope;
use Ytake\Starch\ServiceModuleInterface;

final class RegisterService implements ServiceModuleInterface
{
    /**
     * @param Container $container
     * @throws ReflectionException
     */
    public function provide(
        Container $container
    ): void {
        $container->bind(Mock::class)
            ->to(Mock::class)
            ->in(Scope::SINGLETON);
    }
}
