<?php

namespace App\Service\Chord;

interface Chord
{
    public function build(Chord $chord): Chord;
    public function full(): bool;
}