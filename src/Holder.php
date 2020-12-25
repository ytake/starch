<?php
declare(strict_types=1);

namespace Ytake\Starch;

final class Holder
{
    /**
     * @param DependencyInterface $dependency
     * @param int $scope
     */
    public function __construct(
        private DependencyInterface $dependency,
        private int $scope
    ) {
    }

    /**
     * @return DependencyInterface
     */
    public function getDependency(): DependencyInterface
    {
        return $this->dependency;
    }

    /**
     * @return int
     */
    public function getScope(): int
    {
        return $this->scope;
    }
}
