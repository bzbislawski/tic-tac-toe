<?php

namespace TicTacToe;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GameService
{
    public function runGame(InputInterface $input, OutputInterface $output, $helper, Game $game)
    {
        while (!$game->isGameFinished()) {

            $game->displayBoard($output);

            $human = new Human();
            $game = $human->play($input, $output, $helper, $game);

            if ($game->isGameWonBy(Board::HUMAN)) {
                $output->writeln('HUMAN is a winner!');
                break;
            }

            if ($game->isGameFinished()) {
                break;
            }

            $computer = new Computer();
            $game = $computer->play($game);

            if ($game->isGameWonBy(Board::COMPUTER)) {
                $output->writeln('COMPUTER is a winner!');
                break;
            }
        }

        $game->displayBoard($output);
        $output->writeln('End of a game');
    }
}
