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

    protected $x = 25;
    protected $y = 25;

    public function initEmptyWorld()
    {
        $this->world = array();

        for ($i=0; $i < $this->x; $i++) {
            for ($j=0; $j < $this->y; $j++) {
                $this->world[$i][$j] = static::DEAD;
            }
        }

        return $this;
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

    public function computeHash()
    {
        return sha1(serialize($this->world));
    }

    public function computeNewState()
    {
        $newWorld = $this->world;
        for ($i=0; $i < $this->x; $i++) {
            for ($j=0; $j < $this->y; $j++) {
                $newWorld[$i][$j] = static::DEAD;
            }
        }

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

        $currentCellAlive = $this->world[$i][$j] === static::ALIVE;

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

        if (2 > $cellAlives) {
            $survive = static::DEAD;
        } elseif (3 === $cellAlives) {
            $survive = static::ALIVE;
        } elseif (3 < $cellAlives) {
            $survive = static::DEAD;
        } elseif (2 === $cellAlives) {
            $survive = ($currentCellAlive) ? static::ALIVE : static::DEAD;
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
        $this->initRandomWorld();

        do {
            $hash = $this->computeHash();
            $this->displayWorld();
            $this->computeNewState();
            sleep(0.5);
        } while ($hash !== $this->computeHash());

        Hoa\Console\Cursor::show();
        Hoa\Console\Cursor::colorize('default');
        Hoa\Console\Cursor::move('↓', $this->y);
    }
}
