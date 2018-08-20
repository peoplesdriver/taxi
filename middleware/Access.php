<?php

class Access
{
    private $container;
    private $permissions;
 
    public function __construct($container, $permissions) {
      $this->container = $container;
        $this->permissions = $permissions;
    }
 
    public function __invoke($request, $response, $next)
    {
        $user = $this->container['sentinel']->check();
        if ($user->hasAccess($this->permissions)) {
            return $response = $next($request, $response);
        } else {
            return $response->withStatus(301)->withHeader('Location', '/message/no-access');
        }
    }
 
}