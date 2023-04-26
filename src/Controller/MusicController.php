<?php

namespace App\Controller;

use App\Notation\ScaleName;
use App\Service\Progression\Progression;
use App\Service\Scale\ScaleFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class MusicController extends AbstractController
{
    #[Route("/", name: "music")]
    public function getMusicString()
    {
        $m = new ScaleFactory();
        $p = new Progression($m->new(ScaleName::Diatonic)->get());
        $prog = $p->generateProgression();
        $progression = $p->analyzeProgression($prog);
        return new JsonResponse($progression);
    }
}
