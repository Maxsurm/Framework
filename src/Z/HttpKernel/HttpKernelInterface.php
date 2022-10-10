<?php
namespace App\Z\HttpKernel;

use Symfony\Component\HttpFoundation\Response;

    Interface HttpKernelInterface
    {
        /**
         * Cette Methode du kernel lui permet de soummettre la requete du client
         * et de recuperer la reponse correspondante
         *
         * @return Response
         */
        public function handleRequest() : Response;
    }