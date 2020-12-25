<?php
declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use Ytake\Starch\Container;
use Ytake\Starch\DependencyFactory;
use Ytake\Starch\Exception\IdentifierNotFoundException;
use Ytake\Starch\Scope;

final class ContainerTest extends TestCase
{
    private DependencyFactory $factory;

    protected function setUp(): void
    {
        $this->factory = new DependencyFactory();
    }

    public function testShouldReturnPrototypeInstance(): void
    {
        $container = new Container($this->factory);
        $container->bind(Mock::class)
            ->to(Mock::class)
            ->in(Scope::PROTOTYPE);
        $this->assertNotSame(
            $container->get(Mock::class),
            $container->get(Mock::class)
        );
    }

    public function testShouldThrowNotBindingExceptionAtComplexPrototypeInstance(): void
    {
        $this->expectException(IdentifierNotFoundException::class);
        $this->expectExceptionMessage('Identifier "Tests\Mock" is not binding.');
        $container = new Container($this->factory);
        $container->bind(AnyInterface::class)
            ->to(Any::class)
            ->in(Scope::PROTOTYPE);
        $container->get(AnyInterface::class);
    }

    public function testShouldReturnComplexPrototypeInstance(): void
    {
        $container = new Container($this->factory);
        $container->bind(AnyInterface::class)
            ->to(Any::class)
            ->in(Scope::PROTOTYPE);
        $container->bind(Mock::class)
            ->to(Mock::class)
            ->in(Scope::PROTOTYPE);
        $this->assertInstanceOf(
            AnyInterface::class,
            $container->get(AnyInterface::class)
        );
    }

    public function testShouldReturnComplexPrototypeInstanceByProvider(): void
    {
        $container = new Container($this->factory);
        $container->bind(Mock::class)
            ->to(Mock::class)
            ->in(Scope::PROTOTYPE);
        $container->bind(Any::class)
            ->provider(new AnyProvider());
        $this->assertInstanceOf(
            AnyInterface::class,
            $container->get(Any::class)
        );
    }

    public function testShouldReturnNotSingletonInstanceByProvider(): void
    {
        $container = new Container($this->factory);
        $container->bind(Mock::class)
            ->to(Mock::class)
            ->in(Scope::SINGLETON);
        $container->bind(Any::class)
            ->provider(new AnyProvider())
            ->in(Scope::PROTOTYPE);
        $this->assertNotSame(
            $container->get(Any::class),
            $container->get(Any::class)
        );
        $this->assertSame(
            $container->get(Mock::class),
            $container->get(Mock::class)
        );
    }
}
