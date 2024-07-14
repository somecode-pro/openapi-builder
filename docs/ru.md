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

- [Builder](ru/builder.md)
- [Сервер](ru/server.md)
- [Пути](ru/paths.md)
- [Методы](ru/methods.md)
- [Параметры запроса](ru/parameters.md)
- [Схемы](ru/schema.md)

### Параметры запроса


### Схемы

#### Использование схем в параметрах запроса

```php
use Somecode\OpenApi\Entities\Schema\NumberSchema;
use Somecode\OpenApi\Entities\Schema\StringSchema;

QueryParameter::create('pageNumberQuery')
    ->description('Номер страницы')
    ->required()
    ->example(10)
    ->schema(
        NumberSchema::create()
            ->minimum(1)
            ->maximum(100)
            ->default(1)
    );

QueryParameter::create('status')
    ->schema(
        StringSchema::create()
            ->enum(['active', 'inactive'])
    );
```

#### Глобальные схемы

Любую именованную схему вы можете добавить в список компонентов спецификации, которые в дальнейшем можно будет переиспользовать.

```php
use Somecode\OpenApi\Entities\Schema\ObjectSchema;

$productSchema = ObjectSchema::create(name: 'Product')
    ->addProperties([
        NumberSchema::create(name: 'id'),
        NumberSchema::create(name: 'price'),
        NumberSchema::create(name: 'quantity'),
    ]);

$builder->addSchema($productSchema);
```

Для `ObjectSchema`:

- `addProperty(Schema $schema)`
- `addProperties(array $schemas)`
- `requiredFields(array $array)`
- `minProperties(int $minProperties)`
- `maxProperties(int $maxProperties)`

Для `ArraySchema`:

- `minItems(int $minItems)`
- `maxItems(int $maxItems)`
- `uniqueItems(bool $uniqueItems = true)`
- `itemsSchema(Schema|string $schema)`

### Тело запроса

Тело запроса описывает структуру данных, передаваемых в запросе. 
Для добавления тела запроса используйте метод `requestBody(RequestBody $body)`.

```php
use Somecode\OpenApi\Entities\Request\RequestBody;
use Somecode\OpenApi\Entities\Content\JsonContent;

$builder->addPaths([
    Path::create('/api/v1/products/{product}')
        ->addMethods([
            Patch::create()
                ->addParameters([
                    PathParameter::create('product')
                        ->required(),
                ])
                ->requestBody(
                    RequestBody::create()
                        ->description('Тело запроса')
                        ->required()
                        ->addContent(
                            JsonContent::create()
                                ->schema(
                                    ObjectSchema::create()
                                        ->addProperties([
                                            NumberSchema::create(name: 'price'),
                                            NumberSchema::create(name: 'quantity'),
                                        ])
                                )
                        )
                ),
        ]),
]);
```

На данный момент поддерживается только JSON-формат и FormData. В будущем планируется добавить поддержку других форматов.
