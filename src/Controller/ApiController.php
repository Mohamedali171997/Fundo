<?php

// src/Controller/ApiController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    #[Route('/generate-api-url', name: 'generate_api_url')]
    public function generateApiUrl(): JsonResponse
    {
        // Generate the API URL dynamically based on manual input coordinates
        $apiUrl = $this->generateApiUrlLogic(33.971, 9.562); // Manually inputted coordinates

        // Return the URL as a JSON response
        return $this->json(['api_url' => $apiUrl]);
    }

    private function generateApiUrlLogic(float $latitude, float $longitude): string
    {
        // Construct the API URL using the manually inputted coordinates
        // Replace the example URL with the actual base URL of your API endpoint
        $baseUrl = 'https://www.openstreetmap.org/#map=6/';
        $apiUrl = $baseUrl . $latitude . '/' . $longitude . '/'; // Construct the URL with coordinates

        return $apiUrl;
    }
}
