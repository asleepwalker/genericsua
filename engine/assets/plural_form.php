<?php

	function get_plural_form($number, $form1, $form2, $form3) {
		if ($number % 10 == 1 && $number % 100 != 11) {
			return $form1;
		} else if ($number % 10 >= 2 && $number % 10 <= 4 && ($number % 100 < 10 || $number % 100 >= 20)) {
			return $form2;
		} else {
			return $form3;
		}
	}