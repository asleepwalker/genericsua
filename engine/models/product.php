<?php

	$url = trim($request['path'], '/');
	$url = explode('/', $url);

	$query = "SELECT `id`, `name`, `description`, `url` FROM `products` WHERE `url` LIKE '%".addslashes($url[1])."%'";
	$data = database_query($query);
	$product = mysql_fetch_assoc($data);

	$query = "SELECT `name`, `price` FROM `items` WHERE `product` = ".$product['id']." ORDER BY `price`";
	$data = database_query($query);
	$forms = array();
	while ($form = mysql_fetch_assoc($data)) {
		$forms[] = $form;
	}

	$query = "SELECT `products`.`id`, `products`.`name`, `products`.`url` FROM `products`, `items`, `generics` WHERE `generics`.`product` = ".$product['id']." AND `items`.`id` = `generics`.`item` AND `items`.`product` = `products`.`id` GROUP BY `products`.`id`";
	$data = database_query($query);
	$generics = array();
	while ($generic = mysql_fetch_assoc($data)) {
		$generics[] = $generic;
	}

	$all_generics = array();
	foreach ($generics as &$generic) {
		$all_generics[] = $generic['id'];
	}
	$query = "SELECT * FROM (SELECT `product` AS `id`, `price` FROM `items` WHERE `product` IN (".implode($all_generics, ',').") ORDER BY `price`) AS `ordered` GROUP BY `id`";
	$data = database_query($query);
	$all_prices = array();
	while ($product1 = mysql_fetch_assoc($data)) {
		$all_prices[$product1['id']] = floor($product1['price']);
	}

	foreach ($generics as &$generic) {
		$generic['price'] = $all_prices[$generic['id']];
	}

	function sort_by_price($a, $b) {
		if ($a['price'] == $b['price']) return 0;
		return ($a['price'] < $b['price']) ? -1 : 1;
	}
	usort($generics, 'sort_by_price');
