<?php

	include_once('search_pagination.php');
	include_once('product_generics.php');
	include_once('product_minprice.php');

	if (trim($_GET['q']) !== $_GET['q']) {
		header('Location: /search/?q='.trim($_GET['q']));
		exit();
	}

	$query = "SELECT COUNT(`id`) FROM `products` WHERE `name` LIKE '%".addslashes($_GET['q'])."%' AND `published` = 1";
	$data = database_query($query);
	$found = mysql_fetch_array($data)[0];

	$per_page = 10;
	$pagination = get_pagination($per_page, $found);

	$query = "SELECT `product`.`id`, `product`.`name`, `product`.`description`, `product`.`photo`, `product`.`url`, `producers`.`name` AS `producer`, `producers`.`country` FROM (SELECT `id`, `name`, `description`, `photo`, `url`, `producer` FROM `products` WHERE `name` LIKE '%".addslashes($_GET['q'])."%' AND `published` = 1 LIMIT ".($pagination['current'] - 1).",".$per_page.") AS `product` LEFT JOIN `producers` ON `product`.`producer` = `producers`.`id`";
	$data = database_query($query);
	$products = array();
	while ($product = mysql_fetch_assoc($data)) {
		$products[] = $product;
	}

	join_minprices($products);

	foreach ($products as &$product) {
		$product['generics'] = get_generics($product);
		$product['color'] = compare_price($product['price'], $product['generics'], $product['price']);
	}