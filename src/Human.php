<?php

namespace TicTacToe;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class Human
{
    public function play(InputInterface $input, OutputInterface $output, $helper, Game $game)
    {
        $question = new Question('Please enter the cell index [0-8]: ');

        do {
            $index = $helper->ask($input, $output, $question);

            $output->writeln('You just have selected: ' . $index);
        } while ($game->isMoveAvailable($index));

        return $game->playerMove($index, Board::HUMAN);
    }
}
