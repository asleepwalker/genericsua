<?php

	$query = "SELECT `id`, `name`, `description`, `url` FROM `products` WHERE `name` LIKE '%".addslashes($_GET['q'])."%'";
	$data = database_query($query);
	$products = array();
	while ($product = mysql_fetch_assoc($data)) {
		$products[] = $product;
	}

	foreach ($products as &$product) {
		$query = "SELECT `products`.`id`, `products`.`name`, `products`.`url` FROM `products`, `items`, `generics` WHERE `generics`.`product` = ".$product['id']." AND `items`.`id` = `generics`.`item` AND `items`.`product` = `products`.`id` GROUP BY `products`.`id`";
		$data = database_query($query);
		$generics = array();
		while ($generic = mysql_fetch_assoc($data)) {
			$generics[] = $generic;
		}
		$product['generics'] = $generics;
	}

	$all_products = array();
	foreach ($products as &$product) {
		$all_products[] = $product['id'];
		foreach ($product['generics'] as &$generic) {
			$all_products[] = $generic['id'];
		}
	}
	$query = "SELECT * FROM (SELECT `product` AS `id`, `price` FROM `items` WHERE `product` IN (".implode($all_products, ',').") ORDER BY `price`) AS `ordered` GROUP BY `id`";
	$data = database_query($query);
	$all_prices = array();
	while ($product1 = mysql_fetch_assoc($data)) {
		$all_prices[$product1['id']] = floor($product1['price']);
	}

	function sort_by_price($a, $b) {
		if ($a['price'] == $b['price']) return 0;
		return ($a['price'] < $b['price']) ? -1 : 1;
	}
	foreach ($products as &$product) {
		$product['price'] = $all_prices[$product['id']];
		foreach ($product['generics'] as &$generic) {
			$generic['price'] = $all_prices[$generic['id']];
		}
		usort($product['generics'], 'sort_by_price');
	}
