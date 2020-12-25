<?php
declare(strict_types=1);

namespace Ytake\Starch;

interface ServiceModuleInterface
{
    /**
     * @param Container $container
     */
    public function provide(
        Container $container
    ): void;
}
