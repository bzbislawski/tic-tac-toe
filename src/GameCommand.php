<?php

namespace TicTacToe;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GameCommand extends Command
{
    public function configure()
    {
        $this->setName('play');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $gameService = new GameService();
        $helper = $this->getHelper('question');
        $gameService->runGame($input, $output, $helper, new Game([]));
    }
}
