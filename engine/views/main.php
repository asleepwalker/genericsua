<!DOCTYPE html>
<html>
	<head>
		<title>GenericsUA — дешевые аналоги лекарств в Украине</title>
		<? include('meta.php'); ?>
		<link rel="stylesheet" href="/css/index.css">
	</head>
	<body>
		<div class="wrapper">
			<main>
				<div class="site-logo">
					<img src="/i/logo.png" title="GenericsUA — дешевые аналоги лекарств в Украине" alt="GenericsUA">
					<span class="about">дешевые аналоги лекарств</span>
				</div>
				<form class="search" action="/search/" method="get" novalidate>
					<input name="q" type="search" autocomplete="off" autofocus required>
					<p class="example">Например, <span class="pseudo" data-product="<?= $example['url'] ?>"><?= $example['name'] ?></span></p>
					<button class="submit" type="submit">Найти препарат</button>
				</form>
			</main>
			<? include('footer.php'); ?>
		</div>
		<link rel="stylesheet" href="/bower_components/awesomplete/awesomplete.css">
		<script src="/bower_components/awesomplete/awesomplete.min.js"></script>
		<script src="/js/suggest.js"></script>
		<script src="/js/main.js"></script>
	</body>
</html>
