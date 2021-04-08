<?php

declare(strict_types=1);

namespace Ytake\Starch;

interface ProviderInterface
{
    /**
     * @param Container $container
     * @return object
     */
    public function get(
        Container $container
    ): object;
}
