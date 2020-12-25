<?php
declare(strict_types=1);

namespace Tests;

class Any implements AnyInterface
{
    /**
     * @param Mock $mock
     */
    public function __construct(
        private Mock $mock
    ) {
    }
}
