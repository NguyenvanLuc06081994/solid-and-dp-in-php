<?php

interface Subject
{
    public function attach(Observer $observer): void;

    public function detach(Observer $observer): void;

    public function notify(): void;
}

interface Observer
{
    public function update(string $state): void;
}

class Order implements Subject
{
    private array $observers = [];

    private string $state;

    public function attach(Observer $observer): void
    {
        $this->observers[] = $observer;
    }

    public function detach(Observer $observer): void
    {
        $this->observers = array_filter($this->observers, fn($obs) => $obs !== $observer);
    }

    public function notify(): void
    {
        foreach ($this->observers as $observer) {
            $observer->update($this->state);
        }
    }

    public function setState(string $state): void
    {
        $this->state = $state;
        $this->notify();
    }

    public function getState(): string
    {
        return $this->state;
    }
}

class CustomerObserver implements Observer
{
    public function update(string $state): void
    {
        echo "Customer: Your order status has changed to $state.\n";
    }
}

class AdminObserver implements Observer
{
    public function update(string $state): void
    {
        echo "Admin: The order status has changed to $state.\n";
    }
}

class WarehouseObserver implements Observer
{
    public function update(string $state): void
    {
        echo "Warehouse: The order status has changed to $state.\n";
    }
}

$order = new Order();
$customerObserver = new CustomerObserver();
$adminObserver = new AdminObserver();
$warehouseObserver = new WarehouseObserver();

$order->attach($customerObserver);
$order->attach($adminObserver);
$order->attach($warehouseObserver);

$order->setState('shipped');
$order->setState('delivered');
