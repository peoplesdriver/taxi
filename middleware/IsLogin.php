<?php
Class IsLogin
{
    private $ci;

    public function __construct($container) {
        $this->ci = $container;
    }

    public function __invoke($request, $response, $next)
    {
        $id = $_COOKIE['id'];
        $token = $_COOKIE['token'];
        if ($id) {
            $config = Config::getInstance();
            if ($this->ci->redis->cmd('HGET', $config->getPrefix().'_user__'.$id, 'token')->get() == $token){
                return $response = $next($request, $response);
            }
            echo 'Token Error';
        } else {
            return $response->withRedirect($this->ci->router->pathFor('user.showLoginForm'));
        }
    }
}