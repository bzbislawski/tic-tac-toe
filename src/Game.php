<?php

namespace TicTacToe;

class Game
{
    /** @var array */
    private $cells;

    const WIN_CONDITIONS = [
        [0, 1, 2],
        [3, 4, 5],
        [6, 7, 8],
        [0, 3, 6],
        [1, 4, 7],
        [2, 5, 8],
        [0, 4, 8],
        [2, 4, 6],
    ];

    public function __construct(array $cells)
    {
        $this->cells = $cells;
    }

    public function getCells()
    {
        return $this->cells;
    }

    public function isGameFinished()
    {
        foreach (self::WIN_CONDITIONS as $condition) {
            if (($this->cells[$condition[0]] === Board::COMPUTER && $this->cells[$condition[1]] === Board::COMPUTER && $this->cells[$condition[2]] === Board::COMPUTER) ||
                ($this->cells[$condition[0]] === Board::HUMAN && $this->cells[$condition[1]] === Board::HUMAN && $this->cells[$condition[2]] === Board::HUMAN)) {
                return true;
            }
        }

        if (count($this->cells) < 9) {
            return false;
        }


        foreach ($this->cells as $cell) {
            if (empty($cell)) {
                return false;
            }
        }
        return true;
    }

    public function displayBoard($output)
    {
        $board = new Board($this->cells);
        $board->displayBoard($output);
    }
}
