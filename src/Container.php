<?php

declare(strict_types=1);

namespace Ytake\Starch;

use Psr\Container\ContainerInterface;
use Ytake\Starch\Exception\IdentifierNotFoundException;

use function array_key_exists;
use function sprintf;

class Container implements ContainerInterface
{
    /** @var array<class-string, Holder> */
    protected array $bindings = [];

    /**
     * @param DependencyFactory $factory
     */
    public function __construct(
        protected DependencyFactory $factory
    ) {
    }

    /**
     * @param class-string $id
     * @return Bind
     */
    public function bind(
        string $id
    ): Bind {
        return new Bind($this, $id, $this->factory);
    }

    /**
     * @param Bind $bind
     */
    public function add(
        Bind $bind
    ): void {
        $bound = $bind->getBound();
        if ($bound instanceof DependencyInterface) {
            $this->bindings[$bind->getId()] = new Holder(
                $bound,
                $bind->getScope()
            );
        }
    }

    /**
     * @param class-string $id
     * @return mixed
     * @throws IdentifierNotFoundException
     */
    public function get($id): mixed
    {
        if ($this->has($id)) {
            $bound = $this->bindings[$id];
            if ($bound->getDependency() instanceof DependencyInterface) {
                return $bound->getDependency()->resolve(
                    $this,
                    $bound->getScope()
                );
            }
        }
        throw new IdentifierNotFoundException(
            sprintf('Identifier "%s" is not binding.', $id)
        );
    }

    /**
     * @param string $id
     * @return bool
     */
    public function has($id): bool
    {
        return array_key_exists($id, $this->bindings);
    }

    /**
     * @param ServiceModuleInterface $module
     */
    public function registerModule(
        ServiceModuleInterface $module
    ): void {
        $module->provide($this);
    }

    /**
     * @return Holder[]
     */
    public function getBindings(): array
    {
        return $this->bindings;
    }
}
