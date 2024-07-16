# Схемы

Схемы используются для описания структуры данных. Существует несколько типов схем `string`, `number`, `integer`, `boolean`, `array`, `object`.
Под каждый из них есть свой класс:

- `Somecode\OpenApi\Entities\Schema\StringSchema`
- `Somecode\OpenApi\Entities\Schema\NumberSchema`
- `Somecode\OpenApi\Entities\Schema\IntegerSchema`
- `Somecode\OpenApi\Entities\Schema\BooleanSchema`
- `Somecode\OpenApi\Entities\Schema\ArraySchema`
- `Somecode\OpenApi\Entities\Schema\ObjectSchema`

В зависимости от ситуации, вы можете использовать один из них.

## Общие методы

- `name(string $name)`
- `description(string $description)`
- `example(mixed $example)`
- `default(mixed $default)`
- `markAsRequired()`

## String

```php
use Somecode\OpenApi\Entities\Schema\StringSchema;

StringSchema::create()
    ->description('Статус ответа')
    ->enum(['ok', 'error']);
```

```json
{
    "type": "string",
    "description": "Статус ответа",
    "enum": [
        "ok",
        "error"
    ]
}
```

```php
use Somecode\OpenApi\Entities\Schema\StringSchema;

StringSchema::create()
    ->description('Дата')
    ->useDateFormat();
```

```json
{
    "type": "string",
    "description": "Дата",
    "format": "date"
}
```

Полный список методов, поддерживаемых `StringSchema`, смотрите ниже.

- `minLength(int $minLength)`
- `maxLength(int $maxLength)`
- `pattern(string $pattern)`
- `useBinaryFormat()`
- `useByteFormat()`
- `useDateFormat()`
- `useDateTimeFormat()`
- `usePasswordFormat()`
- `enum(array|string $enum)`

## Number

```php
use Somecode\OpenApi\Entities\Schema\NumberSchema;

NumberSchema::create()
    ->description('Сумма')
    ->minimum(1.0)
    ->maximum(100.0)
    ->useFloatFormat();
```

```json
{
    "type": "number",
    "description": "Сумма",
    "format": "float",
    "minimum": 1,
    "maximum": 100
}
```

Полный список методов, поддерживаемых `NumberSchema`, смотрите ниже.

- `useDoubleFormat()`
- `useFloatFormat()`
- `enum(array|string $enum)`
- `maximum(int|float $maximum)`
- `minimum(int|float $minimum)`

## Integer

```php
use Somecode\OpenApi\Entities\Schema\IntegerSchema;

IntegerSchema::create()
    ->description('Идентификатор')
    ->minimum(1)
    ->useInt64Format();
```

```json
{
    "type": "integer",
    "description": "Идентификатор",
    "format": "int64",
    "minimum": 1
}
```

Полный список методов, поддерживаемых `IntegerSchema`, смотрите ниже.

- `enum(array|string $enum)`
- `maximum(int|float $maximum)`
- `minimum(int|float $minimum)`
- `useInt32Format()`
- `useInt64Format()`

## Object 

В отличие от других схем, `ObjectSchema` имеет дополнительные методы для описания свойств объекта.
Используйте методы `addProperty(Schema $schema)` или `addProperties(array $schemas)`, 
которые принимают схему или массив схем соответственно.

```php
use Somecode\OpenApi\Entities\Schema\IntegerSchema;
use Somecode\OpenApi\Entities\Schema\NumberSchema;
use Somecode\OpenApi\Entities\Schema\ObjectSchema;

ObjectSchema::create(name: 'Product')
    ->description('Продукт')
    ->addProperties([
        IntegerSchema::create(name: 'id'),
        StringSchema::create(name: 'name')->markAsRequired(),
        NumberSchema::create(name: 'price')->markAsRequired(),
        IntegerSchema::create(name: 'quantity'),
        StringSchema::create(name: 'createdAt')->useDateTimeFormat(),
    ]);
```

```json
{
  "type": "object",
  "description": "Продукт",
  "properties": {
    "id": {
      "type": "integer"
    },
    "name": {
      "type": "string"
    },
    "price": {
      "type": "number"
    },
    "quantity": {
      "type": "integer"
    },
    "createdAt": {
      "type": "string",
      "format": "date-time"
    }
  },
  "required": [
    "name",
    "price"
  ]
}
```

Вы также можете добавлять вложенные объекты.

```php
use Somecode\OpenApi\Entities\Schema\IntegerSchema;
use Somecode\OpenApi\Entities\Schema\NumberSchema;
use Somecode\OpenApi\Entities\Schema\ObjectSchema;

ObjectSchema::create(name: 'Product')
    ->description('Продукт')
    ->addProperties([
        IntegerSchema::create(name: 'id'),
        StringSchema::create(name: 'name')->markAsRequired(),
        NumberSchema::create(name: 'price')->markAsRequired(),
        IntegerSchema::create(name: 'quantity'),
        StringSchema::create(name: 'createdAt')->useDateTimeFormat(),
        ObjectSchema::create(name: 'category')
            ->addProperties([
                IntegerSchema::create(name: 'id'),
                StringSchema::create(name: 'name'),
            ]),
    ]);
```

```json
{
    "type": "object",
    "description": "Продукт",
    "properties": {
        "id": {
            "type": "integer"
        },
        "name": {
            "type": "string"
        },
        "price": {
            "type": "number"
        },
        "quantity": {
            "type": "integer"
        },
        "createdAt": {
            "type": "string",
            "format": "date-time"
        },
        "category": {
            "type": "object",
            "properties": {
                "id": {
                    "type": "integer"
                },
                "name": {
                    "type": "string"
                }
            }
        }
    },
    "required": [
        "name",
        "price"
    ]
}
```

