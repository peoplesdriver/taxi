<?php
class DriverController extends Controller
{
    public function showAdminDrivers($request, $response, $args)
    {
        $this->view = '/admin/drivers/list-drivers.html.twig';
        $this->twig_vars['drivers'] = Driver::paginate(10);
        $this->render();
    }

    public function showAdminDriver($reques, $response, $args)
    {
        $this->view = '/admin/drivers/form-driver.html.twig';
        $this->twig_vars['driver'] = Driver::find($args['id']);
        $this->twig_vars['regions'] = Region::all();
        $this->twig_vars['filials'] = Filial::all()->toArray();
        $this->twig_vars['kurators'] = Kurator::all()->toArray();
        $this->render();
    }

    public function addAdminDriver($request, $response, $args)
    {
        $this->view = '/admin/drivers/form-driver.html.twig';
        $this->twig_vars[] = [];
        $this->twig_vars['title'] = 'Водитель';
        $this->twig_vars['filials'] = Filial::all()->toArray();
        $this->twig_vars['kurators'] = Kurator::all()->toArray();
        $this->twig_vars['regions'] = Region::all();
        $this->render();
    }

    public function createDriver($requst, $response, $args)
    {
        $data = $requst->getParams();
        Driver::create($data['driver']);
        return $response->withRedirect($this->ci->router->pathFor('driver.showAdminDrivers'));
    }

    public function updateDriver($request, $response, $args)
    {
        $data = $request->getParams();
        Driver::find($args['id'])->update($data['driver']);
        return $response->withRedirect($this->ci->router->pathFor('driver.showAdminDrivers'));
    }

    public function deleteDriver($request, $response, $args)
    {
        Driver::destroy($args['id']);
        return $response->withRedirect($this->ci->router->pathFor('driver.showAdminDrivers'));
    }



}