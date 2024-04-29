<?php

namespace App\Controller;

use App\Entity\AvTravel;
use App\Form\AvTravelType;
use App\Repository\AvTravelRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/av/travel')]
class AvTravelController extends AbstractController
{
    #[Route('/', name: 'app_av_travel_index', methods: ['GET'])]
    public function index(AvTravelRepository $avTravelRepository): Response
    {
        return $this->render('av_travel/index.html.twig', [
            'av_travels' => $avTravelRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_av_travel_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $avTravel = new AvTravel();
        $form = $this->createForm(AvTravelType::class, $avTravel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($avTravel);
            $entityManager->flush();

            return $this->redirectToRoute('app_av_travel_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('av_travel/new.html.twig', [
            'av_travel' => $avTravel,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_av_travel_show', methods: ['GET'])]
    public function show(AvTravel $avTravel): Response
    {
        return $this->render('av_travel/show.html.twig', [
            'av_travel' => $avTravel,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_av_travel_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, AvTravel $avTravel, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AvTravelType::class, $avTravel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_av_travel_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('av_travel/edit.html.twig', [
            'av_travel' => $avTravel,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_av_travel_delete', methods: ['POST'])]
    public function delete(Request $request, AvTravel $avTravel, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$avTravel->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($avTravel);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_av_travel_index', [], Response::HTTP_SEE_OTHER);
    }
}
