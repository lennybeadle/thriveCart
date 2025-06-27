<?php
declare(strict_types=1);

namespace Acme;

final class InMemoryProductCatalogue implements ProductCatalogueInterface
{
    /** @var Product[] */
    private array $products;

    public function __construct(array $products)
    {
        $this->products = [];
        foreach ($products as $product) {
            $this->products[$product->code] = $product;
        }
    }

    public function getProductByCode(string $code): ?Product
    {
        return $this->products[$code] ?? null;
    }
}