<?php

require './vendor/autoload.php';

App::bind('config', require './config.php');

App::bind('database', new QueryBuilder(Connection::make(App::get('config')['database'])));


function view($name, $data)
{
	// extract($data);

	require "./views/{$name}.view.php";
}

function getReleaseDate($date)
{
	$date = new DateTime($date);
	return date_format($date, 'jS F Y');
}
