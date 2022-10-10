<?php
namespace App\Z\Routing;

use App\Z\Routing\Route;
use App\Z\Routing\RouterInterface;
use Symfony\Component\HttpFoundation\Request;

    class Router implements RouterInterface
    {
        /**
         * Cette propriété représente les données de la requete du client
         */
        private $request;

        /**
         * Cette propriété represente l'armoire a route
         *
         * @var array
         */
        private array $route = [];

        /**
         * Cette propriété représente les parametres de la route qui a matché
         */
        private array $parameters = [];

        public function __construct(Request $request, array $controllers)
        {
            $this->request = $request;
            $this->sortRoutesByName($controllers);
        }

                /**
         * Cette methode du routeur recupère tous les controlleurs,
         * les tris et les sauvegarde dans un tableau (armoires à routes)
         * en fonction de leur nom.
         *
         * @param array $controllers
         * @return void
         */
        public function sortRoutesByName(array $controllers) : void
        {
            foreach ($controllers as $controller)
            {
                $reflectionController = new \ReflectionClass($controller);

                foreach ($reflectionController->getMethods() as $reflectionMethod) 
                {
                    $routesAttributes = $reflectionMethod->getAttributes(Route::class);

                    foreach ($routesAttributes as $routesAttribute) 
                    {
                        $route = $routesAttribute->newInstance();

                        $this->routes[$route->getName()] = [
                            'class'  => $reflectionMethod->class,
                            'method' => $reflectionMethod->name,
                            'route'  => $route
                        ];
                    }
                }
            }
        }

        /**
         * Cette methode du routeur permet de l'executer.
         *
         * elle retourne ensuite au noyau une reponse qui peut etre :
         *  -nulle si l'ui de l'url ne match avec aucune uri d'une route dont l'application attend la reception
         *  -ou un tableau contenant le controlleur censé gerer la requete du client
         * @return array|null
         */
        public function run() : ?array
        {
            foreach ($this->routes as $route)
            {
                if($this->matchWith($this->request->server->get('REQUEST_URI'), $route['route']->getPath()))
                {
                    if(isset($this->parameters) && !empty($this->parameters))
                    {
                        return [
                            'route' => $route,
                            'parameters' => $this->parameters
                        ];
                    }
                    return [
                        'route' => $route,
                    ];
                }
            }
        }

        /**
         * Cette methode permet de verifier si l'uri de l'url match avec l'uri de la route
         *
         * @param string $uri_url
         * @param string $uri_route
         * @return boolean
         */
        private function matchWith(string $uri_url, string $uri_route) : bool
        {
            $pattern = preg_replace("#{[a-z]+}#", "([0-9a-zA-Z-_]+)", $uri_route);
            $pattern = "#^$pattern$#";

            if ( preg_match($pattern, $uri_url, $matches))
            {
                array_shift($matches);
                $this->parameters = $matches;
                return true;
            }
            return false;
        }
    }