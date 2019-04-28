<?php

require __DIR__.'/vendor/autoload.php';

use Symfony\Component\Console\Application;
use TicTacToe\GameCommand;

$application = new Application();
$command = new GameCommand();

$application->add($command);
$application->setDefaultCommand($command->getName());

$application->run();
