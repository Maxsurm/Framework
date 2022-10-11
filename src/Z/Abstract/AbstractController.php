<?php
    namespace App\Z\Abstract;
    
    use App\Kernel;
    use Twig\Environment;
    use Symfony\Component\HttpFoundation\Response;
    
        abstract class AbstractController
        {
            
            private $container;
    
            public function __construct()
            {
                $this->container = Kernel::getKernel()->getContainer();
            }
    
            public function render(string $view_path, array $parameters = [])
            {
                $content = $this->renderView($view_path, $parameters);
    
                $response = new Response();
    
                $response->setContent($content);
    
                return $response;
            }
    
            public function renderView(string $view_path, array $parameters = [])
            {
                $twig = $this->container->get(Environment::class);
    
                $content = $twig->render($view_path, $parameters);
    
                return $content;
            }
    
    
        }