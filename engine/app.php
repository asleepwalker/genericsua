<?php

	include('database.php');
	include('router.php');

	$apppath = __DIR__.'/';
	$request = parse_url($_SERVER['REQUEST_URI']);

	database_connect();
	$controller = get_controller($request);
	include('controllers/'.$controller.'.php');
	database_disconnect();
