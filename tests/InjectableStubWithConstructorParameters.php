<?php

declare(strict_types=1);

namespace Tests;

class InjectableStubWithConstructorParameters
{
    /**
     * @param InjectableStub $stub
     * @param string $message
     */
    public function __construct(
        private InjectableStub $stub,
        private string $message
    ) {
    }
}
