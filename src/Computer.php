<?php

namespace TicTacToe;

class Computer
{
    private $scores = [
        0 => 0,
        1 => 0,
        2 => 0,
        3 => 0,
        4 => 0,
        5 => 0,
        6 => 0,
        7 => 0,
        8 => 0,
    ];

    public function play(Game $game)
    {
        $cells = $game->getCells();

        $this->isGameWon($game);

        var_dump($this->scores);
        $move = array_keys($this->scores,max($this->scores));

        $cells[$move[0]] = Board::COMPUTER;
        return new Game($cells);
    }

    private function isGameWon(Game $game)
    {
        $availableCells = $game->getAvailableCells();
        foreach ($availableCells as $moveId) {
            $newCells = $game->getCells();
            $newCells[$moveId] = Board::COMPUTER;
            $newGame = new Game($newCells);
            if ($newGame->isGameWonBy(Board::COMPUTER)) {
                $this->scores[$moveId] += 10;
                break;
            } else {
                $this->isGameWon($newGame);
            }
        }
    }
}
