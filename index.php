<?php

	$request = parse_url($_SERVER['REQUEST_URI']);

	if     ($request['path'] == '/search/')   $page = 'search';
	elseif (strpos($request['path'], '/product/') === 0) $page = 'product';
	else                                      $page = 'main';

	include('pages/'.$page.'.php');