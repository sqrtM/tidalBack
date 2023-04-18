<?php

namespace App\Service\TidalString;

class TidalStringFactory
{
    private readonly array $scale;

    public function __construct(array $scale)
    {
        $this->scale = $scale;
    }

    public function buildBass()
    {
    }
}
