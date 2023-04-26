<?php

namespace App\Service\Chord;

class Major extends ChordDecorator
{
    public function build(Chord $chord): Chord
    {
        $chord = parent::build($chord);
        if (!$chord->full()) {
            
        }
        return $this;
    }
}