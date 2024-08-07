# Builder

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

## Генерация JSON спецификации

Для генерации JSON спецификации используйте метод `toJson()`.

```php
use Somecode\OpenApi\Builder;

$builder = new Builder(
    title: 'Озон API документация',
    version: '1.0.0',
    description: 'Документация внутреннего API сервиса Озон'
);

$builder->toJson();
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
        "schemas": [],
        "parameters": []
    }
}
```

На данный момент поддерживается только JSON формат. В будущем планируется добавить поддержку YAML.
