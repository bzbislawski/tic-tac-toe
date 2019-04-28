<?php

namespace TicTacToe;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class GameService
{
    public function runGame(InputInterface $input, OutputInterface $output, $helper, Game $game)
    {
        $game->displayBoard($output);

        $question = new Question('Please enter the cell index: ');

        $index = $helper->ask($input, $output, $question);
        $output->writeln('You have just selected: '.$index);

        $newCells = $game->getCells();
        $newCells[$index] = Board::HUMAN;
        $newGame = new Game($newCells);


        if (!$newGame->isGameFinished()) {
            $this->runGame($input, $output, $helper, $newGame);
        } else {
            $output->writeln('End of a game');
        }
    }

}