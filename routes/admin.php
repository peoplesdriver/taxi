<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->get('/admin/index', 'TestController:showAdminIndex');
$app->get('/admin/list', 'TestController:showAdminList');

$app->get('/test', TestController::class.':test');

$app->group('', function () use ($app){
    $app->get('/admin/cars', CarController::class . ':showAdminCars')->setName('car.showAdminCars');
    $app->get('/admin/cars/add', CarController::class . ':addAdminCar')->setName('car.addAdminCar');
    $app->get('/admin/cars/{id}', CarController::class . ':showAdminCar')->setName('car.showAdminCar');

    $app->get('/admin/drivers', DriverController::class . ':showAdminDrivers')->setName('driver.showAdminDrivers');
    $app->get('/admin/drivers/add', DriverController::class . ':addAdminDriver')->setName('driver.addAdminDriver');
    $app->get('/admin/drivers/{id}', DriverController::class . ':showAdminDriver')->setName('driver.showAdminDriver');

    $app->get('/admin/signs', SignController::class . ':showAdminSigns')->setName('sign.showAdminSigns');
    $app->get('/admin/signs/add', SignController::class . ':addAdminSign')->setName('sign.addAdminSign');
    $app->get('/admin/signs/{id}', SignController::class . ':showAdminSign')->setName('sign.showAdminSign');

    $app->get('/admin/users', UserController::class.':showAdminUsers')->setName('user.showAdminUsers');
    $app->get('/admin/users/add', UserController::class.':addAdminUser')->setName('user.addAdminUser');
    $app->get('/admin/users/settings', UserController::class.':settingsAdminUser')->setName('user.settingsAdminUser');
    $app->get('/admin/users/{id}', UserController::class.':showAdminUser')->setName('user.showAdminUser');

    $app->get('/admin/brands', BrandController::class.':showAdminBrands')->setName('brand.showAdminBrands');
    $app->get('/admin/brands/add', BrandController::class.':addAdminBrand')->setName('brand.addAdminBrand');
    $app->get('/admin/brands/{id}', BrandController::class.':showAdminBrand')->setName('brand.showAdminBrand');
})->add(new IsLogin($container));




