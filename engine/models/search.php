<?php

	include_once('product_generics.php');
	include_once('product_minprice.php');

	$query = "SELECT `id`, `name`, `description`, `url` FROM `products` WHERE `name` LIKE '%".addslashes($_GET['q'])."%' AND `published` = 1";
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