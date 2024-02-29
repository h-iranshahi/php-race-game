<?php

require_once __DIR__ . '/vendor/autoload.php';

$jsonFilePath = 'vehicles.json';

$game = new \Classes\GameProcessor($jsonFilePath);

$game->start();