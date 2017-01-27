<?php

	$suggestions = array();

	if (isset($_GET['q']) && $_GET['q'] !== '') {
		$query = "SELECT `name` as label, `url` as value FROM `products` WHERE `name` LIKE '".addslashes($_GET['q'])."%' AND `published` = 1 ORDER BY `name` LIMIT 0,6";
		$data = database_query($query);
		while ($product = mysql_fetch_assoc($data)) {
			$suggestions[] = $product;
		}
	}