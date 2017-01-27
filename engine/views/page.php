<!DOCTYPE html>
<html>
	<head>
		<title><?= $page['title'] ?> — GenericsUA</title>
		<? include('meta.php'); ?>
		<!--<link rel="stylesheet" href="/css/page.css">-->
	</head>
	<body>
		<div class="wrapper">
			<? include('header.php'); ?>
			<main>
				<h1><?= $page['title'] ?></h1>
				<article>
					<?= $page['content'] ?>
				</article>
			</main>
			<? include('footer.php'); ?>
		</div>
		<link rel="stylesheet" href="/bower_components/awesomplete/awesomplete.css">
		<script src="/bower_components/awesomplete/awesomplete.min.js"></script>
		<script src="/js/suggest.js"></script>
	</body>
</html>
