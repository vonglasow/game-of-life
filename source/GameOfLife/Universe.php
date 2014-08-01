<?php

namespace GameOfLife;

class Universe
{
    const GLIDER_GUN = 'glider-gun';
    const RANDOM     = 'random';
    const VACANT     = 'empty';
    const DEAD       = 0;
    const ALIVE      = 1;

    protected $world  = array();
    protected $worldStatus;
    protected $length = 50;
    protected $width  = 50;

    public function setWorldStatus($status)
    {
        $this->worldStatus = $status;
        return $this;
    }

    public function getWorld()
    {
        return $this->world;
    }

    public function setWorld(array $world)
    {
        $this->world = $world;
        return $this;
    }

    public function setWidth($width)
    {
        $this->width = $width;
        return $this;
    }

    public function setLength($length)
    {
        $this->length = $length;
        return $this;
    }

    public function getWidth()
    {
        return $this->width;
    }

    public function getLength()
    {
        return $this->length;
    }

    public function checkWorldSize($length, $width)
    {
        return $width <= $this->width && $length <= $this->length;
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

    public function createRandomWorld()
    {
        $world = array();

        for ($coordX=0; $coordX < $this->length; $coordX++) {
            for ($coordY=0; $coordY < $this->width; $coordY++) {
                $world[$coordX][$coordY] = rand(static::DEAD, static::ALIVE);
            }
        }

        return $world;
    }

    public function createGliderGunWorld()
    {
        if (!$this->checkWorldSize(40, 15)) {
            throw new \Exception('Unable to generate Glider Gun world is too small, please use at least width: 15 and length: 40', 1);
        }

        $world = $this->createEmptyWorld();

        $world[6][2]   = static::ALIVE;
        $world[6][3]   = static::ALIVE;
        $world[7][2]   = static::ALIVE;
        $world[7][3]   = static::ALIVE;
        $world[6][12]  = static::ALIVE;
        $world[7][12]  = static::ALIVE;
        $world[8][12]  = static::ALIVE;
        $world[5][13]  = static::ALIVE;
        $world[9][13]  = static::ALIVE;
        $world[10][14] = static::ALIVE;
        $world[4][14]  = static::ALIVE;
        $world[4][15]  = static::ALIVE;
        $world[10][15] = static::ALIVE;
        $world[7][16]  = static::ALIVE;
        $world[5][17]  = static::ALIVE;
        $world[9][17]  = static::ALIVE;
        $world[6][18]  = static::ALIVE;
        $world[7][18]  = static::ALIVE;
        $world[8][18]  = static::ALIVE;
        $world[7][19]  = static::ALIVE;
        $world[6][22]  = static::ALIVE;
        $world[5][22]  = static::ALIVE;
        $world[4][22]  = static::ALIVE;
        $world[6][23]  = static::ALIVE;
        $world[5][23]  = static::ALIVE;
        $world[4][23]  = static::ALIVE;
        $world[3][24]  = static::ALIVE;
        $world[7][24]  = static::ALIVE;
        $world[2][26]  = static::ALIVE;
        $world[3][26]  = static::ALIVE;
        $world[7][26]  = static::ALIVE;
        $world[8][26]  = static::ALIVE;
        $world[4][36]  = static::ALIVE;
        $world[5][36]  = static::ALIVE;
        $world[4][37]  = static::ALIVE;
        $world[5][37]  = static::ALIVE;

        return $world;
    }

    public function initWorld()
    {
        switch ($this->worldStatus) {
            case static::GLIDER_GUN:
                $this->world = $this->createGliderGunWorld();
                break;
            case static::RANDOM:
                $this->world = $this->createRandomWorld();
                break;
            case static::VACANT:
            default:
                $this->world = $this->createGliderGunWorld();
                break;
        }

        return $this;
    }
}
