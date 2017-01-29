<!DOCTYPE html>
<html>
	<head>
		<title><?= $product['name'] ?> — GenericsUA</title>
		<? include('meta.php'); ?>
		<? if ($product['description']) { ?>
			<meta name="description" content="<?= addslashes($product['description']) ?>">
			<meta property="og:description" content="<?= addslashes($product['description']) ?>">
		<? } ?>
		<meta property="og:title" content="<?= $product['name'] ?> — цены в аптеках и дешёвые аналоги">
		<meta property="og:url" content="http://generics.in.ua/product/<?= $product['url'] ?>/">
		<meta property="og:image" content="http://generics.in.ua/<?= $product['photo'] != '' ? '/uploads/'.$product['photo'] : '/i/default.jpg' ?>">
		<link rel="stylesheet" href="/css/product.css">
		<link rel="stylesheet" href="/bower_components/flag-icon-css/css/flag-icon.css">
		<? include('analytics.php'); ?>
	</head>
	<body>
		<div class="wrapper">
			<? include('header.php'); ?>
			<main itemscope itemtype="http://schema.org/Product">
				<h1<? if (!isset($product['price'])) { ?> class="unavailable" title="Нет в аптеках" <? } ?>><span itemprop="name"><?= $product['name'] ?></span><? if (isset($product['price'])) { ?> <span class="price <?= $product['color'] ?>"><?= floor($product['price']) ?> грн</span><? } ?></h1>
				<? if (isset($product['producer'])) { ?>
					<p class="producer"><? if ($product['country']) { ?><span class="flag-icon flag-icon-<?= $product['country'] ?>"></span> <? } ?><span itemprop="brand"><?= $product['producer'] ?></span></p>
				<? } ?>
				<section class="briefly">
					<div class="photo">
						<img src="<?= $product['photo'] != '' ? '/uploads/'.$product['photo'] : '/i/default.jpg' ?>" title="<?= $product['name'] ?>" alt="<?= $product['name'] ?>"<? if ($product['photo'] != '') { ?> itemprop="image"<? } ?>>
					</div>
					<div class="description">
						<? if ($product['description']) { ?>
							<p itemprop="description"><?= $product['description'] ?></p>
						<? } ?>
						<p class="disclaimer">Обратите внимание, что у разных форм препарата состав может отличаться. Чтобы убедиться в эффективности замены, сравнивайте состав конкретных форм.</p>
					</div>
				</section>
				<div class="items-cols">
					<section class="options">
						<h2>Выпускается в формах</h2>
						<? if (count($forms['available']) + count($forms['absent'])) { ?>
							<ul>
								<? foreach ($forms['available'] as &$form) { ?>
									<li itemprop="offers" itemscope itemtype="http://schema.org/Offer"><span class="name" itemprop="name"><?= $form['name'] ?></span> <span class="price"><span itemprop="price"><?= floor($form['price']) ?></span> <span itemprop="priceCurrency" content="uah">грн</span></span></li>
								<? } foreach ($forms['absent'] as &$form) { ?>
									<li class="unavailable"><span class="name" title="Нет в аптеках"><?= $form['name'] ?></span></li>
								<? } ?>
							</ul>
						<? } else { ?>
							<p class="empty">Не найдены</p>
						<? } ?>
					</section>
					<section class="generics">
						<h2>Аналоги препарата</h2>
						<? if (count($generics)) { ?>
							<ul>
								<? foreach ($generics as &$generic) { ?>
									<li itemprop="isRelatedTo" itemscope itemtype="http://schema.org/Product"><a href="/product/<?= $generic['url'] ?>/" itemprop="url"><span itemprop="name"><?= $generic['name'] ?></a> <span class="price <?= $generic['color'] ?>"><?= $generic['price'] ?> грн</span></li>
								<? } ?>
							</ul>
						<? } else { ?>
							<p class="empty">Не найдены</p>
						<? } ?>
					</section>
				</div>
			</main>
			<? include('footer.php'); ?>
		</div>
		<link rel="stylesheet" href="/bower_components/awesomplete/awesomplete.css">
		<script src="/bower_components/awesomplete/awesomplete.min.js"></script>
		<script src="/js/suggest.js"></script>
	</body>
</html>
