<?php

namespace GameOfLife;

use Hoa;

class Conway
{
    protected $universe;

    public function getUniverse()
    {
        return $this->universe;
    }

    public function setUniverse(Universe $universe)
    {
        $this->universe = $universe;
        return $this;
    }

    /**
     * @ensures  \result: regex('/[a-f0-9]{40}/');
     */
    public function computeHash()
    {
        return sha1(serialize($this->universe->getWorld()));
    }

    public function computeNewState()
    {
        $newWorld = $this->universe->createEmptyWorld();

        for ($i=0; $i < $this->universe->getLength(); $i++) {
            for ($j=0; $j < $this->universe->getWidth(); $j++) {
                $newWorld[$i][$j] = $this->isDeadOrAlive($i, $j);
            }
        }

        $this->universe->setWorld($newWorld);

        return $this;
    }

    public function isCellInWorld($i, $j)
    {
        return ($i < $this->universe->getLength() && $j < $this->universe->getWidth() && $i >= 0 && $j >= 0);
    }

    public function isDeadOrAlive($i, $j)
    {
        $cellAlives = 0;
        $world = $this->universe->getWorld();

        for ($xpos = $i - 1; $xpos <= $i + 1; $xpos += 1) {
            for ($ypos = $j - 1; $ypos <= $j + 1; $ypos += 1) {
                if ($this->isCellInWorld($xpos, $ypos) && $world[$xpos][$ypos] === Universe::ALIVE) {
                    $cellAlives++;
                }
            }
        }

        if ($world[$i][$j] == Universe::ALIVE) {
            $cellAlives -= 1;
        }

        if (3 === $cellAlives) {
            $survive = Universe::ALIVE;
        } elseif (2 === $cellAlives) {
            $survive = ($world[$i][$j] === Universe::ALIVE) ? Universe::ALIVE : Universe::DEAD;
        } else {
            $survive = Universe::DEAD;
        }

        return $survive;
    }

    public function displayWorld()
    {
        Hoa\Console\Cursor::save();

        //draw world
        foreach ($this->universe->getWorld() as $row) {
            foreach ($row as $cell) {
                if ($cell === Universe::ALIVE) {
                    Hoa\Console\Cursor::colorize('fg(white) bg(white)');
                } else {
                    Hoa\Console\Cursor::colorize('fg(black) bg(black)');
                }
                echo '  ';
            }
            Hoa\Console\Cursor::move('←', $this->universe->getLength() * 2);
            Hoa\Console\Cursor::move('↓', 1);
        }

        Hoa\Console\Cursor::restore();
    }

    public function run()
    {
        Hoa\Console\Cursor::clear('↕');
        Hoa\Console\Cursor::hide();
        Hoa\Console\Cursor::move('↓', 1);

        do {
            $hash = $this->computeHash();
            $this->displayWorld();
            $this->computeNewState();
            /* usleep(80000); */
        } while ($hash !== $this->computeHash());

        Hoa\Console\Cursor::show();
        Hoa\Console\Cursor::colorize('default');
        Hoa\Console\Cursor::move('↓', $this->universe->getWidth());
    }
}
