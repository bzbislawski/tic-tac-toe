<?php

namespace TicTacToe;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class GameService
{
    public function runGame(InputInterface $input, OutputInterface $output, $helper, Game $game)
    {
        while (!$game->isGameFinished()) {

            $game->displayBoard($output);

            $question = new Question('Please enter the cell index [0-8]: ');

            do {
                $index = $helper->ask($input, $output, $question);

                $output->writeln('You have just selected: ' . $index);
            } while (!in_array((int) $index, Board::CELL_INDEXES));

            $newCells = $game->getCells();
            $newCells[$index] = Board::HUMAN;
            $newGame = new Game($newCells);
            $game = $newGame;

        }

        $game->displayBoard($output);
        $output->writeln('End of a game');
    }
}
