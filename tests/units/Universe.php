<?php

namespace GameOfLife\tests\units;

use mageekguy\atoum;
use GameOfLife\Universe as space;

class Universe extends atoum\test
{
    public function testGetInstance()
    {
        $this->object(new space)->isInstanceOf('\GameOfLife\Universe');
    }

    public function testInitEmptyWorld()
    {
        $this->object($universe = new space)->isInstanceOf('\GameOfLife\Universe')
            ->array($universe->getWorld())->isEmpty()
            ->if($universe->initWorld('empty'))
            ->then()->array($world = $universe->getWorld())->size->isEqualTo(25)
            ->and()->array($world)->contains(array_fill(0, 25, 0))
        ;
    }

    public function testInitGliderWorld()
    {
        $this->object($universe = new space)->isInstanceOf('\GameOfLife\Universe')
            ->array($universe->getWorld())->isEmpty()
            ->if($universe->initWorld('glider'))
            ->then()->array($world = $universe->getWorld())->size->isEqualTo(25)
            ->and()->array($world)->contains(array_fill(0, 25, 0))
            ->if($universe->setWidth(10))
            ->and()->if($universe->setLength(10))
            ->exception(function () use ($universe) {
                $universe->createGliderGunWorld();
            })->hasCode(1)
            ->hasMessage('Unable to generate Glider Gun world is too small, please use at least width: 15 and length: 30')
        ;
    }
}
