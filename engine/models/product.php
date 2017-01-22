<?php

	$url = trim($request['path'], '/');
	$url = explode('/', $url);

	$query = "SELECT `product`.`id`, `product`.`name`, `product`.`description`, `product`.`url`, `producers`.`name` AS `producer`, `producers`.`country` FROM (SELECT `id`, `name`, `description`, `url`, `producer` FROM `products` WHERE `url` = '".addslashes($url[1])."' AND `published` = 1) AS `product` LEFT JOIN `producers` ON `product`.`producer` = `producers`.`id`";
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

	if (count($forms['available']) > 0) {
		$product['price'] = $forms['available'][0]['price'];
		$product['color'] = compare_price($product['price'], $generics);
	}