<?php 
namespace App\Z\Routing;

    Interface RouterInterface
    {
        /**
         * Cette methode du routeur recupère tous les controlleurs,
         * les tris et les sauvegarde dans un tableau (armoires à routes)
         * en fonction de leur nom.
         *
         * @param array $controllers
         * @return void
         */
        public function sortRoutesByName($controllers): void;

        /**
         * Cette methode du routeur permet de l'executer.
         *
         * elle retourne ensuite au noyau une reponse qui peut etre :
         *  -nulle si l'ui de l'url ne match avec aucune uri d'une route dont l'application attend la reception
         *  -ou un tableau contenant le controlleur censé gerer la requete du client
         * @return array|null
         */
        public function run() : ?array;
    }