<?php

namespace GameOfLife\Worlds;

class Random implements Planet
{
    protected $planet;

    public function create()
    {
        for ($height = 0; $height < $this->height; $height++) {
            for ($length = 0; $length <= $this->length; $length++) {
                $this->planet[$height][$length] = 0;
            }
        }
    }
}
