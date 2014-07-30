<?php

namespace GameOfLife;

class World
{
    const DEFAULT_LENGTH = 50;
    const DEFAULT_HEIGHT = 50;

    protected $length = self::DEFAULT_LENGTH;
    protected $height = self::DEFAULT_HEIGHT;
    protected $planet = array();

    public function init()
    {
        for ($height = 0; $height < $this->height; $height++) {
            for ($length = 0; $length <= $this->length; $length++) {
                $this->planet[$height][$length] = 0;
            }
        }
        return $this;
    }

    public function getPlanet()
    {
        return $this->planet;
    }
}
