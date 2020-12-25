<?php
declare(strict_types=1);

namespace Ytake\Starch\Exception;

use Psr\Container\NotFoundExceptionInterface;

final class IdentifierNotFoundException extends \Exception implements NotFoundExceptionInterface
{
}
