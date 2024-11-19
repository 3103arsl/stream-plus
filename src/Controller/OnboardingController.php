<?php

namespace App\Controller;

use App\Controller\Api\ApiController;
use App\Form\UserFormType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OnboardingController extends ApiController
{
    #[Route('/', name: 'onboarding')]
    public function index(): Response
    {
        // Custom logic for the index action
        // return new Response('Parent index action');

        $form = $this->createForm(UserFormType::class);
        return $this->render('onboarding.twig', [
            'form' => $form->createView(),
        ]);
    }


    /**
     * @param Request $request
     * @return JsonResponse
     */
    #[Route('/step/validate', name: 'step_validate', methods: ['POST'])]
    public function validateStep(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $form = $this->createForm(UserFormType::class);
        $form->submit($data);

        if (!$form->isValid()) {
            $errors = [];
            foreach ($form->getErrors(true) as $error) {
                $errors[] = [
                    'field' => $error->getOrigin()->getName(),
                    'message' => $error->getMessage(),
                ];
            }
            return $this->json(['success' => false, 'errors' => $errors], 400);
        }

        return $this->json(['success' => true]);
    }

}