# Параметры запроса


Параметры запроса могут быть добавлены к методу с помощью `addParameter(Parameter $parameter)`.
На данный момент поддерживаются только `Query` и `Path` параметры. Используйте следующие классы:

- `Somecode\OpenApi\Entities\Parameter\QueryParameter`
- `Somecode\OpenApi\Entities\Parameter\PathParameter`

```php
use Somecode\OpenApi\Entities\Parameter\QueryParameter;
use Somecode\OpenApi\Entities\Parameter\PathParameter;

$builder->addPaths([
    Path::create('/api/v1/products')
        ->addMethods([
            Get::create()
                ->tags(['Продукты'])
                ->summary('Список продуктов')
                ->description('Получение списка продуктов')
                ->addParameters([
                    QueryParameter::create('page')
                        ->description('Номер страницы')
                        ->required()
                        ->example(10),
                    QueryParameter::create('limit')
                        ->description('Количество элементов на странице')
                        ->required()
                        ->example(50),
                ]),
        ]),
    Path::create('/api/v1/products/{product}')
        ->addMethods([
            Get::create()
                ->tags(['Продукты'])
                ->summary('Информация о продукте')
                ->addParameters([
                    PathParameter::create('product')
                        ->description('Идентификатор продукта')
                        ->required()
                        ->example(10),
                ]),
        ]),
]);
```

## Примеры параметров

Метод `addExample(ParameterExample $example)` или `addExamples(array $examples)` позволяют добавить несколько примеров параметров.

```php
use Somecode\OpenApi\Entities\Parameter\ParameterExample;

$builder->addPaths([
    Path::create('/api/v1/products')
        ->addMethods([
            Get::create()
                ->tags(['Продукты'])
                ->summary('Список продуктов')
                ->description('Получение списка продуктов')
                ->addParameters([
                    QueryParameter::create('page')
                        ->description('Номер страницы')
                        ->required()
                        ->example(10)
                        ->addExamples([
                            ParameterExample::create()
                                ->name('Example1')
                                ->value(1),
                            ParameterExample::create()
                                ->name('Example2')
                                ->value(10)
                        ])
                ]),
        ]),
]);
```

## Глобальные параметры

Любой параметр вы можете заранее описать и добавить в список компонентов спецификации, которые в дальнейшем можно будет переиспользовать.

```php
$builder->addParameter(
    QueryParameter::create('pageNumberQuery')
        ->description('Номер страницы')
        ->required()
        ->example(10)
        ->addExamples([
            ParameterExample::create()
                ->name('Example1')
                ->value(1),
            ParameterExample::create()
                ->name('Example2')
                ->value(10),
        ]),
);

$builder->addPaths([
    Path::create('/api/v1/products')
        ->addMethods([
            Get::create()
                ->tags(['Продукты'])
                ->summary('Список продуктов')
                ->description('Получение списка продуктов')
                ->addParameterRef('pageNumberQuery'),
        ]),
]);
```

## Описание доступных методов

Согласно спецификации OpenAPI, параметры могут включать в себя различные свойства, такие как:

- `description(?string $description)`
- `required(bool $required = true)`
- `schema(Schema $schema)`
- `example(mixed $example)`
- `explode(bool $explode = true)`
- `deprecated(bool $deprecated = true)`

Для `QueryParameter`:

- `allowEmptyValue(bool $allowEmptyValue = true)`
- `allowReserved(bool $allowReserved = true)`
- `useDeepObjectStyle()`
- `useFormStyle()`
- `usePipeDelimitedStyle()`
- `useSpaceDelimitedStyle()`

Для `PathParameter`:

- `useLabelStyle()`
- `useMatrixStyle()`
- `useSimpleStyle()`
