<?php

namespace Classes;

class Vehicle
{
    private string $name;
    private int $maxSpeed;

    public function __construct(string $name, int $maxSpeed)
    {
        $this->name = $name;
        $this->maxSpeed = $maxSpeed;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getMaxSpeed(): int
    {
        return $this->maxSpeed;
    }
}
