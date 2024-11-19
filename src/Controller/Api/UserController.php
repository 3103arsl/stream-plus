<?php

namespace App\Controller\Api;

use App\DTO\CreateUserDTO;
use App\Enum\Country;
use App\Service\UserMapper;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Exception;

#[Route('/api/v1', name: 'api_v1')]
class UserController extends ApiController
{
    #[Route('/signup', name: 'regiser', methods: ['POST'])]
    public function index(
        Request            $request,
        ValidatorInterface $validator,
        LoggerInterface    $logger,
        ManagerRegistry    $doctrine,
        UserMapper         $userMapper,
    ): Response
    {

        try {

            /** @var CreateUserDTO $dto */
            $dto = $this->deserializer->deserializeJson($request, CreateUserDTO::class);

            $errors = $validator->validate($dto);

            if (count($errors) > 0) {
                return new JsonResponse($this->validationErrorHandler->handleValidationErrors($errors));
            }

            /** @var EntityManager $em */
            $em = $doctrine->getManager();

            $user = $userMapper->mapToEntity($dto);

            $em->persist($user);
            $em->flush();

            return new JsonResponse([
                'success' => true,
                'message' => 'User registered successfully!'
            ]);


        } catch (Exception $e) {
            $logger->critical("User Registration Error: {$e->getMessage()}");
        }


        return new JsonResponse([
            'success' => false,
            'message' => 'User has not been registered'
        ]);
    }

    #[Route('/countries', name: 'countries')]
    public function countries(): Response
    {
        $countries = array_map(fn($country) => [
            'code' => $country->name,
            'name' => $country->value
        ], Country::cases());

        return new JsonResponse([
            'data' => $countries
        ]);
    }
}