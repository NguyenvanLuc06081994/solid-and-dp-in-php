<?php
interface Command
{
    public function execute(): void;
}

class Light
{
    public function on(): void
    {
        echo "The light is on\n";
    }

    public function off(): void
    {
        echo "The light is off\n";
    }
}

class TurnOnLightCommand implements Command
{
    private Light $light;

    public function __construct(Light $light)
    {
        $this->light = $light;
    }
    public function execute(): void
    {
        $this->light->on();
    }
}

class TurnOffLightCommand implements Command
{
    private Light $light;

    public function __construct(Light $light)
    {
        $this->light = $light;
    }
    public function execute(): void
    {
        $this->light->off();
    }
}

class RemoteControl
{
    private Command $command;
    public function setCommand(Command $command)
    {
        $this->command = $command;
    }

    public function pressButton()
    {
        $this->command->execute();
    }
}

$light = new Light();
$turnOn = new TurnOnLightCommand($light);
$turnOff = new TurnOffLightCommand($light);

$remote = new RemoteControl();

//Turn on the light
$remote->setCommand($turnOn);
$remote->pressButton();

//Turn off the light
$remote->setCommand($turnOff);
$remote->pressButton();
