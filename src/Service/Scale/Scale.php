<?php

namespace App\Service\Scale;

interface Scale
{
    public function build(): Scale;
    public function get(): array;
    public function transpose(int $steps): Scale;
}
