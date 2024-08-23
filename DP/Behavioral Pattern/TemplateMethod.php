<?php

abstract class OrderProcessor
{
    public function processOrder()
    {
        $this->selectProduct();
        $this->makePayment();
        $this->deliver();
    }

    abstract protected function selectProduct(): void;

    abstract protected function makePayment(): void;

    abstract protected function deliver(): void;
}

class OnlineOrderProcessor extends OrderProcessor
{
    protected function selectProduct(): void
    {
        echo "Product selected online\n";
    }

    protected function makePayment(): void
    {
        echo "Payment made online\n";
    }

    protected function deliver(): void
    {
        echo "Product delivered online\n";
    }
}

class InStoreOrderProcessor extends OrderProcessor
{
    protected function selectProduct(): void
    {
        echo "Product selected in store\n";
    }

    protected function makePayment(): void
    {
        echo "Payment made in store\n";
    }

    protected function deliver(): void
    {
        echo "Product delivered in store\n";
    }
}

$onlineOrder = new OnlineOrderProcessor();
echo "Processing online order:\n";
$onlineOrder->processOrder();

$inStoreOrder = new InStoreOrderProcessor();
echo "Processing in-store order:\n";
$inStoreOrder->processOrder();