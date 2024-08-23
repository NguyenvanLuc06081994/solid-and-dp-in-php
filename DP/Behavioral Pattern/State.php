<?php

interface OrderState
{
    public function getStatus(): string;

    public function allowProcessing(): bool;
}

class NewOrderState implements OrderState
{
    public function getStatus(): string
    {
        return 'New';
    }

    public function allowProcessing(): bool
    {
        return true;
    }
}

class ShippedOrderState implements OrderState
{
    public function getStatus(): string
    {
        return 'Shipped';
    }

    public function allowProcessing(): bool
    {
        return false;
    }
}

class Order
{
    private OrderState $state;

    public function __construct()
    {
        $this->state = new NewOrderState();
    }

    public function setSate(OrderState $state): void
    {
        $this->state = $state;
    }

    public function getStatus(): string
    {
        return $this->state->getStatus();
    }

    public function allowProcessing(): bool
    {
        return $this->state->allowProcessing();
    }
}

$order = new Order();
echo $order->getStatus() . PHP_EOL;
echo $order->allowProcessing() . PHP_EOL;

$shippedOrder = new ShippedOrderState();
$order->setSate($shippedOrder);
echo $order->getStatus() . PHP_EOL;
echo $order->allowProcessing() . PHP_EOL;