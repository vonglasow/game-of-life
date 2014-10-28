<?php

namespace GameOfLife;

class World
{
    const DEFAULT_LENGTH = 50;
    const DEFAULT_HEIGHT = 50;

    protected $length = self::DEFAULT_LENGTH;
    protected $height = self::DEFAULT_HEIGHT;
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

    public function writeOn($console)
    {
        $console->write($this->planet);
        return $this;
    }
}
