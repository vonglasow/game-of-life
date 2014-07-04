<?php

namespace GameOfLife\tests\units;

use mageekguy\atoum;

class Conway extends atoum\test
{
    public function testClass()
    {
        $this->object(new \GameOfLife\Conway)->isInstanceOf('\GameOfLife\Conway');
    }

    public function testInitEmptyWorld()
    {
        $this->object($this->newTestedInstance)->isInstanceOf('\GameOfLife\Conway')
            ->if()->array($this->testedInstance->getWorld())->isEmpty()
                ->object($this->testedInstance->initEmptyWorld())->isInstanceOf('\GameOfLife\Conway')
            ->then()->array($this->testedInstance->getWorld())->isNotEmpty()
            ->and()
                ->object($this->testedInstance->setX(3))->isInstanceOf('\GameOfLife\Conway')
                ->object($this->testedInstance->setY(3))->isInstanceOf('\GameOfLife\Conway')
            ->if()
                ->object($this->testedInstance->initEmptyWorld())->isInstanceOf('\GameOfLife\Conway')
            ->then()->array($this->testedInstance->getWorld())->isEqualTo(
                [
                    [0, 0, 0],
                    [0, 0, 0],
                    [0, 0, 0]
                ]
            )
        ;
    }

    public function testComputeNewState()
    {
        $this->object($this->newTestedInstance)->isInstanceOf('\GameOfLife\Conway')
            ->if()->object($this->testedInstance->setWorld(
                [
                    [0, 0, 0],
                    [0, 0, 0],
                    [0, 0, 0]
                ]
            ))->isInstanceOf('\GameOfLife\Conway')
            ->and()
                ->object($this->testedInstance->setX(3))->isInstanceOf('\GameOfLife\Conway')
                ->object($this->testedInstance->setY(3))->isInstanceOf('\GameOfLife\Conway')
            ->if()
                ->object($this->testedInstance->computeNewState())->isInstanceOf('\GameOfLife\Conway')
            ->then()->array($this->testedInstance->getWorld())->isEqualTo(
                [
                    [0, 0, 0],
                    [0, 0, 0],
                    [0, 0, 0]
                ]
            )
        ;
    }
}
