<?php

namespace TicTacToe;

class Computer
{
    public function play(Game $game)
    {
        $cells = $game->getCells();

        $movesScores = [];
        $availableCells = $game->getAvailableCells();

        $isNextTurnWinnableForComputer = $game->isGameWinnableInNextTurnByPlayer($game, Board::COMPUTER);
        $isNextTurnWinnableForHuman = $game->isGameWinnableInNextTurnByPlayer($game, Board::HUMAN);

        if ($isNextTurnWinnableForComputer > -1) {
            $cells[$isNextTurnWinnableForComputer] = Board::COMPUTER;
            return new Game($cells);        }

        if ($isNextTurnWinnableForHuman > -1) {
            $cells[$isNextTurnWinnableForHuman] = Board::COMPUTER;
            return new Game($cells);
        }

        foreach ($availableCells as $cellId) {
            $movesScores[$cellId] = $this->minimax($game, $cellId);
        }

        var_dump($movesScores);
        $move = array_keys($movesScores, max($movesScores));

        $cells[$move[0]] = Board::COMPUTER;
        return new Game($cells);
    }

    private function minimax(Game $game, $cellId)
    {
        $cells = $game->getCells();
        $cells[$cellId] = Board::COMPUTER;
        $computerMoveGame = new Game($cells);
        if ($computerMoveGame->isGameWonBy(Board::COMPUTER)) {
            return 1;
        }

        $score = 0;
        foreach ($computerMoveGame->getAvailableCells() as $humanMoveCellId) {
            $humanMoveCells = $cells;
            $humanMoveCells[$humanMoveCellId] = Board::HUMAN;
            $humanMoveGame = new Game($humanMoveCells);
            if ($humanMoveGame->isGameWonBy(Board::HUMAN)) {
                $score -= 1;
            } else {
                foreach ($humanMoveGame->getAvailableCells() as $moves) {
                    $score += $this->minimax($humanMoveGame, $moves);
                }
            }
        }

        return $score;
    }
}
