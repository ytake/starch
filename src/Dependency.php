<?php
declare(strict_types=1);

namespace Ytake\Starch;

use ReflectionClass;
use function is_null;
use function count;

final class Dependency extends AbstractDependency
{
    /**
     * @param ReflectionClass $reflection
     * @param array $args
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
     * @throws \ReflectionException
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
