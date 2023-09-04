<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->group('api', ['filter' => 'auth'], static function ($routes) {
    $routes->get('books', 'Book::index');
    $routes->get('books/(:any)', 'Book::show/$1');
    $routes->post('books', 'Book::create');


    $routes->get('users', 'User::index');
    $routes->get('users/(:any)', 'User::show/$1');
    $routes->post('users', 'User::create');
});

// 404 if path not registered
// $routes->get('(:any)', 'Home::NotFound');
