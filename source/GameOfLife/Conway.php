<?php

namespace GameOfLife;

use Hoa;

class Conway
{
    const DEAD  = 0;
    const ALIVE = 1;

    /**
     * @invariant world: array([0..1], 3);
     */
    protected $world = array();

    /**
     * @invariant world: integer();
     */
    protected $x = 50;

    /**
     * @invariant world: integer();
     */
    protected $y = 50;

    public function initEmptyWorld()
    {
        $this->world = $this->createEmptyWorld();
        return $this;
    }

    public function createEmptyWorld()
    {
        $world = array();

        for ($i=0; $i < $this->x; $i++) {
            for ($j=0; $j < $this->y; $j++) {
                $world[$i][$j] = static::DEAD;
            }
        }

        return $world;
    }

    public function setWorld($world)
    {
        $this->world = $world;
        return $this;
    }

    /**
     * @ensures \result: this->world;
     */
    public function getWorld()
    {
        return $this->world;
    }

    public function setX($x)
    {
        $this->x = $x;
        return $this;
    }

    public function setY($y)
    {
        $this->y = $y;
        return $this;
    }

    public function initRandomWorld()
    {
        for ($i=0; $i < $this->x; $i++) {
            for ($j=0; $j < $this->y; $j++) {
                $this->world[$i][$j] = rand(static::DEAD, static::ALIVE);
            }
        }
    }

    public function initGliderGun()
    {
        $this->initEmptyWorld();

        $this->world[2][7]   = static::ALIVE;
        $this->world[2][8]   = static::ALIVE;
        $this->world[3][6]   = static::ALIVE;
        $this->world[4][5]   = static::ALIVE;
        $this->world[4][19]  = static::ALIVE;
        $this->world[4][23]  = static::ALIVE;
        $this->world[5][5]   = static::ALIVE;
        $this->world[5][18]  = static::ALIVE;
        $this->world[5][19]  = static::ALIVE;
        $this->world[5][22]  = static::ALIVE;
        $this->world[5][23]  = static::ALIVE;
        $this->world[6][5]   = static::ALIVE;
        $this->world[6][21]  = static::ALIVE;
        $this->world[6][22]  = static::ALIVE;
        $this->world[7][6]   = static::ALIVE;
        $this->world[7][21]  = static::ALIVE;
        $this->world[7][22]  = static::ALIVE;
        $this->world[7][23]  = static::ALIVE;
        $this->world[8][3]   = static::ALIVE;
        $this->world[8][7]   = static::ALIVE;
        $this->world[8][8]   = static::ALIVE;
        $this->world[8][21]  = static::ALIVE;
        $this->world[8][22]  = static::ALIVE;
        $this->world[9][2]   = static::ALIVE;
        $this->world[9][3]   = static::ALIVE;
        $this->world[9][18]  = static::ALIVE;
        $this->world[9][19]  = static::ALIVE;
        $this->world[10][19] = static::ALIVE;
    }

    public function initGun()
    {
        $this->initEmptyWorld();

        $this->world[6][2]   = static::ALIVE;
        $this->world[6][3]   = static::ALIVE;
        $this->world[7][2]   = static::ALIVE;
        $this->world[7][3]   = static::ALIVE;
        $this->world[6][12]  = static::ALIVE;
        $this->world[7][12]  = static::ALIVE;
        $this->world[8][12]  = static::ALIVE;
        $this->world[5][13]  = static::ALIVE;
        $this->world[9][13]  = static::ALIVE;
        $this->world[10][14] = static::ALIVE;
        $this->world[4][14]  = static::ALIVE;
        $this->world[4][15]  = static::ALIVE;
        $this->world[10][15] = static::ALIVE;
        $this->world[7][16]  = static::ALIVE;
        $this->world[5][17]  = static::ALIVE;
        $this->world[9][17]  = static::ALIVE;
        $this->world[6][18]  = static::ALIVE;
        $this->world[7][18]  = static::ALIVE;
        $this->world[8][18]  = static::ALIVE;
        $this->world[7][19]  = static::ALIVE;
        $this->world[6][22]  = static::ALIVE;
        $this->world[5][22]  = static::ALIVE;
        $this->world[4][22]  = static::ALIVE;
        $this->world[6][23]  = static::ALIVE;
        $this->world[5][23]  = static::ALIVE;
        $this->world[4][23]  = static::ALIVE;
        $this->world[3][24]  = static::ALIVE;
        $this->world[7][24]  = static::ALIVE;
        $this->world[2][26]  = static::ALIVE;
        $this->world[3][26]  = static::ALIVE;
        $this->world[7][26]  = static::ALIVE;
        $this->world[8][26]  = static::ALIVE;
        $this->world[4][36]  = static::ALIVE;
        $this->world[5][36]  = static::ALIVE;
        $this->world[4][37]  = static::ALIVE;
        $this->world[5][37]  = static::ALIVE;
    }

