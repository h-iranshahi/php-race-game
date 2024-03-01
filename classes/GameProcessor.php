<?php

namespace Classes;

class GameProcessor
{
    private array $vehicles;

    public function __construct(string $jsonFilePath)
    {
        $this->vehicles = $this->loadVehiclesFromJson($jsonFilePath);
    }

    private function loadVehiclesFromJson(string $jsonFilePath): array
    {
        $vehicles = [];
        $jsonData = file_get_contents($jsonFilePath);
        if ($jsonData !== false) {
            $data = json_decode($jsonData, true);
            if (is_array($data)) {
                foreach ($data as $vehicleData) {
                    if (isset($vehicleData['name'], $vehicleData['maxSpeed'])) {
                        $vehicles[] = new Vehicle($vehicleData['name'], $vehicleData['maxSpeed']);
                    }
                }
            }
        }
        return $vehicles;
    }

    public function start()
    {
        \cli\out("%yWelcome to the Racing Game!\n%n", 'green');
        \cli\out("Select your vehicle for player 1\n");

        foreach ($this->vehicles as $index => $vehicle) {
            \cli\out("{$index}. {$vehicle->getName()} (Max Speed: {$vehicle->getMaxSpeed()} km/h)\n");
        }

        $selected = \cli\prompt('Enter the number of vehicle for player 1');

        if (!isset($this->vehicles[$selected])) {
            \cli\err("Invalid selection. Please try again.\n");
            return;
        }

        $vehicle1 = $this->vehicles[$selected];

        \cli\out('%bYou selected: ' . $vehicle1->getName() . "\n%n");


        \cli\out("Select your vehicle for player 2\n");

        foreach ($this->vehicles as $index => $vehicle) {
            \cli\out("{$index}. {$vehicle->getName()} (Max Speed: {$vehicle->getMaxSpeed()} km/h)\n");
        }

        $selected = \cli\prompt('Enter the number of vehicle for player 2');

        if (!isset($this->vehicles[$selected])) {
            \cli\err("Invalid selection. Please try again.\n");
            return;
        }

        $vehicle2 = $this->vehicles[$selected];

        \cli\out('%bYou selected: ' . $vehicle2->getName() . "\n%n");

        $raceTime1 = $this->calculateRaceTime($vehicle1->getMaxSpeed());
        $raceTime2 = $this->calculateRaceTime($vehicle2->getMaxSpeed());

        \cli\out('Calculating race time...'."\n");
        \cli\out("Player 1 race time is: {$raceTime1} seconds"."\n");
        \cli\out("Player 2 race time is: {$raceTime2} seconds"."\n");
        \cli\out("%gPlayer ".($raceTime1 > $raceTime2 ? '2' : '1')." wins %n");

    }

    private function calculateRaceTime($speed)
    {
        $path = 5 ; // km
        return round(($path / $speed)*60*60);
    }

}
