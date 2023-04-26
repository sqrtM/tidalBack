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

    /**
     * @param string[] $chord
     */
    private function analyzeChord(array $chord): string
    {
        $allNotes = Note::cases();
        $rootValue = array_search(Note::from($chord[0]), $allNotes);
        $thirdValue = $this->getInterval(Note::fromName($chord[1]), $rootValue);
        $fifthValue = $this->getInterval(Note::fromName($chord[2]), $rootValue);
        $rootValue = 0;

        $firstInterval = match (max($rootValue, $thirdValue) - min($rootValue, $thirdValue)) {
            3 => ChordQuality::Minor,
            4 => ChordQuality::Major,
        };
        $secondInterval = match (max($thirdValue, $fifthValue) - min($thirdValue, $fifthValue)) {
            3 => ChordQuality::Minor,
            4 => ChordQuality::Major,
        };

        $chordQuality = "?";
        if ($firstInterval === ChordQuality::Minor && $secondInterval === ChordQuality::Major) {
            $chordQuality = ChordQuality::Minor->value;
        } else if ($firstInterval === ChordQuality::Major && $secondInterval === ChordQuality::Minor) {
            $chordQuality = ChordQuality::Major->value;
        } else if ($firstInterval === ChordQuality::Major && $secondInterval === ChordQuality::Major) {
            $chordQuality = ChordQuality::Augmented->value;
        } else if ($firstInterval === ChordQuality::Minor && $secondInterval === ChordQuality::Minor) {
            $chordQuality = ChordQuality::Diminished->value;
        }
        return $chord[0] . $chordQuality;
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
