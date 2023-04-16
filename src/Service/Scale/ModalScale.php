<?php

namespace App\Service\Scale;

use App\Notation\Mode;

interface ModalScale extends Scale
{
    public function changeMode(Mode $mode): Scale;
}
