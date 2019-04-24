<?
	// Функции PHP без обращения к БД

	// Возвращает SQL/XSS-безопасную входную строку, если она содержит хотя бы один непробельный символ
	// Иначе возвращает 0
	function validAnyString($str) {
		if (!isset($str))
			return 0;
		global $db;
		$spaces = [" ", "\r", "\n", "\t"];
		return strlen(str_replace($spaces, "", $str)) ? addslashes($db, htmlspecialchars($str)) : 0;
	}

	// Возвращает валидный email, если возможно такое преобразование
	// Иначе возвращает 0
	function validEmail($str) {
		if (!isset($str))
			return 0;
		$symbols = [" ", "\r", "\n", "\t"];
		$str = str_replace($symbols, "", $str);
		return preg_match("!^[A-Za-z0-9]+@[A-Za-z]+\.[A-Za-z]{2,3}$!", $str) ? $str : 0;
	}

	// Возвращает валидный номер телефона, если возможно такое преобразование
	// Иначе возвращает 0
	function validPhone($str) {
		if (!isset($str))
			return 0;
		$symbols = [" ", "\r", "\n", "\t", "+", "-"];
		$str = str_replace($symbols, "", $str);
		return preg_match("!^[0-9]{11,13}$!", $str) ? $str : 0;
	}

	// Херачим демонический пагинатор
	function makePaginator($show, $cur, $max) {
		echo '<ul class="paginator catalog-page__paginator">';
		$shift = ($show - 1) / 2;
		// Мы слишком слева
		if ($cur - $shift < 1) {
			if ($show > $max)
				$show = $max;
			for ($i = 1; $i <= $show; $i++) {
				if ($i === $cur)
					echo "<li class='paginator__elem paginator__elem_current'><span class='paginator__link'>$i</span></li>";
				else
					echo "<li class='paginator__elem'><a href='" . $_SERVER['SCRIPT_NAME'] . "?page=$i" . "' class='paginator__link'>$i</a></li>";
			}
		}	
		// Мы слишком справа
		elseif ($cur + $shift > $max) {
			$left = $max - $show + 1;
			if ($left < 1)
				$left = 1;
			for ($i = $left; $i <= $max; $i++) {
				if ($i === $cur)
					echo "<li class='paginator__elem paginator__elem_current'><span class='paginator__link'>$i</span></li>";
				else
					echo "<li class='paginator__elem'><a href='" . $_SERVER['SCRIPT_NAME'] . "?page=$i" . "' class='paginator__link'>$i</a></li>";
			}
		} 
		// Мы где-то в центре
		else {
			if ($show > $max)
				$show = $max;
			$left = $cur - $shift;
			$right = $left + $show;
			for ($i = $left; $i < $right; $i++) {
				if ($i === $cur)
					echo "<li class='paginator__elem paginator__elem_current'><span class='paginator__link'>$i</span></li>";
				else
					echo "<li class='paginator__elem'><a href='" . $_SERVER['SCRIPT_NAME'] . "?page=$i" . "' class='paginator__link'>$i</a></li>";
			}
		}
		if ($cur != $max)
			echo "<li class='paginator__elem paginator__elem_next'><a href='" . $_SERVER['SCRIPT_NAME'] . "?page=" . ($cur + 1) . "' class='paginator__link'>Следующая страница</a></li>";
		echo "</ul>";
	}
?>