# Тело запроса

Любой метод (см. [Методы](methods.md)) может содержать тело запроса. 
Тело запроса добавляется с помощью метода `requestBody(RequestBody $requestBody)`,
где `$requestBody` - объект класса `Somecode\OpenApi\Entities\Request\RequestBody`.

```php
use Somecode\OpenApi\Entities\Method\Post;
use Somecode\OpenApi\Entities\Path;
use Somecode\OpenApi\Entities\Request\RequestBody;

$builder->addPath(
    Path::create('/api/v1/products')
        ->addMethod(
            Post::create()
                ->tags(['Продукты'])
                ->summary('Добавить продукт')
                ->description('Добавление нового продукта')
                ->requestBody(
                    RequestBody::create()
                        ->required()
                        ->description('Тело запроса')
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
        "/api/v1/products": {
            "post": {
                "tags": [
                    "Продукты"
                ],
                "operationId": "6696c161e0727",
                "parameters": [],
                "summary": "Добавить продукт",
                "description": "Добавление нового продукта",
                "requestBody": {
                    "description": "Тело запроса",
                    "required": true
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

Тело запроса может содержать объекты, массивы и примитивные типы данных.
На данный момент поддерживаются:

- `Somecode\OpenApi\Entities\Content\FormContent`
- `Somecode\OpenApi\Entities\Content\JsonContent`

## JsonContent

Для добавления тела запроса в формате JSON используйте класс `Somecode\OpenApi\Entities\Content\JsonContent`.

```php
use Somecode\OpenApi\Entities\Content\JsonContent;
use Somecode\OpenApi\Entities\Method\Post;
use Somecode\OpenApi\Entities\Path;
use Somecode\OpenApi\Entities\Request\RequestBody;
use Somecode\OpenApi\Entities\Schema\IntegerSchema;
use Somecode\OpenApi\Entities\Schema\ObjectSchema;
use Somecode\OpenApi\Entities\Schema\StringSchema;

