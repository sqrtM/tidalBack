<?php

namespace App\Service\Chord;

class ChordDecorator implements Chord
{
    protected Chord $chord;

    public function __construct(Chord $chord)
    {
        $this->chord = $chord;
    }

    public function build(Chord $chord): Chord
    {
        return $this->chord->build($chord);
    }

    public function full(): bool
    {
        return $this->chord->full();
    }
}
