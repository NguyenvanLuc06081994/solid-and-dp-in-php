<?php

interface ShippingStrategy
{
    public function calculate($order): float;
}

class XanhSMShipping implements ShippingStrategy
{
    public function calculate($order): float
    {
        return 3.5;
    }
}

class GHNShipping implements ShippingStrategy
{
    public function calculate($order): float
    {
        return 2.5;
    }
}

class ViettelPostShipping implements ShippingStrategy
{
    public function calculate($order): float
    {
        return 4.5;
    }
}

class Order
{
    private ShippingStrategy $shippingStrategy;

    public function __construct(ShippingStrategy $shippingStrategy)
    {
        $this->shippingStrategy = $shippingStrategy;
    }

    public function setShippingStrategy(ShippingStrategy $shippingStrategy): void
    {
        $this->shippingStrategy = $shippingStrategy;
    }

    public function calculateShipping(): float
    {
        $order = [];

        return $this->shippingStrategy->calculate($order);
    }
}

$order = new Order(new XanhSMShipping());
echo "Shipping cost: " . $order->calculateShipping() . PHP_EOL;

$order->setShippingStrategy(new GHNShipping());
echo "Shipping cost: " . $order->calculateShipping() . PHP_EOL;

$order->setShippingStrategy(new ViettelPostShipping());
echo "Shipping cost: " . $order->calculateShipping() . PHP_EOL;