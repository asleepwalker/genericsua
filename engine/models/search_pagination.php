<?php

	function get_pagination($per_page, $found) {
		$current = 1;
		$total = ceil($found / $per_page);

		if (isset($_GET['p'])) {
			if (filter_var($_GET['p'], FILTER_VALIDATE_INT) !== false && $_GET['p'] >= 1 && $_GET['p'] <= $total) {
				$current = $_GET['p'];
			} else {
				die('404');
			}
		}

		$buttons = array();
		if ($total > 1) {
			if ($total <= 7) {
				$start = 1;
				$finish = $total;
			} elseif ($current >= 4 && $current <= $total - 3) {
				$start = $current - 3;
				$finish = $current + 3;
			} elseif ($current < 4) {
				$start = 1;
				$finish = 7;
			} elseif ($current > $total - 3) {
				$start = $total - 7;
				$finish = $total;
			}

			for ($i = $start; $i <= $finish; $i++) {
				$buttons[] = $i;
			}
		}
		
		return array('current' => $current, 'total' => $total, 'buttons' => $buttons);
	}