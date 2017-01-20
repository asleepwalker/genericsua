<?php

	$query = "SELECT `name`, `url` FROM `products` WHERE `name` LIKE '".addslashes($_GET['q'])."%' ORDER BY `name` LIMIT 0,6";
	$data = database_query($query);
	$suggestions = array();
	while ($product = mysql_fetch_assoc($data)) {
		$suggestions[] = $product;
	}