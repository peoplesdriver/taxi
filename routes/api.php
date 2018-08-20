<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->post('/api/cars', CarController::class.':createCar')->setName('car.createCar');
$app->post('/api/cars/{id}', CarController::class.':updateCar')->setName('car.updateCar');
$app->get('/api/cars/{id}/delete', CarController::class.':deleteCar')->setName('car.deleteCar');

$app->post('/api/drivers', DriverController::class.':createDriver')->setName('driver.createDriver');
$app->post('/api/drivers/{id}', DriverController::class.':updateDriver')->setName('driver.updateDriver');
$app->get('/api/drivers/{id}/delete', DriverController::class.':deleteDriver')->setName('driver.deleteDriver');

$app->post('/api/signs', SignController::class.':createSign')->setName('sign.createSign');
$app->post('/api/signs/{id}', SignController::class.':updateSign')->setName('sign.updateSign');
$app->get('/api/signs/{id}/delete', SignController::class.':deleteSign')->setName('sign.deleteSign');

$app->post('/api/users', UserController::class.':createUser')->setName('user.createUser');
$app->post('/api/users/settings', UserController::class.':settingsUser')->setName('user.settingsUser');
$app->post('/api/users/{id}', UserController::class.':updateUser')->setName('user.updateUser');
$app->get('/api/users/{id}/delete', UserController::class.':deleteUser')->setName('user.deleteUser');

$app->post('/api/brands', BrandController::class.':createBrand')->setName('brand.createBrand');
$app->post('/api/brands/{id}', BrandController::class.':updateBrand')->setName('brand.updateBrand');
$app->get('/api/brands/{id}/delete', BrandController::class.':deleteBrand')->setName('brand.deleteBrand');

$app->post('/api/login', UserController::class.':login')->setName('user.login');

