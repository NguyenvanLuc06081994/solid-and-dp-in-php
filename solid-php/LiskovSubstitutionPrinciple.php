<?php

class Car
{
    public function drive(): string
    {
        return 'Driving a car';
    }
}

class ElectricCar extends Car
{
    public function drive(): string
    {
        return 'Driving an electric car';
    }
}

class Ship
{
    public function sail(): string
    {
        return "Đi thuyền";
    }
}

class ShipFactory extends CarFactory
{
    public function makeNewCar(): Car
    {
        return new Ship();
    }
}

class CarFactory
{
    public function makeNewCar(): Car
    {
        return new Car();
    }
}

function testCarFactory(): void
{
    $carFactory = new CarFactory();
    $car = $carFactory->makeNewCar();
    echo $car->drive();
}


testCarFactory();