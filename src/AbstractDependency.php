<?php

declare(strict_types=1);

namespace Ytake\Starch;

use LogicException;

use function is_null;

abstract class AbstractDependency implements DependencyInterface
{
    /** @var object|null */
    protected ?object $instance = null;

    /**
     * @return object
     */
    protected function shared(): object
    {
        if (!is_null($this->instance)) {
            return $this->instance;
        }
        throw new LogicException(
            'there is an error in the method of specifying the object'
        );
    }
}
