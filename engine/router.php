<?php

	function get_controller($request) {
		if     ($request['path'] == '/')                     return 'main';
		elseif ($request['path'] == '/search/')              return 'search';
		elseif (strpos($request['path'], '/product/') === 0) return 'product';
		elseif (strpos($request['path'], '/page/') === 0)    return 'page';
		elseif ($request['path'] == '/suggest/')             return 'suggest';
		else                                                 show_error();
	}

	function show_error() {
		include('views/error.php');
		database_disconnect();
		exit();
	}
