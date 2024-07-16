# Пути

Пути представляют собой набор конечных точек вашего API. Для добавления путей используйте метод `addPath(Path $path)`.
Класс `Somecode\OpenApi\Entities\Path` используется для описания маршрута.

```php
use Somecode\OpenApi\Entities\Path;

$builder->addPath(
    Path::create('/api/v1/products')
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
        "/api/v1/products": []
    },
    "components": {
        "schemas": [],
        "parameters": []
    }
}
```

Вы также можете добавить сразу несколько путей с помощью метода `addPaths(array $paths)`:

```php
use Somecode\OpenApi\Entities\Path;

$builder->addPaths([
    Path::create('/api/v1/products'),
    Path::create('/api/v1/products/{product}'),
    Path::create('/api/v1/orders'),
    Path::create('/api/v1/orders/{order}')
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
        "/api/v1/products": [],
        "/api/v1/products/{product}": [],
        "/api/v1/orders": [],
        "/api/v1/orders/{order}": []
    },
    "components": {
        "schemas": [],
        "parameters": []
    }
}%
```
