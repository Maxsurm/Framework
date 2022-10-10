<?php

namespace App\Z\Routing;

interface RouteInterface
{
    /**
     * Cette methode permet de récuperer l'url de la route.
     *
     * @return string
     */
    public function getPath(): string;

    /**
     * Cette methode permet de récuperer le nom de la route.
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Cette methode permet de récuperer le tableau des méthodes
     * ou verbes d'envoi des données.
     *
     * @return array
     */
    public function getMethods(): array;
}
