<?php
declare(strict_types=1);

namespace Ytake\Starch;

use ReflectionClass;

final class Reflection
{
    /**
     * @param ReflectionClass $class
     * @param array<\ReflectionType> $typehintTexts
     */
    public function __construct(
        private ReflectionClass $class,
        private array $typehintTexts
    ) {
    }

    /**
     * @return ReflectionClass
     */
    public function getClass(): ReflectionClass
    {
        return $this->class;
    }

    /**
     * @return array
     */
    public function getTypehintTexts(): array
    {
        return $this->typehintTexts;
    }
}
