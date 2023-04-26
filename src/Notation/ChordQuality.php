<?php

namespace App\Notation;

enum ChordQuality: string
{
    case Major = "M";
    case Minor = "m";
    case Diminished = "o";
    case Augmented = "+";

    public static function getThirdQuality(int $interval)
    {
        $quality = match ($interval) {
            3 => ChordQuality::Minor,
            4 => ChordQuality::Major,
            default => throw new \Exception("invalid third interval @ChordQuality")
        };
        return $quality;
    }
}