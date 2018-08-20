<?php

use Illuminate\Database\Capsule\Manager as DB;

class TestController extends Controller
{

    public function showIndex($request, $response, $args)
    {
        $this->view = '/public/layout.html.twig';
        $this->twig_vars['name'] = 'Игорь';
        return $this->render('login.html.twig');
    }

    public function showAdminIndex($request, $response, $args)
    {
        $this->view = '/admin/examples/edit.html.twig';
        return $this->render();
    }

    public function showAdminList($request, $response, $args)
    {
        $this->view = '/admin/examples/list.html.twig';
        return $this->render();
    }



        public function test($request, $response, $args)
        {
            $password = 'test';
            $password = sha1($password);

            $user = User::create(['ulogin'=>'test', 'upasswd'=>$password, 'ufullname'=>'test',
                'uphone'=>'79235950055', 'umail'=>'test@test.ru', 'urole'=>0]);

            //$user = DB::table('core_users')->insert(['ulogin'=>'test', 'upasswd'=>$password, 'ufullname'=>'test',
            //    'uphone'=>'79235950055', 'umail'=>'test@test.ru', 'urole'=>0]);
            ddd($user);

        }

        public function good($request, $response, $args)
        {
            $this->view = '/public/good.html.twig';
            $this->twig_vars['test'] = Driver::find(9)->sex();
            ddd(Driver::find(9)->sex()->get()->toArray());
            $this->render();

        }

}