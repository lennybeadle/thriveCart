<?php
declare(strict_types=1);

namespace Acme;

interface DeliveryChargeStrategyInterface
{
    /**
     * @param float $subtotal
     * @return float Delivery charge to add to basket
     */
    public function getDeliveryCharge(float $subtotal): float;
}