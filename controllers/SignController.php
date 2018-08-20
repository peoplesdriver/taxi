<?php

class SignController extends Controller
{
    public function showAdminSigns($request, $response, $args)
    {
        $this->view = '/admin/signs/list-signs.html.twig';
        $this->twig_vars['signs'] = Sign::paginate(10);
        $this->render();
    }

    public function showAdminSign($request, $response, $args)
    {
        $this->view = '/admin/signs/form-sign.html.twig';
        $this->twig_vars['sign'] = Sign::find($args['id']);
        $this->twig_vars['regions'] = Region::all();
        $this->twig_vars['cars'] = Car::all();
        $this->twig_vars['drivers'] = Driver::all();
        $this->render();
    }

    public function addAdminSign($requesr, $response, $args)
    {

        $this->view = '/admin/signs/form-sign.html.twig';
        $this->twig_vars['title'] = 'Позывной';
        $this->twig_vars['cars'] = Car::all();
        $this->twig_vars['regions'] = Region::all();
        $this->twig_vars['drivers'] = Driver::all();
        $this->render();
    }

    public function createSign($request, $response, $args)
    {
        $data = $request->getParams();
        Sign::create($data['sign']);
        return $response->withRedirect($this->ci->router->pathFor('sign.showAdminSigns'));
    }

    public function deleteSign($request, $response, $args)
    {
        Sign::destroy($args['id']);
        return $response->withRedirect($this->ci->router->pathFor('sign.showAdminSigns'));
    }

    public function updateSign($request, $response, $args)
    {
        $data = $request->getParams();
        Sign::find($args['id'])->update($data['sign']);
        return $response->withRedirect($this->ci->router->pathFor('sign.showAdminSigns'));
    }

}