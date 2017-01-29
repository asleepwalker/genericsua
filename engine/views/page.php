<!DOCTYPE html>
<html>
	<head>
		<title><?= $page['title'] ?> — GenericsUA</title>
		<? include('meta.php'); ?>
		<meta name="description" content="<?= addslashes($page['description']) ?>">
		<meta property="og:description" content="<?= addslashes($page['description']) ?>">
		<meta property="og:title" content="<?= addslashes($page['title']) ?> — GenericsUA">
		<meta property="og:url" content="http://generics.in.ua/page/<?= $page['url'] ?>/">
		<meta property="og:image" content="http://generics.in.ua/i/default.jpg' ?>">
		<link rel="stylesheet" href="/css/page.css">
		<? include('analytics.php'); ?>
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
