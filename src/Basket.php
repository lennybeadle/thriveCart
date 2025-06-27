<?php
declare(strict_types=1);

namespace Acme;

use Acme\Product;
use Acme\ProductCatalogueInterface;
use Acme\DeliveryChargeStrategyInterface;
use Acme\OfferStrategyInterface;

final class Basket
{
    /** @var Product[] */
    private array $products = [];

    public function __construct(
        private ProductCatalogueInterface $catalogue,
        private DeliveryChargeStrategyInterface $deliveryStrategy,
        private OfferStrategyInterface $offerStrategy
    ) {}

    public function add(string $productCode): void
    {
        $product = $this->catalogue->getProductByCode($productCode);
        if ($product === null) {
            throw new \InvalidArgumentException("Product code $productCode not found");
        }
        $this->products[] = $product;
    }

    public function total(): float
    {
        $subtotal = array_sum(array_map(fn(Product $p) => $p->price, $this->products));
        $discount = $this->offerStrategy->apply($this->products);
        $delivery = $this->deliveryStrategy->getDeliveryCharge($subtotal - $discount);
        return round($subtotal - $discount + $delivery, 2);
    }
}