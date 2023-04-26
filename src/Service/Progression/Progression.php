<?php

namespace App\Service\Progression;

use App\Notation\ChordQuality;
use App\Notation\Note;

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

    public function generateProgression(): array
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

    private function getInterval(Note $n1, int $root): int
    {  
        return array_search($n1, Note::cases()) - $root <= 0 
        ? array_search($n1, Note::cases()) - $root + 12 
        : array_search($n1, Note::cases()) - $root;
    }

    private function getChordQuality(ChordQuality $int1, ChordQuality $int2): string
    {
        return match(true) {
            $int1 === ChordQuality::Minor && $int2 === ChordQuality::Major => ChordQuality::Minor->value,
            $int1 === ChordQuality::Major && $int2 === ChordQuality::Minor => ChordQuality::Major->value,
            $int1 === ChordQuality::Major && $int2 === ChordQuality::Major => ChordQuality::Augmented->value,
            $int1 === ChordQuality::Minor && $int2 === ChordQuality::Minor => ChordQuality::Diminished->value,
            default => throw new \Exception("chord quality not found ???")
        };
    }

    /**
     * @param string[] $chord
     */
    private function analyzeChord(array $chord): string
    {
        $rootValue = array_search(Note::from($chord[0]), Note::cases());
        $thirdValue = $this->getInterval(Note::fromName($chord[1]), $rootValue);
        $fifthValue = $this->getInterval(Note::fromName($chord[2]), $rootValue);

        $firstInterval = ChordQuality::getThirdQuality($thirdValue);
        $secondInterval = ChordQuality::getThirdQuality($fifthValue - $thirdValue);

        return $chord[0] . $this->getChordQuality($firstInterval, $secondInterval);
    }

    /**
     * @param string[] $prog 
     */
    public function analyzeProgression(array $prog): string
    {
        $analyzedProgression = "|";
        foreach ($prog as $chord) {
            $testChord = explode(",", $chord);
            $analyzedProgression .= $this->analyzeChord($testChord) . "|";
        }
        return $analyzedProgression;
    }
}
