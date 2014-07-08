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
     * @invariant hash: string('a', 'z', 32);
     */
    protected $hash;

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

    public function getHash()
    {
        return sha1(serialize($this->world));
    }

    public function computeNewState()
    {
        for ($i=0; $i < $this->x; $i++) {
            for ($j=0; $j < $this->y; $j++) {
                $this->world[$i][$j] = $this->isDeadOrAlive($i, $j);
            }
        }

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
            if ($currentCellAlive) $cellAlives++;
        }

        if ($this->isCellInWorld($i, $j+1) && $this->world[$i][$j+1] === static::ALIVE) {
            if ($currentCellAlive) $cellAlives++;
        }

        if ($this->isCellInWorld($i+1, $j) && $this->world[$i+1][$j] === static::ALIVE) {
            if ($currentCellAlive) $cellAlives++;
        }

        if ($this->isCellInWorld($i+1, $j-1) && $this->world[$i+1][$j-1] === static::ALIVE) {
            if ($currentCellAlive) $cellAlives++;
        }

        if ($this->isCellInWorld($i-1, $j+1) && $this->world[$i-1][$j+1] === static::ALIVE) {
            if ($currentCellAlive) $cellAlives++;
        }

        if ($this->isCellInWorld($i-1, $j-1) && $this->world[$i-1][$j-1] === static::ALIVE) {
            if ($currentCellAlive) $cellAlives++;
        }

        if ($this->isCellInWorld($i, $j-1) && $this->world[$i][$j-1] === static::ALIVE) {
            if ($currentCellAlive) $cellAlives++;
        }

        if ($this->isCellInWorld($i-1, $j) && $this->world[$i-1][$j] === static::ALIVE) {
            if ($currentCellAlive) $cellAlives++;
        }

        if (2 > $cellAlives) {
            return static::DEAD;
        } elseif (3 === $cellAlives) {
            return static::ALIVE;
        } elseif (3 > $cellAlives) {
            return static::DEAD;
        }
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
        //Hoa\Console\Cursor::hide();
        Hoa\Console\Cursor::move('↓', 1);
        $this->initEmptyWorld();

        do {
            $hash = $this->getHash();
            $this->displayWorld();
            $this->computeNewState();
            sleep(1);
        } while ($hash !== $this->getHash());

        //Hoa\Console\Cursor::show();
        Hoa\Console\Cursor::colorize('default');
        Hoa\Console\Cursor::move('↓', $this->y);
    }
}
