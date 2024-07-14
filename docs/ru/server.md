# Сервер

Для тестирования запросов, мы можем добавить один или более хостов, на котором будет развернут наш API.
Для добавления сервера, воспользуйтесь методом `addServer()` или `addServers()`.

`addServer()` принимает в качестве аргумента объект класса `Somecode\OpenApi\Entities\Server\Server`.
Как и многие другие элементы спецификации в данном пакете, этот класс имеет фабричный метод create()
который позволяет создать объект и сразу выполнить цепочку вызовов.

```php
use Somecode\OpenApi\Entities\Server\Server;

$builder->addServer(
    Server::create()
        ->url('https://api.ozon.ru')
        ->description('Production server')
);
```

Добавление сразу нескольких серверов можно сделать с помощью метода `addServers()`, который принимает массив объектов `Server`:

```php
use Somecode\OpenApi\Entities\Server\Server;

$builder->addServers([
    Server::create()
        ->url('https://api.ozon.ru')
        ->description('Production server'),
    Server::create()
        ->url('https://api.ozon-stage.ru')
        ->description('Stage server')
]);
```

## Параметры сервера

Каждый сервер может иметь дополнительные параметры, такие как переменные, которые могут быть использованы в путях,
описанных в спецификации. Для добавления переменных используйте метод `addVariable(Variable $variable)`
или `addVariables(array $variables)`, используя класс `Somecode\OpenApi\Entities\Server\Variable`.

```php
use Somecode\OpenApi\Entities\Server\Server;
use Somecode\OpenApi\Entities\Server\Variable;

$builder->addServer(
    Server::create()
        ->url('https://api.ozon.{region}')
        ->description('Production server')
        ->addVariable(
            Variable::create()
                ->name('region')
                ->description('Region code')
                ->default('ru')
                ->enum(['ru', 'kz', 'by'])
        )
);
```

Обратите внимание, что переменные могут быть использованы в путях, указанных в спецификации,
просто заключите имя переменной в фигурные скобки, как показано в примере выше (`https://api.ozon.{region}`).

Метод `enum(array|string $enum)` позволяет указать список допустимых значений переменной.
Помимо обычного массива, вы также можете передать путь до Enum-класса.

```php
use Somecode\OpenApi\Entities\Server\Server;
use Somecode\OpenApi\Entities\Server\Variable;

enum Region: string {
    case RU = 'ru';
    case KZ = 'kz';
    case BY = 'by';
}

$builder->addServer(
    Server::create()
        ->url('https://api.ozon.{region}')
        ->description('Production server')
        ->addVariable(
            Variable::create()
                ->name('region')
                ->description('Region code')
                ->default('ru')
                ->enum(Region::class) // будет сформирован массив ['ru', 'kz', 'by'], на основе значений Enum
        )
);
```

В случае, если вы используете анонимный Enum, то в качестве знаний массива будут использоваться названия кейсов.

```php
use Somecode\OpenApi\Entities\Server\Server;
use Somecode\OpenApi\Entities\Server\Variable;

enum Region {
    case RU;
    case KZ;
    case BY;
}

$builder->addServer(
    Server::create()
        ->url('https://api.ozon.{region}')
        ->description('Production server')
        ->addVariable(
            Variable::create()
                ->name('region')
                ->description('Region code')
                ->default('ru')
                ->enum(Region::class) // будет сформирован массив ['RU', 'KZ', 'BY']
        )
);
```
