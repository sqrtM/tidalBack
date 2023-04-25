<?php

namespace App\Service\Progression;

class Progression
{
    private array $allChords;

    // this works for diatonic, but won't work elsewhere.
    private array $MEDIANTS = [5];
    private array $SUBDOMS = [1, 3];
    private array $DOMS = [4, 6];

    public function __construct(array $scale)
    {
        $this->allChords = $this->generateAllChords($scale);
    }

    private function generateAllChords(array $scale): array
    {
        $prog = [];
        for ($i = 0; count($prog) < count($scale); $i++) {
            $chord = [];
            for ($j = $i; count($chord) < 3; $j += 2) {
                if ($j >= count($scale)) {
                    $j -= count($scale);
                }
                array_push($chord, $scale[$j]);
            }
            array_push($prog, implode(",", $chord));
        }
        return $prog;
    }

    public function generateProgression()
    {
        $prog = [$this->allChords[0],];
        array_push($prog, $this->allChords[$this->MEDIANTS[array_rand($this->MEDIANTS)]]);
        array_push($prog, $this->allChords[$this->SUBDOMS[array_rand($this->SUBDOMS)]]);
        array_push($prog, $this->allChords[$this->DOMS[array_rand($this->DOMS)]]);
        return $prog;
    }

    public function getAllChords()
    {
        return $this->allChords;
    }
}
