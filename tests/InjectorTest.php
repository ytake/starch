<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use Ytake\Starch\Injector;
use ReflectionClass;

final class InjectorTest extends TestCase
{
    public function testShouldReturnReflectionTuple(): void
    {
        $injector = new Injector(
            new \ReflectionClass(InjectableStub::class)
        );
        $reflection = $injector->getReflectionClass();
        $this->assertInstanceOf(\ReflectionClass::class, $reflection->getClass());
        $this->assertCount(0, $reflection->getTypehintTexts());
    }

    public function testShouldReturnReflectionTupleAtVec(): void
    {
        $injector = new Injector(
            new ReflectionClass(
                InjectableStubWithConstructorParameters::class
            )
        );
        $reflection = $injector->getReflectionClass();
        $this->assertSame(
            [
                InjectableStub::class,
                'string',
            ],
            $reflection->getTypehintTexts()
        );
    }
}
