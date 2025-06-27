<?php
declare(strict_types=1);

namespace Acme;

interface ProductCatalogueInterface
{
    public function getProductByCode(string $code): ?Product;
}