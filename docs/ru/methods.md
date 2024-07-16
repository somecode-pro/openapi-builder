# Методы

Методы являются основой путей и описывают доступные операции.
Для добавления метода используйте метод `addMethod(Method $method)`.
Используйте один из классов методов, предоставляемых пакетом:

- `Somecode\OpenApi\Entities\Method\Get`
- `Somecode\OpenApi\Entities\Method\Post`
- `Somecode\OpenApi\Entities\Method\Put`
- `Somecode\OpenApi\Entities\Method\Patch`
- `Somecode\OpenApi\Entities\Method\Delete`

Любой метод добавляется в конкретный путь (см. [Пути](paths.md)). Например:

```php
use Somecode\OpenApi\Entities\Method\Get;

$builder->addPath(
    Path::create('/api/v1/products')
        ->addMethod(
            Get::create()
                ->tags(['Продукты'])
                ->summary('Список продуктов')
                ->description('Получение списка продуктов')
        )
);
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
                "operationId": "6696bb0ae230d",
                "parameters": [],
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

Вы также можете добавить сразу несколько методов с помощью метода `addMethods(array $methods)`:

```php
use Somecode\OpenApi\Entities\Method\Get;
use Somecode\OpenApi\Entities\Method\Post;

$builder->addPath(
    Path::create('/api/v1/products')
        ->addMethods([
            Get::create()
                ->tags(['Продукты'])
                ->summary('Список продуктов')
                ->description('Получение списка продуктов'),
            Post::create()
                ->tags(['Продукты'])
                ->summary('Добавить продукт')
                ->description('Добавление нового продукта'),
        ])
);
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
                "operationId": "6696bb29798f2",
                "parameters": [],
                "summary": "Список продуктов",
                "description": "Получение списка продуктов"
            },
            "post": {
                "tags": [
                    "Продукты"
                ],
                "operationId": "6696bb2979a1b",
                "parameters": [],
                "summary": "Добавить продукт",
                "description": "Добавление нового продукта"
            }
        }
    },
    "components": {
        "schemas": [],
        "parameters": []
    }
}
```

### Поддерживаемые методы

- `tags(array $tags)`
- `summary(?string $summary)`
- `description(?string $description)`
- `addParameter(Parameter $parameter)` (см. [Параметры](parameters.md))
- `addParameters(array $parameters)` (см. [Параметры](parameters.md))
- `addParameterRef(string $ref)` (см. [Параметры](parameters.md))
- `addParameterRefs(array $refs)` (см. [Параметры](parameters.md))
- `requestBody(RequestBody $requestBody)` (см. [Тело запроса](request-body.md))
- `addResponse(Response $response)` (см. [Ответы](responses.md))
- `addResponses(array $responses)` (см. [Ответы](responses.md))
