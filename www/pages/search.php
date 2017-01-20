<?php

	include('database.php');
	database_connect();

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

	database_disconnect();

?><!DOCTYPE html>
<html>
	<head>
		<title>Поиск «<?= htmlspecialchars($_GET['q']) ?>» | GenericsUA</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="/css/global.css">
		<link rel="stylesheet" href="/css/search.css">
		<link rel="stylesheet" href="/bower_components/flag-icon-css/css/flag-icon.css">
	</head>
	<body>
		<div class="wrapper">
			<?php include('header.php'); ?>
			<main>
				<div class="status">Найдено: <?= count($products) ?> препарат</div>
				<section class="results">
					<?php foreach ($products as &$product) { ?>
						<div class="item">
							<div class="photo">
								<img src="/uploads/nurofen.jpg" title="<?= $product['name'] ?>" alt="<?= $product['name'] ?>">
							</div>
							<div class="about">
								<h2><a href="/product/<?= $product['url'] ?>/"><?= $product['name'] ?></a> <span class="price acceptable"><?= $product['price'] ?> грн</span></h2>
								<!--<p class="producer"><span class="flag-icon flag-icon-gb"></span> Reckitt Benckiser</p>-->
								<div class="description">
									<p class="main"><?= $product['description'] ?></p>
									<p><a class="more" href="/product/<?= $product['url'] ?>/">Узнать больше...</a></p>
								</div>
								<button class="details">Показать аналоги (8)</button>
							</div>
							<div class="generics">
								<h3>Аналоги</h3>
								<ul>
									<?php foreach ($product['generics'] as &$generic) { ?>
										<li><a href="/product/<?= $generic['url'] ?>/"><?= $generic['name'] ?></a> <span class="price cheap"><?= $generic['price'] ?> грн</span></li>
									<?php } ?>
								</ul>
							</div>
						</div>
					<?php } ?>
				</section>
			</main>
			<?php include('footer.php'); ?>
		</div>
	</body>
</html>
