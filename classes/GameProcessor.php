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
        return 'hello';
    }

}
