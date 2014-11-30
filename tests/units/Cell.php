<?php

namespace GameOfLife\tests\units;

use mageekguy\atoum;
use GameOfLife\State;

class Cell extends atoum\test
{
    public function testConstruct()
    {
        $position = new \mock\GameOfLife\Position(5, 10);
        $state    = new \mock\GameOfLife\State(State::ALIVE);

        $this->object($this->newTestedInstance($position, $state))->isInstanceOf('\GameOfLife\Cell');
    }
}
