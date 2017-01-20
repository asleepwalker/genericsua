<?php

	function getController($request) {
		if     ($request['path'] == '/')                     return 'main';
		elseif ($request['path'] == '/search/')              return 'search';
		elseif (strpos($request['path'], '/product/') === 0) return 'product';
		else                                                 return 'error';
	}
