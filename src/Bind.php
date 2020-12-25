<?php
declare(strict_types=1);

namespace Ytake\Starch;


class Bind
{
    /** @var int */
    private int $scope = Scope::SINGLETON;

    /** @var DependencyInterface|null */
    private ?DependencyInterface $bound;

    /**
     * @param Container $container
     * @param string $id
     * @param DependencyFactory $factory
     */
    public function __construct(
        private Container $container,
        private string $id,
        private DependencyFactory $factory
    ) {
    }

    /**
     * @param string $concrete
     * @return $this
     * @throws \ReflectionException
     */
    public function to(
        string $concrete
    ): self {
        $this->bound = $this->factory->makeInstance($concrete);
        $this->container->add($this);
        return $this;
    }

    /**
     * @param int $scope
     * @return $this
     */
    public function in(
        int $scope
    ): self {
        $this->scope = $scope;
        $this->container->add($this);
        return $this;
    }

    /**
     * @param ProviderInterface $provider
     * @return $this
     */
    public function provider(
        ProviderInterface $provider
    ): self {
        $this->bound = $this->factory->makeInstanceByProvider($provider);
        $this->container->add($this);
        return $this;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return DependencyInterface|null
     */
    public function getBound(): ?DependencyInterface
    {
        return $this->bound;
    }

    /**
     * @return int
     */
    public function getScope(): int
    {
        return $this->scope;
    }
}
