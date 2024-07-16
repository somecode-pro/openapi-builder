# Ответы

Любой метод может включать в себя ответы. 
Они описывают, что произойдет, если запрос выполнится успешно или с ошибкой.
Ответ всегда имеет код состояния, который указывает на результат выполнения запроса.
Кроме того, ответ может содержать тело.

Для описания ответа используется класс `Somecode\OpenApi\Entities\Response\Response`,
где вы можете указать код состояния, описание и содержимое ответа.

```php
use Somecode\OpenApi\Entities\Content\JsonContent;
use Somecode\OpenApi\Entities\Response\Response;

$builder->addPath(
    Path::create('/api/v1/products/{product}')
        ->addMethod(
            Post::create()
                ->tags(['Продукты'])
                ->summary('Информация о продукте')
                ->addParameter(
                    PathParameter::create('product')
                )
                ->addResponse(
                    Response::create(code: 200)
                        ->description('Успешный запрос')
                        ->addContent(
                            JsonContent::create()
                                ->schema(
                                    ObjectSchema::create()
                                        ->addProperties([
                                            IntegerSchema::create(name: 'id'),
                                            StringSchema::create(name: 'name'),
                                            IntegerSchema::create(name: 'price'),
                                            IntegerSchema::create(name: 'quantity'),
                                        ])
                                )
                        )
                )
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
        "/api/v1/products/{product}": {
            "post": {
                "tags": [
                    "Продукты"
                ],
                "operationId": "6696c9194077c",
                "parameters": [
                    {
                        "in": "path",
                        "required": true,
                        "deprecated": false,
                        "style": "simple",
                        "explode": false,
                        "name": "product"
                    }
                ],
                "summary": "Информация о продукте",
                "responses": {
                    "200": {
                        "description": "Успешный запрос",
                        "content": {
                            "application/json": {
                                "schema": {
                                    "type": "object",
                                    "properties": {
                                        "id": {
                                            "type": "integer"
                                        },
                                        "name": {
                                            "type": "string"
                                        },
                                        "price": {
                                            "type": "integer"
                                        },
                                        "quantity": {
                                            "type": "integer"
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    },
    "components": {
        "schemas": [],
        "parameters": []
    }
}
```

Также, как и в случае с телом запроса (см. [Тело запроса](request-body.md)), 
вы можете использовать классы `JsonContent` и `FormContent` для описания содержимого ответа.


Вы также можете использовать готовые методы, для описания кода ответа. На данный момент доступны:

- `Response::ok()` - код 200
- `Response::notFound()` - код 404
- `Response::badRequest()` - код 400
- `Response::serverError()` - код 500
- `Response::forbidden()` - код 403
- `Response::unauthorized()` - код 401

## Общие методы

- `description(string $description)`
- `addHeader(Header $header)`
- `addHeaders(array $headers)`
- `addContent(Content $content)`
- `addContents(array $contents)`

