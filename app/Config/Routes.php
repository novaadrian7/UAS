<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->post('/choose/(:segment)', 'Home::choose/$1');
$routes->get('/logout', 'Home::logout');

$routes->get('/books', 'Books::index'); // unified route
$routes->get('/books/add', 'Books::add');
$routes->post('/books/save', 'Books::save');

$routes->get('/books/edit/(:num)', 'Books::edit/$1');
$routes->post('/books/update/(:num)', 'Books::update/$1');
$routes->get('/books/delete/(:num)', 'Books::delete/$1');

$routes->get('/login', 'LoginController::index');
$routes->post('/login', 'LoginController::login');
$routes->get('/logout', 'LoginController::logout');

$routes->get('/', function () {
    return redirect()->to('/login');
});
