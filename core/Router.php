<?php

class Router
{
	public $routes = [
		'GET' => [],
		'POST' => []
	];

	public function define($routes)
	{
		$this->routes = $routes;
	}

	public function get($url, $controller)
	{
		$this->routes['GET'][$url] = $controller;
	}

	public function post($url, $controller)
	{
		$this->routes['POST'][$url] = $controller;
	}

	public function direct($url, $requestMethod)
	{
		if(array_key_exists($url, $this->routes[$requestMethod])){

			return $this->callAction(
				...explode('@', $this->routes[$requestMethod][$url])
			);

		}

		throw new Exception("Route could not be defined", 404);
		
	}

	protected function callAction($controller, $action)
	{
		$controller = new $controller;

		if( !method_exists($controller, $action) ) {

			throw new Exception("{$action} method does not exist");
			
		}		

		return ($controller->$action());
	}
}