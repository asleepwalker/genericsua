<?php

	include_once($apppath.'assets/array_column_polyfill.php');

	function join_minprices(&$products) {
		$product_ids = array_column($products, 'id');
		$query = "SELECT * FROM (SELECT `product` AS `id`, `price` FROM `items` WHERE `product` IN (".implode($product_ids, ',').") AND `price` != 0 ORDER BY `price`) AS `ordered` GROUP BY `id`";
		$data = database_query($query);
		while ($product = mysql_fetch_assoc($data)) {
			$p_index = array_search($product['id'], $product_ids);
			if ($product['price'] != 0) {
				$products[$p_index]['price'] = floor($product['price']);
			}
		}
	}