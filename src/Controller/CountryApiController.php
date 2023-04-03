<?php

declare(strict_types=1);

namespace App\Controller;

use App\Enum\CountryCode;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CountryApiController extends AbstractController
{
    #[Route('/api/v1/country', name: 'app_index_country', methods: 'GET')]
    public function index(): JsonResponse
    {
        return new JsonResponse(CountryCode::getAllValues(), Response::HTTP_OK);
    }
}
