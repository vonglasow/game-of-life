<?php

namespace GameOfLife;

final class Position
{
    private $X;
    private $Y;

    public function __construct($x, $y)
    {
        $this->X = $x;
        $this->Y = $y;
    }

    public function __toString()
    {
        return 'X: ' . $this->X . 'Y: ' . $this->Y;
    }
}
