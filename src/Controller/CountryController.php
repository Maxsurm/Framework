<?php
namespace App\Controller;

use App\Z\Routing\Route;
use Symfony\Component\HttpFoundation\Response;


    class CountryController
    {
        #[Route('/', name: "country.index", methods: ['GET'])]
        public function index() : Response
        {
            return new Response(
                "Page d'accueil",
                Response::HTTP_OK,
                ['content-type' => 'text/html']
            );
        }

        #[Route('/test/{id}', name: "country.test", methods: ['GET'])]
        public function test($params)
        {
            return new Response(
                "Page de test avec params",
                Response::HTTP_OK,
                ['content-type' => 'text/html']
            );
        }
    }