<?php

namespace App\Controller\Api;

use App\Entity\AvTravel;
use App\Repository\AvCategoryRepository;
use App\Repository\AvTravelRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/av/travel', name: 'api_av_travel_')]  
class AvTravelController extends AbstractController
{
    #[Route('/index', name: 'index')]
    public function index(AvTravelRepository $tr, AvCategoryRepository $cr): JsonResponse
    {
        $travels = $tr->findAll();
        $categories = $cr->findAll();
        return $this->json(["travel" => $travels, "categories" => $categories], context:['groups' => "api_av_travel_index"], );

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

    #[Route('/category/show', name: 'category')]
    public function categoriesFilter(AvTravelRepository $tr): JsonResponse
    {
        $categories = $tr->findAll();
        return $this->json($categories, context: ['groups' => "api_av_travel_index"]);
    }

    #[Route('/categoriesFilter/{id}', name: 'api_av_categories_', methods: ["GET"])]
    public function filterByCategory(EntityManagerInterface $em, int $id): JsonResponse
    {
        $qb = $em->createQueryBuilder();

        $categories = $qb->select('travel')
        ->from(AvTravel::class, 'travel')
        ->join('travel.AvCategory', 'category_travel')
        ->where('category_travel.id = :id')
        ->setParameter('id', $id)
        ->getQuery()
            ->getResult();

        return $this->json($categories, context: [
            'groups' =>  ["api_av_travel_index"]
        ]);
    }
    
}
