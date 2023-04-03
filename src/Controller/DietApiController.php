<?php

declare(strict_types=1);

namespace App\Controller;

use App\Request\DietCreateRequest;
use App\Service\DietService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DietApiController extends AbstractController
{
    public function __construct(private readonly DietService $dietService)
    {
    }

    #[Route('/api/v1/diet', name: 'app_index_diet', methods: 'GET')]
    public function index(): JsonResponse
    {
        return new JsonResponse([], Response::HTTP_OK);
    }

    #[Route('/api/v1/diet', name: 'app_create_diet', methods: 'POST')]
    public function create(DietCreateRequest $request): JsonResponse
    {
        $this->dietService->createDiet(
            $request->getCountryCode(),
            $request->getDateStart(),
            $request->getDateEnd()
        );

        return new JsonResponse('Entity created', Response::HTTP_CREATED);
    }
}
