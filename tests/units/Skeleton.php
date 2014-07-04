<?php

namespace GameOfLife\tests\units;

use mageekguy\atoum;

class Conway extends atoum\test
{
    public function testClass()
    {
        $this->object(new \GameOfLife\Conway)->isInstanceOf('\GameOfLife\Conway');
    }
}
