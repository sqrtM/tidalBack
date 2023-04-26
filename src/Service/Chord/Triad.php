<?php

namespace App\Service\Chord;

class Triad implements Chord
{
    private int $size = 3;
    /** @var Note[] $notes */
    private array $notes = [];

    public function build(Chord $chord): self
    {
        return $this;
    }

    public function full(): bool
    {
        return $this->size === count($this->notes);
    }
}