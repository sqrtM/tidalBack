<?php

namespace App\Service\Scale;

use App\Notation\Mode;
use App\Notation\Note;

class DiatonicScale implements Scale, ModalScale
{
    private array $pattern = [2, 2, 1, 2, 2, 2, 1];
    private array $scale = [];
    private Note $note;

    public function __construct(Note $note)
    {
        $this->note = $note;
    }

    public function build(): DiatonicScale
    {
        $scale = [];
        $notes = Note::cases();
        $startingIndex = array_search($this->note, $notes);
        $scaleDegree = $startingIndex;

        // this loop creates a scale in whatever mode "0" is.
        for ($i = 0; count($scale) < count($this->pattern); $i++) {
            array_push($scale, $notes[$scaleDegree]->value);
            if ($scaleDegree + $this->pattern[$i] < count($notes)) {
                $scaleDegree += $this->pattern[$i];
            } else {
                $scaleDegree += $this->pattern[$i] - count($notes);
            }
        }

        $this->scale = $scale;
        return $this;
    }

    public function get(): array
    {
        return $this->scale;
    }

    public function transpose(int $steps): Scale
    {
        return $this;
    }

    public function changeMode(Mode $mode): Scale
    {
        $modalScale = [];
        // the -1 corrects the discrepancy between the array index and scale degree
        $scaleDegree = $mode->value - 1;
        for ($i = 0; count($modalScale) < count($this->scale); $i++) {
            if ($scaleDegree + 1 < count($this->scale)) {
                $scaleDegree++;
            } else {
                $scaleDegree = 0;
            }
            array_push($modalScale, $this->scale[$scaleDegree]);
        }
        $this->scale = $modalScale;
        return $this;
    }
}
