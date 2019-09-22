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

    public function getAvailableCells()
    {
        $availableCells = [0,1,2,3,4,5,6,7,8];
        for ($i = 0; $i < 9; $i++) {
            if (array_key_exists($i, $this->cells)) {
                unset($availableCells[$i]);
            }
        }

        return $availableCells;
    }

    public function isGameWonBy($playerMark)
    {
        foreach (self::WIN_CONDITIONS as $condition) {
            if ($this->cells[$condition[0]] === $playerMark && $this->cells[$condition[1]] === $playerMark && $this->cells[$condition[2]] === $playerMark) {
                return true;
            }
        }
    }

    public function isGameWinnableInNextTurnByPlayer(self $game, string $player): int
    {
        $availableMoves = $game->getAvailableCells();
        foreach ($availableMoves as $cellId) {
            $nextTurnCells = $game->getCells();
            $nextTurnCells[$cellId] = $player;
            $nextTurnGame = new Game($nextTurnCells);
            if ($nextTurnGame->isGameWonBy($player)) {
                return $cellId;
            }
        }

        return -1;
    }

    public function isGameFinished()
    {
        return count($this->cells) === 9;
    }

    public function displayBoard($output)
    {
        $board = new Board($this->cells);
        $board->displayBoard($output);
    }
}
