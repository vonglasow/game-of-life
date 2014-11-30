<?php

namespace GameOfLife\tests\units;

use mageekguy\atoum;
use GameofLife\State as status;

class State extends atoum\test
{
    public function testConstruct()
    {
        $this->object($this->newTestedInstance(status::ALIVE))->isInstanceOf('\GameofLife\State');
    }
}
