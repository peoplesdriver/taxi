<?php

class Registred
{
    private $container;

    public function __construct($container) {
        $this->container = $container;
    }

    public function __invoke($request, $response, $next)
    {

        $user = $this->container['sentinel']->check();

        if ($user || $request->getUri()->getPath() == '/login' || $request->getUri()->getPath() == '/api/login' ) {
            unset($_SESSION['user']); 
            
            if ($user) {
                $role = $user->getRoles()->first()->toArray();
                $_SESSION['user'] = $user->getAttributes();
                $_SESSION['user']['role'] = $role;              
            }

            return $response = $next($request, $response);
        } else {
            $this->container['flash']->addMessage('notlogin', 'Необходимо авторизоваться');
            return $response->withStatus(301)->withHeader('Location', '/login');
        }
    }
}