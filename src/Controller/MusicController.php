<?php

namespace App\Controller;

use App\Notation\ScaleName;
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
        return new JsonResponse(implode("|", $m->new(ScaleName::Diatonic)->get()));
    }
}
