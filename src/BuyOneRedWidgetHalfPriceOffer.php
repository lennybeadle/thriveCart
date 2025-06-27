<?php
declare(strict_types=1);

namespace Acme;

use Acme\OfferStrategyInterface;

final class BuyOneRedWidgetHalfPriceOffer implements OfferStrategyInterface
{
    public function apply(array $products): float
    {
        $redWidgets = array_values(array_filter($products, fn(Product $p) => $p->code === 'R01'));
        $count = count($redWidgets);
        $discount = 0.0;

        if ($count < 2) {
            return 0.0;
        }

        $redWidgetPrice = $count > 0 ? $redWidgets[0]->price : 0.0;
        $pairs = intdiv($count, 2);
        $discount = $pairs * ($redWidgetPrice / 2);

        return $discount;
    }
}