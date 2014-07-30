<?php

namespace GameOfLife\tests\units;

use mageekguy\atoum;
use GameOfLife\World as planet;

class World extends atoum\test
{
    public function testPlanet()
    {
        $this->object($world = new planet)->isInstanceOf('\GameOfLife\World')
            ->object($world->init())->isInstanceOf('\GameOfLife\World')
            ->array($world->getPlanet())->hasSize(\GameOfLife\World::DEFAULT_HEIGHT)
        ;
    }
}
