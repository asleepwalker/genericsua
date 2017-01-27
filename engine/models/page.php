<?php

	$url = trim($request['path'], '/');
	$url = explode('/', $url);

	$query = "SELECT * FROM `pages` WHERE `url` = '".addslashes($url[1])."' AND `published` = 1";
	$data = database_query($query);
	$page = mysql_fetch_assoc($data);

	if (!$page) {
		show_error();
	}