    public function initGlider()
    {
        $this->initEmptyWorld();

        $this->world[18][10] = static::ALIVE;
        $this->world[18][11] = static::ALIVE;
        $this->world[18][12] = static::ALIVE;
        $this->world[19][12] = static::ALIVE;
        $this->world[20][11] = static::ALIVE;
    }

    /**
     * @ensures  \result: regex('/[a-f0-9]{40}/');
     */
    public function computeHash()
    {
        return sha1(serialize(array(0, 0, 0, 1, 0, 1, 0)));
    }

    public function computeNewState()
    {
        $newWorld = $this->createEmptyWorld();

        for ($i=0; $i < $this->x; $i++) {
            for ($j=0; $j < $this->y; $j++) {
                $newWorld[$i][$j] = $this->isDeadOrAlive($i, $j);
            }
        }

        $this->world = $newWorld;

        return $this;
    }

    public function isCellInWorld($i, $j)
    {
        return ($i < $this->x && $j < $this->y && $i >= 0 && $j >= 0);
    }

    public function isDeadOrAlive($i, $j)
    {
        $cellAlives = 0;

        if ($this->isCellInWorld($i+1, $j+1) && $this->world[$i+1][$j+1] === static::ALIVE) {
            $cellAlives++;
        }

        if ($this->isCellInWorld($i, $j+1) && $this->world[$i][$j+1] === static::ALIVE) {
            $cellAlives++;
        }

        if ($this->isCellInWorld($i+1, $j) && $this->world[$i+1][$j] === static::ALIVE) {
            $cellAlives++;
        }

        if ($this->isCellInWorld($i+1, $j-1) && $this->world[$i+1][$j-1] === static::ALIVE) {
            $cellAlives++;
        }

        if ($this->isCellInWorld($i-1, $j+1) && $this->world[$i-1][$j+1] === static::ALIVE) {
            $cellAlives++;
        }

        if ($this->isCellInWorld($i-1, $j-1) && $this->world[$i-1][$j-1] === static::ALIVE) {
            $cellAlives++;
        }

        if ($this->isCellInWorld($i, $j-1) && $this->world[$i][$j-1] === static::ALIVE) {
            $cellAlives++;
        }

        if ($this->isCellInWorld($i-1, $j) && $this->world[$i-1][$j] === static::ALIVE) {
            $cellAlives++;
        }

        if (3 === $cellAlives) {
            $survive = static::ALIVE;
        } elseif (2 === $cellAlives) {
            $survive = ($this->world[$i][$j] === static::ALIVE) ? static::ALIVE : static::DEAD;
        } else {
            $survive = static::DEAD;
        }

        return $survive;
    }

    public function displayWorld()
    {
        Hoa\Console\Cursor::save();

        //draw world
        foreach ($this->world as $row) {
            foreach ($row as $cell) {
                if ($cell === static::ALIVE) {
                    Hoa\Console\Cursor::colorize('fg(white) bg(white)');
                } else {
                    Hoa\Console\Cursor::colorize('fg(black) bg(black)');
                }
                echo '  ';
            }
            Hoa\Console\Cursor::move('←', $this->x * 2);
            Hoa\Console\Cursor::move('↓', 1);
        }

        Hoa\Console\Cursor::restore();
    }

    public function run()
    {
        Hoa\Console\Cursor::clear('↕');
        Hoa\Console\Cursor::hide();
        Hoa\Console\Cursor::move('↓', 1);

        if (array() === $this->world) {
            $this->initGun();
        }

        do {
            $hash = $this->computeHash();
            $this->displayWorld();
            $this->computeNewState();
            usleep(80000);
        } while ($hash !== $this->computeHash());

        Hoa\Console\Cursor::show();
        Hoa\Console\Cursor::colorize('default');
        Hoa\Console\Cursor::move('↓', $this->y);
    }
}
