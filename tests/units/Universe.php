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
}
