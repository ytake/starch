<?php
declare(strict_types=1);

namespace Tests;

use Ytake\Starch\Container;
use Ytake\Starch\ProviderInterface;

final class AnyProvider implements ProviderInterface
{
    /**
     * @param Container $container
     * @return Any
     * @throws \Ytake\Starch\Exception\IdentifierNotFoundException
     */
    public function get(
        Container $container
    ): Any {
        return new Any($container->get(Mock::class));
    }
}
