<?php
declare(strict_types=1);

namespace Acme;

interface OfferStrategyInterface
{
    /**
     * @param Product[] $products
     * @return float Discount amount to subtract from basket total
     */
    public function apply(array $products): float;
}