<?php

namespace GameOfLife\tests\units;

use mageekguy\atoum;

class Position extends atoum\test
{
    public function testConstruct()
    {
        $this->object($this->newTestedInstance(5, 10))->isInstanceOf('\GameofLife\Position');
    }
}
