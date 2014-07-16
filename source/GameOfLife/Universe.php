<?php

namespace GameOfLife;

class Universe
{
    const DEAD = 0;
    const ALIVE = 1;
    protected $world = array();
    protected $length = 25;
    protected $width = 25;

    public function getWorld()
    {
        return $this->world;
    }

    public function createEmptyWorld()
    {
        $world = array();

        for ($coordX=0; $coordX < $this->length; $coordX++) {
            for ($coordY=0; $coordY < $this->width; $coordY++) {
                $world[$coordX][$coordY] = static::DEAD;
            }
        }

        return $world;
    }

    public function initWorld($type = 'empty')
    {
        switch ($type) {
            case 'empty':
            default:
                $this->world = $this->createEmptyWorld();
                break;
        }
    }
}
