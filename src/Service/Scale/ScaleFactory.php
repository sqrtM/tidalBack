<?php

namespace App\Service\Scale;

use App\Notation\Mode;
use App\Notation\Note;
use App\Notation\ScaleName;

class ScaleFactory
{
    public function new(ScaleName $name): Scale
    {
        switch ($name) {
            case ScaleName::Diatonic:
                $note = Note::cases()[array_rand(Note::cases())];
                $mode = Mode::cases()[array_rand(Mode::cases())];
                $scale = new DiatonicScale($note);
                $scale->build();
                if ($mode->value > 0) {
                    $scale->changeMode($mode);
                }
                break;
            case ScaleName::Pentatonic:
                echo "we don't do that yet...";
                break;
        }
        return $scale;
    }
}
