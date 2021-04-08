<?php

declare(strict_types=1);

namespace Ytake\Starch;

use ReflectionClass;
use ReflectionException;

use function array_map;
use function count;
use function is_null;

/**
 * @template T of object
 */
final class Dependency extends AbstractDependency
{
    /**
     * @param ReflectionClass<T> $reflection
     * @param string[] $args
     */
    public function __construct(
        private ReflectionClass $reflection,
        private array $args
    ) {
    }

    /**
     * @param Container $container
     * @param int $scope
     * @return object
     * @throws Exception\IdentifierNotFoundException
     * @throws ReflectionException
     */
    public function resolve(
        Container $container,
        int $scope
    ): object {
        if ($scope === Scope::SINGLETON) {
            if (!is_null($this->instance)) {
                return $this->shared();
            }
        }
        if (count($this->args)) {
            $this->instance = $this->reflection->newInstanceArgs(
                array_map(fn($arg) => $container->get($arg), $this->args)
            );
            return $this->instance;
        }
        $this->instance = $this->reflection->newInstance();
        return $this->instance;
    }
}
