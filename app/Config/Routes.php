<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('Login', 'Home::login');
$routes->get('Logout', 'Home::logout');
$routes->get('Dashboard', 'Dashboard::index');
$routes->get('Admin', 'Admin::index');
$routes->get('Admin/users', 'Admin::users');

