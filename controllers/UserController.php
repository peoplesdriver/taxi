<?php

class UserController extends Controller
{
    public function showLoginForm($request, $response, $args)
    {
        $this->view = '/public/users/form-login.html.twig';
        $this->twig_vars[] = [];
        $this->render();
    }

    public function login($request, $response, $args)
    {

        $data = $request->getParams();
        if (empty($_COOKIE['city'])  or $_COOKIE['city'] === null){
            setcookie('city', $data['city'], time()+36000, '/');
            return $response->withRedirect($this->ci->router->pathFor('user.login'), 307);
        }
        $user = User::where('ulogin', $data['user']['ulogin'])->first();
        if ($user['upasswd'] == sha1($data['user']['upasswd'])){
            if ($user->login($data, $this->ci->redis)){
                $config = Config::getInstance();
                $path = $this->ci->redis->cmd('HGET', $config->getPrefix().'_user__'.$user->uid, 'startpage')->get();
                if ($path){
                    return $response->withRedirect($this->ci->router->pathFor($path));
                } else {
                    return $response->withRedirect($this->ci->router->pathFor('car.showAdminCars'));
                }
            }
        } else {
            return $response->withRedirect($this->ci->router->pathFor('user.showLoginForm'));
        }

    }

    public function logout($request, $response, $args)
    {
        User::logout();
        return $response->withRedirect($this->ci->router->pathFor('user.showLoginForm'));
    }

    public function showAdminUsers($request, $response, $args)
    {
        $this->view = '/admin/users/list-users.html.twig';
        $this->twig_vars['users'] = User::paginate(10);
        $this->render();
    }

    public function showAdminUser($request, $response, $args)
    {
        $this->view = '/admin/users/form-user.html.twig';
        $this->twig_vars['user'] = User::find($args['id']);
        $this->twig_vars['regions'] = Region::all();
        $this->render();
    }

    public function addAdminUser($request, $response, $args)
    {
        $this->view = '/admin/users/form-user.html.twig';
        $this->twig_vars['regions'] = Region::all();
        $this->render();
    }

    public function createUser($request, $response, $args)
    {
        $data = $request->getParams();
        $data['user']['upasswd'] = sha1($data['user']['upasswd']);
        User::create($data['user']);
        return $response->withRedirect($this->ci->router->pathFor('user.showAdminUsers'));
    }

    public function updateUser($request, $response, $args)
    {
        $data = $request->getParams();
        $data['user']['upasswd'] = sha1($data['user']['upasswd']);
        User::find($args['id'])->update($data['user']);
        return $response->withRedirect($this->ci->router->pathFor('user.showAdminUsers'));
    }

    public function deleteUser($request, $response, $args)
    {
        User::destroy($args['id']);
        return $response->withRedirect($this->ci->router->pathFor('user.showAdminUsers'));
    }

    public function settingsAdminUser($request, $response, $args)
    {
        $this->view = '/admin/users/form-settings-user.html.twig';
        $this->twig_vars[] = [];
        $this->render();
    }

    public function settingsUser($request, $response, $args)
    {
        $data = $request->getParams();
        $user = User::find($_COOKIE['id']);
        if (!($data['oldpassword'] != 0 && $data['newpassword1'] != 0 && $data['newpassword2'] != 0)){
            if ($user->upasswd == sha1($data['oldpassword']) &&
                $data['newpassword1'] == $data['newpassword2']){
                $user->update(['upasswd' => sha1($data['newpassword1'])]);
            }
        }

        if ($data['startpage']){
            $redis = new Redis();
            $redis->cmd('HSET', 'user__'.$_COOKIE['id'], 'startpage', $data['startpage'])->set();
        }
        return $response->withRedirect($this->ci->router->pathFor('user.showAdminUsers'));

    }

}