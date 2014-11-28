<?php

namespace GameOfLife;

final class State
{
    const ALIVE = 1;
    const DEAD  = 0;

    private $state;
    private $class;

    public function __construct($life)
    {
        if (!$this->validate($life)) {
            throw new \Exception(
                sprintf(
                    'Unknown state %s you should choose a valid state (%s)',
                    $life,
                    __CLASS__ .
                    '::' . 
                    join(
                        ', ' . __CLASS__ . '::', 
                        array_keys($this->class->getConstants())
                    )
                )
            );
        }

        $this->state = $life;
    }

    private function validate($state)
    {
        if (!$this->class) {
            $this->class = new \ReflectionClass(__CLASS__);
        }

        return in_array($state, $this->class->getConstants());
    }
}
