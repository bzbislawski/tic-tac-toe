<?php

namespace TicTacToe;

class Game
{
    /** @var array */
    private $cells;

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
        if(count($this->cells) < 9) {
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
