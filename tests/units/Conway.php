<?php

namespace GameOfLife\tests\units;

use mageekguy\atoum;
use GameOfLife\Conway as game;

class Conway extends atoum\test
{
    public function testInitEmptyWorld()
    {
        $this->object($conway = new game)->isInstanceOf('\GameOfLife\Conway')
            ->if()->array($conway->getWorld())->isEmpty()
                ->object($conway->initEmptyWorld())->isInstanceOf('\GameOfLife\Conway')
            ->then()->array($conway->getWorld())->isNotEmpty()
            ->and()
                ->object($conway->setX(3))->isInstanceOf('\GameOfLife\Conway')
                ->object($conway->setY(3))->isInstanceOf('\GameOfLife\Conway')
            ->if()
                ->object($conway->initEmptyWorld())->isInstanceOf('\GameOfLife\Conway')
            ->then()->array($conway->getWorld())->isEqualTo(
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
        $this->object($conway = new game)->isInstanceOf('\GameOfLife\Conway')
            ->if()->object($conway->setWorld(
                [
                    [0, 0, 0],
                    [0, 0, 0],
                    [0, 0, 0]
                ]
            ))->isInstanceOf('\GameOfLife\Conway')
            ->and()
                ->object($conway->setX(3))->isInstanceOf('\GameOfLife\Conway')
                ->object($conway->setY(3))->isInstanceOf('\GameOfLife\Conway')
            ->if()
                ->object($conway->computeNewState())->isInstanceOf('\GameOfLife\Conway')
            ->then()->array($conway->getWorld())->isEqualTo(
                [
                    [0, 0, 0],
                    [0, 0, 0],
                    [0, 0, 0]
                ]
            )
        ;
    }
}
