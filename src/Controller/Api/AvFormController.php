<?php

namespace App\Controller\Api;

use App\Entity\AvForm;
use App\Entity\AvUser;
use App\Repository\AvFormRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface as SerializerSerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/api/av/form', name: 'api_av_form_', methods: ['POST'])]
class AvFormController extends AbstractController
{
    

    #[Route('/index', name: 'index', methods: ['POST'])]
    public function new(SerializerSerializerInterface $serializer, ValidatorInterface $validator, EntityManagerInterface $em, Request $request): JsonResponse
    {

        // $form = $serializer->deserialize($request->getContent(), AvForm::class, 'json', ['groups' => "api_av_form_index"]);

        // $errors = $validator->validate($form);
        // if ($errors->count()) {
        //     $messages = [];
        //     foreach ($errors as $error) {
        //         $messages[] = $error->getMessage();
        //     }
        //     return $this->json($messages, Response::HTTP_UNPROCESSABLE_ENTITY);
        // } else {
        //     $em->persist($form);
        //     $em->flush();

        //     return $this->json('La demande a bien été envoyé', Response::HTTP_CREATED);
        // }


        $data = json_decode($request->getContent(), true);
        $firstname = $data["firstname_user"];
        $lastname = $data["lastname_user"];
        $password = $data["password"];
        $phone = $data["phone_user"];
        $email = $data["email"];
        $message = $data["message_form"] ?: "";
        // $travel = $data["travel"];
        // $status = $data["status"];

        $newReservation = new AvForm();
        $newReservation->setMessageForm($message);
        $newReservation = new AvUser();
        $newReservation->setFirstnameUser($firstname);
        $newReservation->setLastnameUser($lastname);
        $newReservation->setPhoneUser($phone);
        $newReservation->setEmail($email);
        $newReservation->setPassword($password);
        
        // $newReservation->setTripId($travel);
        // $newReservation->setAvStatus($status);


        $em->persist($newReservation);
        $em->flush();

        $responseText = "Réservation envoyée";

        return new JsonResponse($responseText, Response::HTTP_OK);
    }


        






}
