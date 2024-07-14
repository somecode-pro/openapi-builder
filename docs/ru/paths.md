# Пути

Пути представляют собой набор конечных точек вашего API. Для добавления путей используйте метод `addPath(Path $path)`.
Класс `Somecode\OpenApi\Entities\Path` используется для описания маршрута.

```php
use Somecode\OpenApi\Entities\Path;

$builder->addPath(
    Path::create('/api/v1/products')
);
```

Вы также можете добавить сразу несколько путей с помощью метода `addPaths(array $paths)`:

```php
use Somecode\OpenApi\Entities\Path;

$builder->addPaths(
    Path::create('/api/v1/products'),
    Path::create('/api/v1/products/{product}'),
    Path::create('/api/v1/orders'),
    Path::create('/api/v1/orders/{order}')
);
```
