<?php

namespace App\Service\Chord;

class Seventh implements Chord
{
    private int $size = 4;
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