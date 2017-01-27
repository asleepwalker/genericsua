<!DOCTYPE html>
<html>
	<head>
		<title><?= $product['name'] ?> | GenericsUA</title>
		<? include('meta.php'); ?>
		<link rel="stylesheet" href="/css/product.css">
		<link rel="stylesheet" href="/bower_components/flag-icon-css/css/flag-icon.css">
	</head>
	<body>
		<div class="wrapper">
			<? include('header.php'); ?>
			<main>
				<h1<? if (!isset($product['price'])) { ?> class="unavailable" title="Нет в аптеках" <? } ?>><?= $product['name'] ?><? if (isset($product['price'])) { ?> <span class="price <?= $product['color'] ?>"><?= floor($product['price']) ?> грн</span><? } ?></h1>
				<? if (isset($product['producer'])) { ?>
					<p class="producer"><? if ($product['country']) { ?><span class="flag-icon flag-icon-<?= $product['country'] ?>"></span> <? } ?><?= $product['producer'] ?></p>
				<? } ?>
				<section class="briefly">
					<div class="photo">
						<img src="/i/default.jpg" title="<?= $product['name'] ?>" alt="<?= $product['name'] ?>">
					</div>
					<div class="description">
						<? if ($product['description']) { ?>
							<p><?= $product['description'] ?></p>
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
									<li><span class="name"><?= $form['name'] ?></span> <span class="price"><?= floor($form['price']) ?> грн</span></li>
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
									<li><a href="/product/<?= $generic['url'] ?>/"><?= $generic['name'] ?></a> <span class="price <?= $generic['color'] ?>"><?= $generic['price'] ?> грн</span></li>
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
