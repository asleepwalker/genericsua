<?php

	include('database.php');
	include('router.php');

	$request = parse_url($_SERVER['REQUEST_URI']);
	$controller = getController($request);

	database_connect();
	$apppath = __DIR__.'/';
	include('controllers/'.$controller.'.php');
	database_disconnect();