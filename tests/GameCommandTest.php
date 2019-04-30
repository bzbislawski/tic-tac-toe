<?php

namespace Tests;

use Mockery;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Helper\HelperSet;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Output\OutputInterface;
use TicTacToe\Game;
use TicTacToe\GameCommand;
use TicTacToe\GameService;


class GameCommandTest extends TestCase
{
    /** @var GameCommand * */
    private $gameCommand;

    public function setUp()
    {
        $this->gameCommand = new GameCommand;
    }

    public function testExecute()
    {
        $input = Mockery::type(ArgvInput::class);
        $output = Mockery::type(OutputInterface::class);

        $helperSet = new HelperSet([new QuestionHelper()]);
        $this->gameCommand->setHelperSet($helperSet);
        $helper = $this->gameCommand->getHelperSet('question');

        $gameService = Mockery::mock(GameService::class);

        $gameService->shouldReceive('runGame')
            ->with($input, $output, $helper, Mockery::mock(Game::class));

        $this->gameCommand->execute($input, $output);
    }
}
