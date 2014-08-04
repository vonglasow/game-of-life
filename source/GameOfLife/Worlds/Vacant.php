<?php

namespace GameOfLife\Worlds;

class Vacant implements Planet
{
    protected $planet;

    public function create()
    {
        $this->planet = array_fill(
            0,
            static::DEFAULT_HEIGHT,
            array_fill(
                0,
                static::DEFAULT_LENGTH,
                0
            )
        );

        return $this;
    }
}
