<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use Ytake\Starch\Bind;
use Ytake\Starch\Container;
use Ytake\Starch\DependencyFactory;
use Ytake\Starch\Holder;
use Ytake\Starch\Scope;

final class BindTest extends TestCase
{
    private DependencyFactory $factory;

    protected function setUp(): void
    {
        $this->factory = new DependencyFactory();
    }

    public function testShouldReturnBindInstance(): void
    {
        $bind = new Bind(
            new Container($this->factory),
            InjectableStub::class,
            $this->factory
        );
        $this->assertInstanceOf(Bind::class, $bind);
    }

    public function testShouldBeSerializedBind(): void
    {
        $container = new Container($this->factory);
        $container->bind(InjectableStub::class)
            ->to(InjectableStub::class)
            ->in(Scope::PROTOTYPE);
        $binds = $container->getBindings();
        $this->assertCount(1, $binds);
        $this->assertContainsOnlyInstancesOf(Holder::class, $binds);
    }
}
