<?php

namespace App;

use App\Z\Routing\RouterInterface;
use Psr\Container\ContainerInterface;
use App\Z\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpFoundation\Response;


/**
 * Kernel
 * 
 * Ce fichier reprensente le noyau de l'application
 * 
 * son role principal est de :
 *      -Soumettre la requete
 *      -Recuperer la réponse correspondante
 *      -Envoyer cette reponse au Frontcontroller
 * 
 * @author Maxsurm <surmontmaxime@gmail.com>
 * @version 1.0.0
 */

class Kernel implements HttpKernelInterface
{
    /**
     * Le conteneur de dependances
     *
     * @var ContainerInterface
     */
    private ContainerInterface $container;

    /**
     * Cette propriété represente le noyau dans lui-meme
     *
     * @var [type]
     */
    private static $kernel;

    /**
     * A chaque fois qu'une nouvelle instance du noyau est créé : 
     *      - On récupère le conteneur de dépendances
     *
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        self::$kernel = $this;
        $this->container = $container;
    }
    /**
     * Cette Methode du kernel lui permet de soummettre la requete du client
     * et de recuperer la reponse correspondante
     * 
     * grace au noyau
     *
     * @return Response
     */
    public function handleRequest(): Response
    {
        $router = $this->container->get(RouterInterface::class);
        $router_response = $router->run();
        $controller_response = $this->getControllerResponse($router_response);
        return $controller_response;
    }

    private function getControllerResponse($router_response)
    {
        if (!is_array($router_response) && ($router_response === null)) {
            $controller_needed = $this->container->get('controllers')['ErrorController'];
            $error_controller = new $controller_needed;
            $response = $error_controller->notFound();
            return $response;
        }

        $controller = $router_response['route']['class'];
        $method = $router_response['route']['method'];

        if (is_array($router_response) && !empty($router_response)) {
            if (!empty ($router_response['parameters'])) {
                $parameters = $router_response['parameters'];
                return $this->container->call([$controller, $method], [$parameters]);
            }
            return $this->container->call([$controller, $method]);
        }
    }

    public static function getKernel()
    {
        return self::$kernel;
    }

    public function getContainer()
    {
        return $this->container;
    }
}