Полный список методов, поддерживаемых `ObjectSchema`, смотрите ниже.

- `addProperty(Schema $schema)`
- `addProperties(array $schemas)`
- `requiredFields(array $array)`
- `minProperties(int $minProperties)`
- `maxProperties(int $maxProperties)`

## Array

```php
use Somecode\OpenApi\Entities\Schema\ArraySchema;
use Somecode\OpenApi\Entities\Schema\StringSchema;

ArraySchema::create()
    ->description('Список имен')
    ->itemsSchema(
        StringSchema::create()
            ->description('Имя')
    )->example(['Игорь', 'Ярослав', 'Михаил']);
```

```json
{
    "type": "array",
    "description": "Список имен",
    "example": [
        "Игорь",
        "Ярослав",
        "Михаил"
    ],
    "items": {
        "type": "string",
        "description": "Имя"
    }
}
```

Пример с массивом объектов.

```php
ArraySchema::create()
    ->description('Список продуктов')
    ->itemsSchema(
        ObjectSchema::create(name: 'Product')
            ->description('Продукт')
            ->addProperties([
                IntegerSchema::create(name: 'id'),
                StringSchema::create(name: 'name')->markAsRequired(),
                NumberSchema::create(name: 'price')->markAsRequired(),
                IntegerSchema::create(name: 'quantity'),
                StringSchema::create(name: 'createdAt')->useDateTimeFormat(),
                ObjectSchema::create(name: 'category')
                    ->addProperties([
                        IntegerSchema::create(name: 'id'),
                        StringSchema::create(name: 'name'),
                    ]),
            ])
    );
```

```json
{
    "type": "array",
    "description": "Список продуктов",
    "items": {
        "type": "object",
        "description": "Продукт",
        "properties": {
            "id": {
                "type": "integer"
            },
            "name": {
                "type": "string"
            },
            "price": {
                "type": "number"
            },
            "quantity": {
                "type": "integer"
            },
            "createdAt": {
                "type": "string",
                "format": "date-time"
            },
            "category": {
                "type": "object",
                "properties": {
                    "id": {
                        "type": "integer"
                    },
                    "name": {
                        "type": "string"
                    }
                }
            }
        },
        "required": [
            "name",
            "price"
        ]
    }
}
```

Полный список методов, поддерживаемых `ArraySchema`, смотрите ниже.

- `minItems(int $minItems)`
- `maxItems(int $maxItems)`
- `uniqueItems(bool $uniqueItems = true)`
- `itemsSchema(Schema|string $schema)`

## Глобальные схемы

Любую именованную схему вы можете добавить в список компонентов спецификации, которые в дальнейшем можно будет переиспользовать.

```php

use Somecode\OpenApi\Builder;
use Somecode\OpenApi\Entities\Schema\ArraySchema;
use Somecode\OpenApi\Entities\Schema\IntegerSchema;
use Somecode\OpenApi\Entities\Schema\NumberSchema;
use Somecode\OpenApi\Entities\Schema\ObjectSchema;
use Somecode\OpenApi\Entities\Schema\StringSchema;

$builder = new Builder(
    title: 'Ozon',
    version: '1.0.0',
    description: 'Ozon API documentation'
);

$categorySchema = ObjectSchema::create(name: 'Category')
    ->description('Категория')
    ->addProperties([
        IntegerSchema::create(name: 'id'),
        StringSchema::create(name: 'name')->markAsRequired(),
    ]);

$productSchema = ObjectSchema::create(name: 'Product')
    ->description('Продукт')
    ->addProperties([
        IntegerSchema::create(name: 'id'),
        StringSchema::create(name: 'name')->markAsRequired(),
        NumberSchema::create(name: 'price')->markAsRequired(),
        IntegerSchema::create(name: 'quantity'),
        StringSchema::create(name: 'createdAt')->useDateTimeFormat(),
        ObjectSchema::create(name: 'category')
            ->ref('Category'),
    ]);

$productsListSchema = ArraySchema::create(name: 'ProductsList')
    ->description('Список продуктов')
    ->itemsSchema(schema: 'Product');

$builder->addSchemas([
    $categorySchema,
    $productSchema,
    $productsListSchema,
]);

echo $builder->toJson();
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
    "paths": [],
    "components": {
        "schemas": {
            "Category": {
                "type": "object",
                "description": "Категория",
                "properties": {
                    "id": {
                        "type": "integer"
                    },
                    "name": {
                        "type": "string"
                    }
                },
                "required": [
                    "name"
                ]
            },
            "Product": {
                "type": "object",
                "description": "Продукт",
                "properties": {
                    "id": {
                        "type": "integer"
                    },
                    "name": {
                        "type": "string"
                    },
                    "price": {
                        "type": "number"
                    },
                    "quantity": {
                        "type": "integer"
                    },
                    "createdAt": {
                        "type": "string",
                        "format": "date-time"
                    },
                    "category": {
                        "$ref": "#/components/schemas/Category"
                    }
                },
                "required": [
                    "name",
                    "price"
                ]
            },
            "ProductsList": {
                "type": "array",
                "description": "Products",
                "items": {
                    "$ref": "#/components/schemas/Product"
                }
            }
        },
        "parameters": []
    }
}
```
