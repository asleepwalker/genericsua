<!DOCTYPE html>
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
