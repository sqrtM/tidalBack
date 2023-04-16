<?php

namespace App\Notation;

/**
 * Remember that the number is the array index, not scale degree.
 * Array index = scale degree - 1 (i.e., lydian = 3)
 */
enum Mode: int
{
    case Ionian = 0;
    case Dorian = 1;
    case Phrygian = 2;
    case Lydian = 3;
    case Mixolydian = 4;
    case Aeolian = 5;
    case Locrian = 6;
}
