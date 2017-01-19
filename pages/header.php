<header>
	<div class="site-logo">
		<a href="/">
			<img class="short" src="/i/logo-short.png" title="GenericsUA — дешевые аналоги лекарств в Украине" alt="GenericsUA">
			<img class="full" src="/i/logo.png" title="GenericsUA — дешевые аналоги лекарств в Украине" alt="GenericsUA">
		</a>
	</div>
	<form class="search" action="/search/" method="get">
		<input name="q" type="search" autocomplete="off" required <?php if (isset($_GET['q'])) echo 'value="'.htmlentities($_GET['q']).'"' ?>>
		<button class="submit" type="submit"><span class="label">Найти препарат</span></button>
	</form>
</header>