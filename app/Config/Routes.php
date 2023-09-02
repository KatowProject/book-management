<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->group('/api', ['filter' => 'auth'], static function ($routes) {
    $routes->get('books', 'Book::index');
    $routes->get('users', 'User::index');
});