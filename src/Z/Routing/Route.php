<?php

namespace App\Z\Routing;

use App\Z\Routing\RouteInterface;

#[\Attribute(\Attribute::TARGET_METHOD)]
class Route implements RouteInterface
{
    /**
     * Cette propriété représente l'uri de la route
     *
     * @var string
     */
    private string $path;

        /**
     * Cette propriété représente le nom de la route
     *
     * @var string
     */
    private string $name;

        /**
     * Cette propriété représente les methodes de la route
     *
     * @var array
     */
    private array $methods = [];



    public function __construct(string $path, string $name, array $methods = ['GET'])
    {
        $this->path    = $path;
        $this->name    = $name;
        $this->methods = $methods;
    }

    /**
     * Cette methode permet de récuperer l'url de la route.
     *
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * Cette methode permet de récuperer le nom de la route.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Cette methode permet de récuperer le tableau des méthodes
     * ou verbes d'envoi des données.
     *
     * @return array
     */
    public function getMethods(): array
    {
        return $this->methods;
    }
}
