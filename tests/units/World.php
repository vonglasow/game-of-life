<?php

namespace GameOfLife\tests\units;

use mageekguy\atoum;
use GameOfLife\World as planet;

class World extends atoum\test
{
    public function testPlanet()
    {
        $this->object($world = new planet)->isInstanceOf('\GameOfLife\World')
            ->object($world->create())->isInstanceOf('\GameOfLife\World')
            ->array($planet = $world->getPlanet())->hasSize(\GameOfLife\World::DEFAULT_HEIGHT)
        ;

        foreach ($planet as $row) {
            $this->array($row)->hasSize(\GameOfLife\World::DEFAULT_LENGTH);
        }
    }
}
