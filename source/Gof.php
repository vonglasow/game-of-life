<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

class GameOfLife
{
    const DEAD  = 0;
    const ALIVE = 1;

    protected $world = array();
    protected $hash;

    protected $x = 25;
    protected $y = 25;

    public function initEmptyWorld()
    {
        for ($i=0; $i < $this->x; $i++) {
            for ($j=0; $j < $this->y; $j++) {
                $this->world[$i][$j] = static::DEAD;
            }
        }

        $this->world[3][3] = static::ALIVE;
        $this->world[3][4] = static::ALIVE;
        $this->world[3][5] = static::ALIVE;
    }

    public function setX($x)
    {
        $this->x = $x;
    }

    public function setY($y)
    {
        $this->y = $y;
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

        //do {
            $hash = $this->getHash();
            $this->computeNewState();
            $this->displayWorld();
            sleep(1);
        //} while ($hash !== $this->getHash());

        //Hoa\Console\Cursor::show();
        Hoa\Console\Cursor::colorize('default');
        Hoa\Console\Cursor::move('↓', $this->y);
    }
}
