<?php

namespace GameOfLife;

final class Cell
{
    private $state;
    private $position;

    public function __construct(Position $position, State $state)
    {
        $this->position = $position;
        $this->state    = $state;
    }
}
