<?php

namespace TicTacToe;

use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Output\OutputInterface;

class Board
{
    const CELL_INDEXES = [0, 1, 2, 3, 4, 5, 6, 7, 8];
    const HUMAN = 'x';
    const COMPUTER = 'o';

    /** @var array */
    private $cells;

    public function __construct(array $cells)
    {
        $this->cells = $cells;
    }

    public function displayBoard(OutputInterface $output)
    {
        // array map here maybe?
        foreach ($this->cells as $key => $value) {
            if ($this->cells[$key] === self::HUMAN) {
                $this->cells[$key] = '<fg=red>x</>';
            }
            if ($this->cells[$key] === self::COMPUTER) {
                $this->cells[$key] = '<fg=green>o</>';
            }
        }

        $table = new Table($output);

        $table
            ->setRows([
                [$this->cells[0], $this->cells[1], $this->cells[2]],
                new TableSeparator(),
                [$this->cells[3], $this->cells[4], $this->cells[5]],
                new TableSeparator(),
                [$this->cells[6], $this->cells[7], $this->cells[8]],
            ]);
        $table->render();
    }
}
