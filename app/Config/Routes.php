<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/',           'Main::index');
$routes->post('/submit',    'Main::submit');
