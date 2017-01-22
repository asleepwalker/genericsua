<?php

	$url = trim($request['path'], '/');
	$url = explode('/', $url);

	$query = "SELECT `id`, `name`, `description`, `url` FROM `products` WHERE `url` = '".addslashes($url[1])."' AND `published` = 1";
	$data = database_query($query);
	$product = mysql_fetch_assoc($data);

	$query = "SELECT `name`, `price` FROM `items` WHERE `product` = ".$product['id']." OR `group` = ".$product['id']." ORDER BY `price`";
	$data = database_query($query);
	$forms = array('available' => array(), 'absent' => array());
	while ($form = mysql_fetch_assoc($data)) {
		$forms[$form['price'] != 0 ? 'available' : 'absent'][] = $form;
	}

	include_once('product_generics.php');
	$generics = get_generics($product['id']);
