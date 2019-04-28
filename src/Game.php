<?php

namespace TicTacToe;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Game extends Command
{
    public function configure()
    {
        $this->setName('play');
    }
    
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('hello world');
    }
}
