<?php
namespace App\Controller;

use App\Z\Abstract\AbstractController;
use App\Z\Routing\Route;
use Symfony\Component\HttpFoundation\Response;


    class CountryController extends AbstractController
    {
        #[Route('/', name: "country.index", methods: ['GET'])]
        public function index() : Response
        {
            $pays = "France";
            return $this->render("country/index.html.twig", ['pays' => $pays]);
        }

        #[Route('/test/{id}', name: "country.test", methods: ['GET'])]
        public function test($params) : Response
        {
            return new Response(
                "Page de test avec le paramètre $params[0]",
                Response::HTTP_OK,
                ['content-type' => 'text/html']
            );
        }
    }