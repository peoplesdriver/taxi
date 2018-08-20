<?php

class CarController extends Controller
{
    public function showAdminCars($request, $response, $args)
    {
        $this->view = '/admin/cars/list-cars.html.twig';
        $this->twig_vars['cars'] = Car::paginate(10);
        $this-> render();
    }

    public function showAdminCar($request, $response, $args)
    {
        $this->view = '/admin/cars/form-car.html.twig';
        $this->twig_vars['car'] = Car::find($args['id']);
        $this->twig_vars['regions'] = Region::all();
        $cur_date = getdate();
        $this->twig_vars['cur_year'] = $cur_date['year'];
        $this->twig_vars['cartypes'] = CarType::all();
        $this->render();
    }

    public function addAdminCar($request, $response, $args)
    {
        $select_data = CoreCartypes::all()->toArray();
        $this->view = '/admin/cars/form-car.html.twig';
        $this->twig_vars[] = [];
        $this->twig_vars['regions'] = Region::all();
        $this->twig_vars['title'] = 'Автомобиль';
        $this->twig_vars['selectd'] = $select_data;
        $cur_date = getdate();
        $this->twig_vars['cur_year'] = $cur_date['year'];
        $this->twig_vars['cartypes'] = CarType::all();
        $this->render();
    }

    public function createCar($request, $response, $args)
    {
        $data = $request->getParams();
        Car::create($data['car']);
        return $response->withRedirect($this->ci->router->pathFor('car.showAdminCars'));

    }

    public function updateCar($request, $response, $args)
    {
        $data = $request->getParams();
        Car::find($args['id'])->update($data['car']);
        return $response->withRedirect($this->ci->router->pathFor('car.showAdminCars'));
    }

    public function deleteCar($request, $response, $args)
    {
        Car::destroy($args['id']);
        return $response->withRedirect($this->ci->router->pathFor('car.showAdminCars'));
    }

}