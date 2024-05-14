<?php

namespace App\Controller\Api;

use App\Entity\AvForm;
use App\Entity\AvStatus;
use App\Entity\AvTravel;
use App\Entity\AvUser;
use App\Repository\AvFormRepository;
use App\Repository\AvTravelRepository;
use App\Repository\AvUserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface as SerializerSerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;


class AvFormController extends AbstractController
{


    #[Route('/api/av/form', name: 'api_av_form_', methods: ['POST'])]
    public function new(SerializerSerializerInterface $serializer, ValidatorInterface $validator, EntityManagerInterface $em, Request $request,  AvUserRepository $userRepository, AvFormRepository $formRepository): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $firstname = $data["firstname_user"];
        $lastname = $data["lastname_user"];
        $password = $data["password"];
        $phone = $data["phone_user"];
        $email = $data["email"];
        $message = $data["message_form"] ?: "";
        $travel = $em->getRepository(AvTravel::class)->findOneBy(["id" => $data["id"]]);
        $status = $em->getRepository(AvStatus::class)->findOneBy(["id" => $data["status"]]);

        $existingAccount = $userRepository->findBy(['email' => $email]);
        if ($existingAccount) {
            return new JsonResponse(["message" => "L'email existe déjà"], Response::HTTP_CONFLICT);
        } else {

            $user = new AvUser();
            $user->setEmail($email);
            $user->setPhoneUser($phone);
            $user->setLastnameUser($lastname);
            $user->setFirstnameUser($firstname);
            $user->setPassword("ViveLesVacances");
            $user->setRoles(["ROLE_USER"]);


            $em->persist($user);
            $em->flush();
            $id = $em->getConnection()->lastInsertId();
            $user->setId($id);


            $newReservation = new AvForm();
            $newReservation->setMessageForm($message);
            $newReservation->setAvTravel($travel);
            $newReservation->setAvStatus($status);
            $newReservation->setAvUser($user);
            


            $em->persist($newReservation);
            $em->flush();


            $responseText = "Réservation envoyée";

            return new JsonResponse($responseText, Response::HTTP_OK);
        }
    }
}
