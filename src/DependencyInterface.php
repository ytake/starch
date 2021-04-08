<?php

declare(strict_types=1);

namespace Ytake\Starch;

interface DependencyInterface
{
    /**
     * @param Container $container
     * @param int $scope
     * @return object
     */
    public function resolve(
        Container $container,
        int $scope
    ): object;
}
