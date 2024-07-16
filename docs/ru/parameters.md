# Параметры запроса


Параметры запроса могут быть добавлены к методу (см. [Методы](methods.md)) с помощью `addParameter(Parameter $parameter)`.
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

```json
{
    "openapi": "3.0.0",
    "info": {
        "title": "Ozon",
        "version": "1.0.0",
        "description": "Ozon API documentation"
    },
    "servers": [],
    "paths": {
        "/api/v1/products": {
            "get": {
                "tags": [
                    "Продукты"
                ],
                "operationId": "6696bd5cd8ce3",
                "parameters": [
                    {
                        "in": "query",
                        "required": true,
                        "deprecated": false,
                        "style": "form",
                        "explode": false,
                        "name": "page",
                        "description": "Номер страницы",
                        "example": 10,
                        "allowEmptyValue": false,
                        "allowReserved": false
                    },
                    {
                        "in": "query",
                        "required": true,
                        "deprecated": false,
                        "style": "form",
                        "explode": false,
                        "name": "limit",
                        "description": "Количество элементов на странице",
                        "example": 50,
                        "allowEmptyValue": false,
                        "allowReserved": false
                    }
                ],
                "summary": "Список продуктов",
                "description": "Получение списка продуктов"
            }
        },
        "/api/v1/products/{product}": {
            "get": {
                "tags": [
                    "Продукты"
                ],
                "operationId": "6696bd5cd9255",
                "parameters": [
                    {
                        "in": "path",
                        "required": true,
                        "deprecated": false,
                        "style": "simple",
                        "explode": false,
                        "name": "product",
                        "description": "Идентификатор продукта",
                        "example": 10
                    }
                ],
                "summary": "Информация о продукте"
            }
        }
    },
    "components": {
        "schemas": [],
        "parameters": []
    }
}
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

```json
{
    "openapi": "3.0.0",
    "info": {
        "title": "Ozon",
        "version": "1.0.0",
        "description": "Ozon API documentation"
    },
    "servers": [],
    "paths": {
        "/api/v1/products": {
            "get": {
                "tags": [
                    "Продукты"
                ],
                "operationId": "6696bd87ebd12",
                "parameters": [
                    {
                        "in": "query",
                        "required": true,
                        "deprecated": false,
                        "style": "form",
                        "explode": false,
                        "name": "page",
                        "description": "Номер страницы",
                        "example": 10,
                        "examples": {
                            "Example1": {
                                "summary": null,
                                "value": 1
                            },
                            "Example2": {
                                "summary": null,
                                "value": 10
                            }
                        },
                        "allowEmptyValue": false,
                        "allowReserved": false
                    }
                ],
                "summary": "Список продуктов",
                "description": "Получение списка продуктов"
            }
        }
    },
    "components": {
        "schemas": [],
        "parameters": []
    }
}
```

## Глобальные параметры

Любой параметр вы можете заранее описать и добавить в список компонентов спецификации, 
которые в дальнейшем можно будет переиспользовать.

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

```json
{
    "openapi": "3.0.0",
    "info": {
        "title": "Ozon",
        "version": "1.0.0",
        "description": "Ozon API documentation"
    },
    "servers": [],
    "paths": {
        "/api/v1/products": {
            "get": {
                "tags": [
                    "Продукты"
                ],
                "operationId": "6696bda57ca9a",
                "parameters": [
                    {
                        "$ref": "#/components/parameters/pageNumberQuery"
                    }
                ],
                "summary": "Список продуктов",
                "description": "Получение списка продуктов"
            }
        }
    },
    "components": {
        "schemas": [],
        "parameters": {
            "pageNumberQuery": {
                "in": "query",
                "required": true,
                "deprecated": false,
                "style": "form",
                "explode": false,
                "name": "pageNumberQuery",
                "description": "Номер страницы",
                "example": 10,
                "examples": {
                    "Example1": {
                        "summary": null,
                        "value": 1
                    },
                    "Example2": {
                        "summary": null,
                        "value": 10
                    }
                },
                "allowEmptyValue": false,
                "allowReserved": false
            }
        }
    }
}
```

## Схемы в параметрах запроса (см. [Схемы](schema.md))

Любой параметр запроса может содержать схему, которая описывает тип данных параметра.

```php
use Somecode\OpenApi\Entities\Schema\IntegerSchema;
use Somecode\OpenApi\Entities\Parameter\QueryParameter;

$builder->addParameter(
    QueryParameter::create('pageNumberQuery')
        ->description('Номер страницы')
        ->required()
        ->example(10)
        ->schema(
            IntegerSchema::create()
                ->minimum(1)
                ->maximum(100)
        )
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

```json
{
    "openapi": "3.0.0",
    "info": {
        "title": "Ozon",
        "version": "1.0.0",
        "description": "Ozon API documentation"
    },
    "servers": [],
    "paths": {
        "/api/v1/products": {
            "get": {
                "tags": [
                    "Продукты"
                ],
                "operationId": "6696be482414d",
                "parameters": [
                    {
                        "$ref": "#/components/parameters/pageNumberQuery"
                    }
                ],
                "summary": "Список продуктов",
                "description": "Получение списка продуктов"
            }
        }
    },
    "components": {
        "schemas": [],
        "parameters": {
            "pageNumberQuery": {
                "in": "query",
                "required": true,
                "deprecated": false,
                "style": "form",
                "explode": false,
                "name": "pageNumberQuery",
                "description": "Номер страницы",
                "schema": {
                    "type": "integer",
                    "minimum": 1,
                    "maximum": 100
                },
                "example": 10,
                "allowEmptyValue": false,
                "allowReserved": false
            }
        }
    }
}
```

## Описание доступных методов

Согласно спецификации OpenAPI, параметры могут включать в себя различные свойства, такие как:

- `description(?string $description)`
- `required(bool $required = true)`
- `schema(Schema $schema)` (см. [Схемы](schema.md))
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
