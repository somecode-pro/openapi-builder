# Методы


Методы являются основой путей и описывают доступные операции.
Для добавления метода используйте метод `addMethod(Method $method)`.
Используйте один из классов методов, предоставляемых пакетом:

- `Somecode\OpenApi\Entities\Method\Get`
- `Somecode\OpenApi\Entities\Method\Post`
- `Somecode\OpenApi\Entities\Method\Put`
- `Somecode\OpenApi\Entities\Method\Patch`
- `Somecode\OpenApi\Entities\Method\Delete`

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
