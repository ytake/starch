<?php

declare(strict_types=1);

namespace Ytake\Starch;

use ReflectionClass;

/**
 * @template T of object
 */
final class Reflection
{
    /**
     * @param ReflectionClass<T> $class
     * @param string[] $typehintTexts
     */
    public function __construct(
        private ReflectionClass $class,
        private array $typehintTexts
    ) {
    }

    /**
     * @return ReflectionClass<T>
     */
    public function getClass(): ReflectionClass
    {
        return $this->class;
    }

    /**
     * @return string[]
     */
    public function getTypehintTexts(): array
    {
        return $this->typehintTexts;
    }
}
