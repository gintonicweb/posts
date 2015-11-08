<?php
use Cake\Routing\Router;

Router::scope('/', ['plugin' => 'Posts'], function ($routes) {

    $routes->connect('/posts', ['controller' => 'Posts']);
    $routes->connect('/posts/:action/*', ['controller' => 'Posts']);
    $routes->fallbacks('DashedRoute');
});
