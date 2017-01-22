<?php

	include_once('product_minprice.php');

	function get_generics($product) {
		$query = "SELECT `products`.`id`, `products`.`name`, `products`.`url` FROM `products`, `items`, `generics` WHERE `generics`.`product` = ".$product." AND `items`.`id` = `generics`.`item` AND `items`.`product` = `products`.`id` AND `items`.`price` != 0 GROUP BY `products`.`id`";
		$data = database_query($query);
		$generics = array();
		while ($generic = mysql_fetch_assoc($data)) {
			$generics[] = $generic;
		}

		join_minprices($generics);
		usort($generics, 'sort_by_price');

		return $generics;
	}

	function sort_by_price($a, $b) {
		if ($a['price'] == $b['price']) return 0;
		return ($a['price'] < $b['price']) ? -1 : 1;
	}