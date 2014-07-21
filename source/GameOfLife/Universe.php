<?php

namespace GameOfLife;

class Universe
{
    const GLIDER_GUN = 'glider-gun';
    const VACANT     = 'empty';
    const DEAD       = 0;
    const ALIVE      = 1;

    protected $world  = array();
    protected $length = 25;
    protected $width  = 25;

    public function getWorld()
    {
        return $this->world;
    }

    public function setWidth($width)
    {
        $this->width = $width;
    }

    public function setLength($length)
    {
        $this->length = $length;
    }

    public function checkWorldSize($width, $length)
    {
        return $width >= $this->width && $length >= $this->length;
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

    public function createGliderGunWorld()
    {
        if ($this->checkWorldSize(15, 30)) {
            throw new \Exception('Unable to generate Glider Gun world is too small, please use at least width: 15 and length: 30', 1);
        }

        $world = $this->createEmptyWorld();

        $world[2][7]   = static::ALIVE;
        $world[2][8]   = static::ALIVE;
        $world[3][6]   = static::ALIVE;
        $world[4][5]   = static::ALIVE;
        $world[4][19]  = static::ALIVE;
        $world[4][23]  = static::ALIVE;
        $world[5][5]   = static::ALIVE;
        $world[5][18]  = static::ALIVE;
        $world[5][19]  = static::ALIVE;
        $world[5][22]  = static::ALIVE;
        $world[5][23]  = static::ALIVE;
        $world[6][5]   = static::ALIVE;
        $world[6][21]  = static::ALIVE;
        $world[6][22]  = static::ALIVE;
        $world[7][6]   = static::ALIVE;
        $world[7][21]  = static::ALIVE;
        $world[7][22]  = static::ALIVE;
        $world[7][23]  = static::ALIVE;
        $world[8][3]   = static::ALIVE;
        $world[8][7]   = static::ALIVE;
        $world[8][8]   = static::ALIVE;
        $world[8][21]  = static::ALIVE;
        $world[8][22]  = static::ALIVE;
        $world[9][2]   = static::ALIVE;
        $world[9][3]   = static::ALIVE;
        $world[9][18]  = static::ALIVE;
        $world[9][19]  = static::ALIVE;
        $world[10][19] = static::ALIVE;

        return $world;
    }

    public function initWorld($type = self::VACANT)
    {
        switch ($type) {
            case static::GLIDER_GUN:
                $this->world = $this->createGliderGunWorld();
                break;
            case static::VACANT:
            default:
                $this->world = $this->createEmptyWorld();
                break;
        }
    }
}
