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
			<? include('header.php'); ?>
			<main>
				<div class="status">Найдено: <?= count($products) ?> препарат</div>
				<section class="results">
					<? foreach ($products as &$product) { ?>
						<div class="item">
							<div class="photo">
								<img src="/uploads/nurofen.jpg" title="<?= $product['name'] ?>" alt="<?= $product['name'] ?>">
							</div>
							<div class="about">
								<h2<? if ($product['price'] == 0) { ?> class="unavailable" title="Нет в аптеках"<? } ?>><a href="/product/<?= $product['url'] ?>/"><?= $product['name'] ?></a><? if ($product['price'] != 0) { ?> <span class="price <?= $product['color'] ?>"><?= $product['price'] ?> грн</span><? } ?></h2>
								<? if (isset($product['producer'])) { ?>
									<p class="producer"><? if (isset($product['country'])) { ?><span class="flag-icon flag-icon-<?= $product['country'] ?>"></span> <? } ?><?= $product['producer'] ?></p>
								<? } ?>
								<div class="description">
									<p class="main"><?= $product['description'] ?></p>
									<p><a class="more" href="/product/<?= $product['url'] ?>/">Узнать больше...</a></p>
								</div>
								<button class="details">Показать аналоги (8)</button>
							</div>
							<div class="generics">
								<h3>Аналоги</h3>
								<ul>
									<? foreach ($product['generics'] as &$generic) { ?>
										<li><a href="/product/<?= $generic['url'] ?>/"><?= $generic['name'] ?></a> <span class="price <?= $generic['color'] ?>"><?= $generic['price'] ?> грн</span></li>
									<? } ?>
								</ul>
							</div>
						</div>
					<? } ?>
				</section>
			</main>
			<? include('footer.php'); ?>
		</div>
	</body>
</html>
