<?php

class Car
{
    private string $model;
    private string $year;
    private string $color;

    public function setModel(string $model): void
    {
        $this->model = $model;
    }

    public function setYear(string $year): void
    {
        $this->year = $year;
    }

    public function setColor(string $color): void
    {
        $this->color = $color;
    }

    public function __toString()
    {
        return "Model: $this->model, Year: $this->year, Color: $this->color";
    }
}

class CarBuilder
{
    private Car $car;

    public function __construct()
    {
        $this->car = new Car();
    }

    public function setModel(string $model): static
    {
        $this->car->setModel($model);

        return $this;
    }

    public function setYear(string $year): static
    {
        $this->car->setYear($year);

        return $this;
    }

    public function setColor(string $color): static
    {
        $this->car->setColor($color);

        return $this;
    }

    public function build(): Car
    {
        return $this->car;
    }
}

$builder = new CarBuilder();

$car = $builder->setModel('BMW')
    ->setYear('2021')
    ->setColor('Black')
    ->build();

echo $car;