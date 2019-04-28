<?php

namespace TicTacToe;

class Computer
{
    public function play(Game $game)
    {
        $cells = $game->getCells();
        do  {
            $randomIndex = rand(0, 8);
        } while (array_key_exists($randomIndex, $cells));

        $cells[$randomIndex] = Board::COMPUTER;
        return new Game($cells);
    }
}
