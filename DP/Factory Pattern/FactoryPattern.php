<?php

class Dog
{
    public function speak(): string
    {
        return "Gau Gau";
    }
}

class Cat
{
    public function speak(): string
    {
        return "Meo Meo";
    }
}

class AnimalFactory
{
    /**
     * @throws Exception
     */
    public function createAnimal(string $type): Dog|Cat
    {
        return match ($type) {
            'dog' => new Dog(),
            'cat' => new Cat(),
            default => throw new Exception("Invalid animal type"),
        };
    }
}

$factory = new AnimalFactory();

$cat = $factory->createAnimal('cat');
$dog = $factory->createAnimal('dog');

echo $cat->speak();
echo "<br/>";
echo $dog->speak();

