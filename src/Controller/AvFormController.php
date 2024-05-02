<?php

namespace App\Controller;

use App\Entity\AvForm;
use App\Form\AvFormType;
use App\Repository\AvFormRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/av/form')]
#[IsGranted('ROLE_ADMIN', statusCode: 423, message: "Vous n'avez pas les droits pour accéder à cette page")]

class AvFormController extends AbstractController
{
    #[Route('/', name: 'app_av_form_index', methods: ['GET'])]
    public function index(AvFormRepository $avFormRepository): Response
    {
        return $this->render('av_form/index.html.twig', [
            'av_forms' => $avFormRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_av_form_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $avForm = new AvForm();
        $form = $this->createForm(AvFormType::class, $avForm);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($avForm);
            $entityManager->flush();

            return $this->redirectToRoute('app_av_form_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('av_form/new.html.twig', [
            'av_form' => $avForm,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_av_form_show', methods: ['GET'])]
    public function show(AvForm $avForm): Response
    {
        return $this->render('av_form/show.html.twig', [
            'av_form' => $avForm,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_av_form_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, AvForm $avForm, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AvFormType::class, $avForm);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_av_form_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('av_form/edit.html.twig', [
            'av_form' => $avForm,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_av_form_delete', methods: ['POST'])]
    public function delete(Request $request, AvForm $avForm, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$avForm->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($avForm);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_av_form_index', [], Response::HTTP_SEE_OTHER);
    }
}
