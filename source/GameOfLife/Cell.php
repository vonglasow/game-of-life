<?php

namespace GameOfLife;

class Cell
{
    private $state;

    public function evolve($automaton, $neighbours)
    {
        $automaton->makeEvolve($this, $neighbours);

        return $this;
    }

    public function live()
    {
        $this->state = new State\Alive;

        return $this;
    }

    public function decease()
    {
        $this->state = new State\Dead;

        return $this;
    }
}
