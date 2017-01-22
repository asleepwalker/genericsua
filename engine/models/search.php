<?php

	include_once('product_generics.php');
	include_once('product_minprice.php');

	$query = "SELECT `product`.`id`, `product`.`name`, `product`.`description`, `product`.`url`, `producers`.`name` AS `producer`, `producers`.`country` FROM (SELECT `id`, `name`, `description`, `url`, `producer` FROM `products` WHERE `name` LIKE '%".addslashes($_GET['q'])."%' AND `published` = 1) AS `product` LEFT JOIN `producers` ON `product`.`producer` = `producers`.`id`";
	$data = database_query($query);
	$products = array();
	while ($product = mysql_fetch_assoc($data)) {
		$product['generics'] = get_generics($product['id']);
		$products[] = $product;
	}

	join_minprices($products);

	foreach ($products as &$product) {
		$product['color'] = compare_price($product['price'], $product['generics']);
	}