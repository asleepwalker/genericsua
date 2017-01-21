<?php

	function join_minprices(&$products) {
		$all_products = array();
		foreach ($products as &$product) {
			$all_products[] = $product['id'];
		}
		$query = "SELECT * FROM (SELECT `product` AS `id`, `price` FROM `items` WHERE `product` IN (".implode($all_products, ',').") AND `price` != 0 ORDER BY `price`) AS `ordered` GROUP BY `id`";
		$data = database_query($query);
		$all_prices = array();
		while ($product1 = mysql_fetch_assoc($data)) {
			$all_prices[$product1['id']] = floor($product1['price']);
		}

		foreach ($products as &$product) {
			$product['price'] = $all_prices[$product['id']];
		}
	}