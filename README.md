# Ytake\Starch

Dependency Injection Container For PHP.  
Not Supported Autowiring.

## Requirements

PHP 8.0 and above.

## Installation

Composer is the recommended installation method.  
To add Ytake\Starch to your project,  
add the following to your composer.json then re-run composer:

```json
{
  "require": {
    "ytake/starch": "^1.0"
  }
}
```

Run Composer commands using PHP like so:

```bash
$ composer install
```

or

```bash
$ composer require ytake/starch
```

## Usage

### First steps

#### Create Class

```php
interface AnyInterface {

}
```

```php
final class Any implements AnyInterface {
  // any
}
```

#### Bindings

```php
use Ytake\Starch\Container;
use Ytake\Starch\Scope;

$container = new Container();
$container->bind(AnyInterface::class)
  ->to(Mock::class)
  ->in(Scope::PROTOTYPE);
```

dependencies will be automatically resolved

```php
$container->get(AnyInterface::class);
```

### Scopes

use the `Ytake\Starch\Scope` class.

| const |    |
|-----------|----------|
| `Ytake\Starch\Scope::PROTOTYPE` | single instance |
| `Ytake\Starch\Scope::SINGLETON` | prototype instance  |

### Providers

use Ytake\Starch\ProviderInterface.

```php
use Ytake\Starch\ProviderInterface;

final class AnyProvider implements ProviderInterface {

  public function get(): AnyInterface {
    return new Any();
  }
}
```

```php
$container->bind(AnyInterface::class)
  ->provider(new AnyProvider();
```
