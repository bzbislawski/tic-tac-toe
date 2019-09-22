<?php

namespace TicTacToe;

class Computer
{
    public function play(Game $game)
    {
        $movesScores = [];
        $availableCells = $game->getAvailableCells();

        $isNextTurnWinnableForComputer = $game->isGameWinnableInNextTurnByPlayer($game, Board::COMPUTER);
        $isNextTurnWinnableForHuman = $game->isGameWinnableInNextTurnByPlayer($game, Board::HUMAN);

        if ($isNextTurnWinnableForComputer > -1) {
            return $game->playerMove($isNextTurnWinnableForComputer, Board::COMPUTER);
        }

        if ($isNextTurnWinnableForHuman > -1) {
            return $game->playerMove($isNextTurnWinnableForHuman, Board::COMPUTER);
        }

        foreach ($availableCells as $cellId) {
            $movesScores[$cellId] = $this->minimax($game, $cellId);
        }

        $move = array_keys($movesScores, max($movesScores));

        return $game->playerMove($move[0], Board::COMPUTER);
    }

    private function minimax(Game $game, $cellId)
    {
        $computerMoveGame = $game->playerMove($cellId, Board::COMPUTER);
        if ($computerMoveGame->isGameWonBy(Board::COMPUTER)) {
            return 1;
        }

        $score = 0;
        foreach ($computerMoveGame->getAvailableCells() as $humanMoveCellId) {
            $humanMoveGame = $computerMoveGame->playerMove($humanMoveCellId, Board::HUMAN);
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
