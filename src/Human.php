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

            $output->writeln('You have just selected: ' . $index);
        } while (!in_array((int) $index, Board::CELL_INDEXES) || array_key_exists($index, $game->getCells()));

        $newCells = $game->getCells();
        $newCells[$index] = Board::HUMAN;
        return new Game($newCells);
    }
}
