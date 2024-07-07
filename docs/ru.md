# OpenAPI Builder

OpenAPI Builder - это пакет для создания [OpenAPI спецификаций](https://swagger.io/specification/) в формате YAML или JSON. 
Он предоставляет простой и удобный набор классов для описания API.

⚠️ **Внимание!** Пакет находится в стадии разработки и может содержать ошибки и недоработки.

ℹ️ Пакет изначально создавался для личного использования автора, но впоследствии было принято решение выложить его в открытый доступ.
Спецификация OpenAPI является сложной и многофункциональной, поэтому в пакете могут отсутствовать некоторые возможности.
Мы постараемся добавить их в будущих версиях, но вы также можете сделать это самостоятельно, создав Pull Request.
Не стесняйтесь задавать вопросы и предлагать идеи в разделе [Issues](https://github.com/somecode-pro/openapi-builder/issues).

## Установка

```bash
сomposer require somecode/openapi-builder
```

## Использование

### Builder

Концептуально, данный пакет является билдером OpenAPI спецификации. Для этого используется класс `Somecode\OpenApi\Builder`.

Чтобы проинициализировать его, достаточно создать экземпляр этого класса, конструктор которого принимает 3 аргумента:

- `string $title` - название спецификации (вашего API)
- `string $version` - версия спецификации
- `string $description` - описание спецификации

```php
use Somecode\OpenApi\Builder;

$builder = new Builder(
    title: 'Озон API документация',
    version: '1.0.0',
    description: 'Документация внутреннего API сервиса Озон'
);
```

После этого `$builder` можно использовать для добавления различных элементов спецификации. 
Он имеет удобный fluent-интерфейс, что позволяет делать цепочки вызовов.

### Сервер

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

#### Параметры сервера

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
