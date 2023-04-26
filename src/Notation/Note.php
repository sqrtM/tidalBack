<?php

namespace App\Notation;

enum Note: string
{
    case C = "C";
    case Cs = "Cs";
    case D = "D";
    case Ds = "Ds";
    case E = "E";
    case F = "F";
    case Fs = "Fs";
    case G = "G";
    case Gs = "Gs";
    case A = "A";
    case As = "As";
    case B = "B";

    public static function fromName(string $name)
    {
        foreach (self::cases() as $note) {
            if( $name === $note->name ){
                return $note;
            }
        }
        throw new \ValueError("$name is not a valid backing value for enum " . self::class );
    }
}
