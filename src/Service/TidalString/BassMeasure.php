<?php

namespace App\Service\TidalString;

/**
 * for now, this is only set up to accomodate 4/4 time. change this to be more flexible later.
 */
class BassMeasure implements Measure
{
    private array $scale;
    private int $beats = 4; // 4 / 4
    private int $currentBeat = 0;
    private array $progression;
    private array $measure;

    public function __construct(array $scale)
    {
        $this->scale = $scale;
    }

    private function addNewBeat()
    {
        if (!$this->isMeasureFull()) {
            array_push($this->measure, $this->buildBeat());
        } else {
            throw new \Exception("measure full!!!");
        }
    }

    private function buildBeat()
    {
    }

    private function isMeasureFull(): bool
    {
        return count($this->measure) === $this->beats;
    }

    private function isBeatStrong(): bool
    {
        return $this->currentBeat === 0 || $this->currentBeat === 3;
    }

    public function getString()
    {
    }
}
