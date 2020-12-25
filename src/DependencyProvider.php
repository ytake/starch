<?php
declare(strict_types=1);

namespace Ytake\Starch;

use function is_null;

final class DependencyProvider extends AbstractDependency
{
    /**
     * @param ProviderInterface $provider
     */
    public function __construct(
        private ProviderInterface $provider
    ) {
    }

    /**
     * @param Container $container
     * @param int $scope
     * @return object
     */
    public function resolve(
        Container $container,
        int $scope
    ): object {
        if ($scope === Scope::SINGLETON) {
            if (!is_null($this->instance)) {
                return $this->shared();
            }
        }
        $this->instance = $this->provider->get($container);
        return $this->instance;
    }
}
