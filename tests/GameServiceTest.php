<?php

namespace Tests;

use Mockery;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use TicTacToe\Game;
use TicTacToe\GameService;

class GameServiceTest extends TestCase
{
    /** @var GameService * */
    private $gameService;

    public function setUp()
    {
        $this->gameService = new GameService;
    }

    public function testRunGameWhenGameIsFinished()
    {
        $helper = Mockery::mock(QuestionHelper::class);
        $input = Mockery::mock(InputInterface::class);
        $output = Mockery::mock(OutputInterface::class)
            ->shouldReceive('writeLn')
            ->with('End of a game')
            ->once()
            ->getMock();

        $game = Mockery::mock(Game::class)
            ->shouldReceive('displayBoard')
            ->with($output)
            ->once()
            ->shouldReceive('isGameFinished')
            ->andReturn(true)
            ->getMock();

        $response = $this->gameService->runGame($input, $output, $helper, $game);
        $this->assertEquals(null, $response);
    }
}
