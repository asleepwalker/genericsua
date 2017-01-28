<!DOCTYPE html>
<html>
	<head>
		<title>Поиск «<?= htmlspecialchars($_GET['q']) ?>» — GenericsUA</title>
		<? include('meta.php'); ?>
		<meta name="description" content="Поиск по запросу «<?= addslashes($_GET['q']) ?>» — препараты, цены в аптеках и дешёвые аналоги.">
		<meta property="og:description" content="Поиск по запросу «<?= addslashes($_GET['q']) ?>» — препараты, цены в аптеках и дешёвые аналоги.">
		<meta property="og:title" content="Поиск «<?= htmlspecialchars($_GET['q']) ?>» — GenericsUA">
		<meta property="og:url" content="http://generics.in.ua/search/?q=<?= addslashes($_GET['q']) ?>">
		<meta property="og:image" content="http://generics.in.ua/i/default.jpg">
		<link rel="stylesheet" href="/css/search.css">
		<link rel="stylesheet" href="/bower_components/flag-icon-css/css/flag-icon.css">
	</head>
	<body>
		<div class="wrapper">
			<? include('header.php'); ?>
			<main>
				<? if (count($products)) { ?>
					<? include($apppath.'assets/plural_form.php') ?>
					<div class="status">Найдено: <?= $found ?> <?= get_plural_form($found, 'препарат', 'препарата', 'препаратов') ?></div>
					<section class="results">
						<? foreach ($products as &$product) { ?>
							<div class="item" itemscope itemtype="http://schema.org/Product">
								<div class="photo">
									<img src="<?= $product['photo'] != '' ? '/uploads/'.$product['photo'] : '/i/default.jpg' ?>" title="<?= $product['name'] ?>" alt="<?= $product['name'] ?>"<? if ($product['photo'] != '') { ?> itemprop="image"<? } ?>>
								</div>
								<div class="about">
									<h2<? if ($product['price'] == 0) { ?> class="unavailable" title="Нет в аптеках"<? } ?>><a href="/product/<?= $product['url'] ?>/" itemprop="url"><span itemprop="name"><?= $product['name'] ?></span></a><? if ($product['price'] != 0) { ?> <span class="price <?= $product['color'] ?>"><?= $product['price'] ?> грн</span><? } ?></h2>
									<? if (isset($product['producer'])) { ?>
										<p class="producer"><? if ($product['country']) { ?><span class="flag-icon flag-icon-<?= $product['country'] ?>"></span> <? } ?><span itemprop="brand"><?= $product['producer'] ?></span></p>
									<? } ?>
									<div class="description">
										<p class="main" itemprop="description"><?= $product['description'] ?></p>
										<p><a class="more" href="/product/<?= $product['url'] ?>/">Узнать больше...</a></p>
									</div>
									<? if (count($product['generics'])) { ?>
										<button class="details">Показать аналоги (<?= count($product['generics']) ?>)</button>
									<? } else { ?>
										<p class="no-generics">Аналоги не найдены</p>
									<? } ?>
								</div>
								<div class="generics">
									<h3>Аналоги</h3>
									<? if (count($product['generics'])) { ?>
										<ul>
											<? foreach ($product['generics'] as &$generic) { ?>
												<li itemprop="isRelatedTo" itemscope itemtype="http://schema.org/Product"><a href="/product/<?= $generic['url'] ?>/" itemprop="url"><span itemprop="name"><?= $generic['name'] ?></span></a> <span class="price <?= $generic['color'] ?>"><?= $generic['price'] ?> грн</span></li>
											<? } ?>
										</ul>
										<? if (count($product['generics']) > 6) { ?>
											<p class="folded">...и ещё <?= (count($product['generics']) - 6) ?> <?= get_plural_form(count($product['generics']) - 6, 'другой', 'других', 'других') ?></p>
										<? } ?>
									<? } else { ?>
										<p class="empty">Не найдены</p>
									<? } ?>
								</div>
							</div>
						<? } ?>
						<? include('pagination.php'); ?>
					</section>
				<? } else { ?>
					<section class="results not-found">
						<p class="main">По запросу «<b><?= htmlspecialchars($_GET['q']) ?></b>» не найдено ни одного препарата.</p>
						<p>Возможно, этот препарат давно не продаётся в аптеках, не поставляется в Украину или вы ошиблись при вводе.</p>
						<p>Если же это не так, <a href="/page/feedback/">свяжитесь со мной</a> и я добавлю его в базу данных.</p>
					</section>
				<? } ?>
			</main>
			<? include('footer.php'); ?>
		</div>
		<link rel="stylesheet" href="/bower_components/awesomplete/awesomplete.css">
		<script src="/bower_components/awesomplete/awesomplete.min.js"></script>
		<script src="/js/suggest.js"></script>
		<script src="/js/search.js"></script>
	</body>
</html>
