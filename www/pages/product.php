<?php

	include('database.php');
	database_connect();

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

	database_disconnect();

?><!DOCTYPE html>
<html>
	<head>
		<title><?= $product['name'] ?> | GenericsUA</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="/css/global.css">
		<link rel="stylesheet" href="/css/product.css">
		<link rel="stylesheet" href="/bower_components/flag-icon-css/css/flag-icon.css">
	</head>
	<body>
		<div class="wrapper">
			<?php include('header.php'); ?>
			<main>
				<h1><?= $product['name'] ?></h1>
				<!--<p class="producer"><span class="flag-icon flag-icon-gb"></span> Reckitt Benckiser</p>-->
				<section class="briefly">
					<div class="photo">
						<img src="/uploads/nurofen.jpg" title="<?= $product['name'] ?>" alt="<?= $product['name'] ?>">
					</div>
					<div class="description">
						<p><?= $product['description'] ?></p>
					</div>
				</section>
				<div class="items-cols">
					<section class="options">
						<h2>Выпускается в формах</h2>
						<ul>
							<? foreach ($forms as &$form) { ?>
								<li><span class="name"><?= $form['name'] ?></span> <span class="price cheap"><?= floor($form['price']) ?> грн</span></li>
							<? } ?>
						</ul>
					</section>
					<section class="generics">
						<h2>Аналоги препарата</h2>
						<ul>
							<? foreach ($generics as &$generic) { ?>
								<li><a href="/product/<?= $generic['url'] ?>/"><?= $generic['name'] ?></a> <span class="price cheap"><?= $generic['price'] ?> грн</span></li>
							<? } ?>
						</ul>
					</section>
				</div>
			</main>
			<?php include('footer.php'); ?>
		</div>
	</body>
</html>
