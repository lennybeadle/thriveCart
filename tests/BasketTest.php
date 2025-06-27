<?php
declare(strict_types=1);

namespace Acme\Tests;

use PHPUnit\Framework\TestCase;
use Acme\{
    Product, InMemoryProductCatalogue, Basket,
    DeliveryChargeStrategy, BuyOneRedWidgetHalfPriceOffer
};

final class BasketTest extends TestCase
{
    private function createBasket(): Basket
    {
        $catalogue = new InMemoryProductCatalogue([
            new Product('R01', 'Red Widget', 32.95),
            new Product('G01', 'Green Widget', 24.95),
            new Product('B01', 'Blue Widget', 7.95),
        ]);
        return new Basket(
            $catalogue,
            new DeliveryChargeStrategy(),
            new BuyOneRedWidgetHalfPriceOffer()
        );
    }

    public function testExampleBaskets()
    {
        $basket = $this->createBasket();
        $basket->add('B01');
        $basket->add('G01');
        $this->assertEquals(37.85, $basket->total());

        $basket = $this->createBasket();
        $basket->add('R01');
        $basket->add('R01');
        $this->assertEquals(54.37, $basket->total());

        $basket = $this->createBasket();
        $basket->add('R01');
        $basket->add('G01');
        $this->assertEquals(60.85, $basket->total());

        $basket = $this->createBasket();
        $basket->add('B01');
        $basket->add('B01');
        $basket->add('R01');
        $basket->add('R01');
        $basket->add('R01');
        $this->assertEquals(98.27, $basket->total());
    }
}