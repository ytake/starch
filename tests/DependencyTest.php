<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use ReflectionClass;
use stdClass;
use Ytake\Starch\Container;
use Ytake\Starch\Dependency;
use Ytake\Starch\DependencyFactory;
use Ytake\Starch\Scope;

final class DependencyTest extends TestCase
{
    public function testShouldReturnSingletonInstance(): void
    {
        $dep = new Dependency(
            new ReflectionClass(stdClass::class),
            []
        );
        $result = $dep->resolve(
            new Container(new DependencyFactory()),
            Scope::SINGLETON
        );
        $this->assertInstanceOf(stdClass::class, $result);
    }
}
