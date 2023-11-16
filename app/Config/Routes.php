<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

//login
$routes->get('/login', 'Login::index');
$routes->get('/logout', 'Login::logout');
$routes->post('/login', 'Login::validation');

//registrasi
$routes->get('/register', 'Register::index');
$routes->post('/register', 'Register::store');

//dashboard
$routes->get('/dashboard', 'Dashboard::index');

//topup
$routes->get('/topup', 'TopUp::index');
$routes->post('/topup', 'TopUp::store');

//service
$routes->get('/service/(:segment)', 'Service::index/$1');
$routes->post('/service/(:segment)', 'Service::store/$1');

//transaction

$routes->get('/transaction', 'Transaction::index/$1');
$routes->get('/transaction/(:num)', 'Transaction::index/$1');

//profile

$routes->get('/account', 'Profile::index');
$routes->get('/account/update', 'Profile::edit');
$routes->post('/account/update', 'Profile::store');