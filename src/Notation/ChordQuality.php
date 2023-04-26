<?php

namespace App\Notation;

enum ChordQuality: string
{
    case Major = "M";
    case Minor = "m";
    case Diminished = "o";
    case Augmented = "+";
}