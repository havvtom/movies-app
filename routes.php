<?php

$url = Request::url();

$requestMethod = Request::method();

$router = new Router;

$router->get('', 'PagesController@home');
$router->get('contact', 'PagesController@contact');
$router->get('favorites', 'PagesController@favorites');
$router->post('favorite', 'PagesController@favorite');
$router->post('unfavorite', 'PagesController@unfavorite');
$router->post('login' , 'UserController@login');
$router->post('logout' , 'UserController@logout');
$router->post('register', 'UserController@store');

$router->direct($url, $requestMethod);