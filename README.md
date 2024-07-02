# Open API Builder

A package for convenient building and generation of Open API documentation.

## Status

⚠️ At this moment, the package is in development and is not ready for production use.

### Preview

```php
use Somecode\OpenApi\Builder;
use Somecode\OpenApi\Entities\Methods\Get;
use Somecode\OpenApi\Entities\Path;

$builder = new Builder(
    title: 'Ozon',
    version: '1.0.0',
    description: 'Ozon API documentation'
);

$builder->prefix('/api/v1');

$builder->addPath(
    Path::create('/products')
        ->addMethod(
            Get::create()
                ->tags(['Products'])
                ->summary('Get products list')
                ->parameters(...)
                ->responses(...)
        )
);

echo $builder->toJson();
```