$builder->addPath(
    Path::create('/api/v1/products')
        ->addMethod(
            Post::create()
                ->tags(['Продукты'])
                ->summary('Добавить продукт')
                ->description('Добавление нового продукта')
                ->requestBody(
                    RequestBody::create()
                        ->required()
                        ->description('Тело запроса')
                        ->addContent(
                            JsonContent::create()
                                ->schema(
                                    ObjectSchema::create()
                                        ->addProperties([
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
        "/api/v1/products": {
            "post": {
                "tags": [
                    "Продукты"
                ],
                "operationId": "6696c30ed001a",
                "parameters": [],
                "summary": "Добавить продукт",
                "description": "Добавление нового продукта",
                "requestBody": {
                    "description": "Тело запроса",
                    "required": true,
                    "content": {
                        "application/json": {
                            "schema": {
                                "type": "object",
                                "properties": {
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
    },
    "components": {
        "schemas": [],
        "parameters": []
    }
}
```

Для описания тела запроса используется схема (см. [Схемы](schema.md)).
Вы всегда можете использовать глобально определенные схемы.

```php
use Somecode\OpenApi\Entities\Content\JsonContent;
use Somecode\OpenApi\Entities\Method\Post;
use Somecode\OpenApi\Entities\Path;
use Somecode\OpenApi\Entities\Request\RequestBody;
use Somecode\OpenApi\Entities\Schema\IntegerSchema;
use Somecode\OpenApi\Entities\Schema\ObjectSchema;
use Somecode\OpenApi\Entities\Schema\StringSchema;

$storeProductSchema = ObjectSchema::create(name: 'StoreProduct')
    ->addProperties([
        StringSchema::create(name: 'name'),
        IntegerSchema::create(name: 'price'),
        IntegerSchema::create(name: 'quantity'),
    ]);

$builder->addSchema($storeProductSchema);

$builder->addPath(
    Path::create('/api/v1/products')
        ->addMethod(
            Post::create()
                ->tags(['Продукты'])
                ->summary('Добавить продукт')
                ->description('Добавление нового продукта')
                ->requestBody(
                    RequestBody::create()
                        ->required()
                        ->description('Тело запроса')
                        ->addContent(
                            JsonContent::create()
                                ->schema('StoreProduct')
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
        "/api/v1/products": {
            "post": {
                "tags": [
                    "Продукты"
                ],
                "operationId": "6696c3c5b837a",
                "parameters": [],
                "summary": "Добавить продукт",
                "description": "Добавление нового продукта",
                "requestBody": {
                    "description": "Тело запроса",
                    "required": true,
                    "content": {
                        "application/json": {
                            "schema": {
                                "$ref": "#/components/schemas/StoreProduct"
                            }
                        }
                    }
                }
            }
        }
    },
    "components": {
        "schemas": {
            "StoreProduct": {
                "type": "object",
                "properties": {
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
        },
        "parameters": []
    }
}
```

## FormContent

Для добавления тела запроса в формате `multipart/form-data` используйте класс `Somecode\OpenApi\Entities\Content\FormContent`.

```php
use Somecode\OpenApi\Entities\Content\FormContent;

$storeProductSchema = ObjectSchema::create(name: 'StoreProduct')
    ->addProperties([
        StringSchema::create(name: 'name'),
        IntegerSchema::create(name: 'price'),
        IntegerSchema::create(name: 'quantity'),
    ]);

$builder->addSchema($storeProductSchema);

$builder->addPath(
    Path::create('/api/v1/products')
        ->addMethod(
            Post::create()
                ->tags(['Продукты'])
                ->summary('Добавить продукт')
                ->description('Добавление нового продукта')
                ->requestBody(
                    RequestBody::create()
                        ->required()
                        ->description('Тело запроса')
                        ->addContent(
                            FormContent::create()
                                ->schema('StoreProduct')
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
        "/api/v1/products": {
            "post": {
                "tags": [
                    "Продукты"
                ],
                "operationId": "6696c47011307",
                "parameters": [],
                "summary": "Добавить продукт",
                "description": "Добавление нового продукта",
                "requestBody": {
                    "description": "Тело запроса",
                    "required": true,
                    "content": {
                        "multipart/form-data": {
                            "schema": {
                                "$ref": "#/components/schemas/StoreProduct"
                            }
                        }
                    }
                }
            }
        }
    },
    "components": {
        "schemas": {
            "StoreProduct": {
                "type": "object",
                "properties": {
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
        },
        "parameters": []
    }
}
```

## Несколько форматов

Тело запроса может содержать несколько форматов одновременно. Удобнее всего использовать метод `addContents(array $contents)`.

```php

use Somecode\OpenApi\Entities\Content\FormContent;
use Somecode\OpenApi\Entities\Content\JsonContent;

$storeProductSchema = ObjectSchema::create(name: 'StoreProduct')
    ->addProperties([
        StringSchema::create(name: 'name'),
        IntegerSchema::create(name: 'price'),
        IntegerSchema::create(name: 'quantity'),
    ]);

$builder->addSchema($storeProductSchema);

$builder->addPath(
    Path::create('/api/v1/products')
        ->addMethod(
            Post::create()
                ->tags(['Продукты'])
                ->summary('Добавить продукт')
                ->description('Добавление нового продукта')
                ->requestBody(
                    RequestBody::create()
                        ->required()
                        ->description('Тело запроса')
                        ->addContents([
                            FormContent::create()
                                ->schema('StoreProduct'),
                            JsonContent::create()
                                ->schema('StoreProduct')
                        ])
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
        "/api/v1/products": {
            "post": {
                "tags": [
                    "Продукты"
                ],
                "operationId": "6696c55ef1608",
                "parameters": [],
                "summary": "Добавить продукт",
                "description": "Добавление нового продукта",
                "requestBody": {
                    "description": "Тело запроса",
                    "required": true,
                    "content": {
                        "multipart/form-data": {
                            "schema": {
                                "$ref": "#/components/schemas/StoreProduct"
                            }
                        },
                        "application/json": {
                            "schema": {
                                "$ref": "#/components/schemas/StoreProduct"
                            }
                        }
                    }
                }
            }
        }
    },
    "components": {
        "schemas": {
            "StoreProduct": {
                "type": "object",
                "properties": {
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
        },
        "parameters": []
    }
}
```

## Примеры тела запроса

Любое тело запроса может содержать примеры. Примеры добавляются с 
помощью метода `addExample(ContentExample $example)` или `addExamples(array $examples)`.

Для описания примера используется класс `Somecode\OpenApi\Entities\Content\ContentExample`.

```php
use Somecode\OpenApi\Entities\Content\ContentExample;

$builder->addPath(
    Path::create('/api/v1/products')
        ->addMethod(
            Post::create()
                ->tags(['Продукты'])
                ->summary('Добавить продукт')
                ->description('Добавление нового продукта')
                ->requestBody(
                    RequestBody::create()
                        ->required()
                        ->description('Тело запроса')
                        ->addContent(
                            JsonContent::create()
                                ->schema('StoreProduct')
                                ->addExample(
                                    ContentExample::create(name: 'Example1')
                                        ->summary('Пример запроса')
                                        ->value([
                                            'name' => 'Товар',
                                            'price' => 100,
                                            'quantity' => 10,
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
    "/api/v1/products": {
      "post": {
        "tags": [
          "Продукты"
        ],
        "operationId": "6696c62161a1b",
        "parameters": [],
        "summary": "Добавить продукт",
        "description": "Добавление нового продукта",
        "requestBody": {
          "description": "Тело запроса",
          "required": true,
          "content": {
            "application/json": {
              "schema": {
                "$ref": "#/components/schemas/StoreProduct"
              },
              "examples": {
                "Example1": {
                  "summary": "Пример запроса",
                  "value": {
                    "name": "Товар",
                    "price": 100,
                    "quantity": 10
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
    "schemas": {
      "StoreProduct": {
        "type": "object",
        "properties": {
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
    },
    "parameters": []
  }
}
```

### Общие методы для `RequestBody`

- `description(string $description)`
- `required(bool $required = true)`
- `addContent(Content $content)`
- `addContents(array $contents)`

### Общие методы для `JsonContent` и `FormContent`

- `schema(Schema|string $schema)`
- `addExample(ContentExample $example)`
- `addExamples(array $examples)`

### Общие методы для `ContentExample`

- `name(string $name)`
- `summary(string $summary)`
- `value(mixed $value)`
