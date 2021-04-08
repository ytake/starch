<?php

declare(strict_types=1);

namespace Ytake\Starch;

final class Scope
{
    public const PROTOTYPE = 0;
    public const SINGLETON = 1;

    private function __construct()
    {
    }
}
