<?php

interface Car
{
    public function cost(): int;

    public function description(): string;
}

class BasicCar implements Car
{
    public function cost(): int
    {
        return 10000;
    }

    public function description(): string
    {
        return "Basic Car";
    }
}

// Decorator

abstract class CarDecorator implements Car
{
    protected Car $car;

    public function __construct(Car $car)
    {
        $this->car = $car;
    }

    public function cost(): int
    {
        return $this->car->cost();
    }

    public function description(): string
    {
        return $this->car->description();
    }
}

// Concrete Decorators
class NavigationSystem extends CarDecorator
{
    public function cost(): int
    {
        return $this->car->cost() + 500;
    }

    public function description(): string
    {
        return $this->car->description() . ', Navigation System';
    }
}

class LeatherSeats extends CarDecorator
{
    public function cost(): int
    {
        return $this->car->cost() + 200;
    }

    public function description(): string
    {
        return $this->car->description() . ', Leather Seats';
    }
}

$basicCar = new BasicCar();
echo $basicCar->description() . ' costs ' . $basicCar->cost() . PHP_EOL;

$basicCarWithNavigation = new NavigationSystem($basicCar);
echo $basicCarWithNavigation->description() . ' costs ' . $basicCarWithNavigation->cost() . PHP_EOL;

$basicCarWithLeatherSeats = new LeatherSeats($basicCar);
echo $basicCarWithLeatherSeats->description() . ' costs ' . $basicCarWithLeatherSeats->cost() . PHP_EOL;

$basicCarWithNavigationAndLeatherSeats = new LeatherSeats($basicCarWithNavigation);
echo $basicCarWithNavigationAndLeatherSeats->description() . ' costs ' . $basicCarWithNavigationAndLeatherSeats->cost() . PHP_EOL;
