<?php

namespace App\Controller\Api;

use App\Repository\AvTravelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/av/travel', name: 'api_av_travel_')]
class AvTravelController extends AbstractController
{
    #[Route('/index', name: 'index')]
    public function index(AvTravelRepository $tr): JsonResponse
    {
        $travels = $tr->findAll();
        return $this->json($travels, context:['groups' => "api_av_travel_index" ]);
    }

    #[Route('/{id}', name: 'id')]
    public function travelDetails(AvTravelRepository $tr, int $id): JsonResponse
    {
        $travels = $tr->find($id);
        return $this->json($travels, context: ['groups' => "api_av_travel_index"]);
    }

    #[Route('/newness', name: 'newness')]
    public function travelNewness(AvTravelRepository $tr, int $id): JsonResponse
    {
        $travels = $tr->findAll();
        return $this->json($travels, context: ['groups' => "api_av_travel_index"]);
    }
}
