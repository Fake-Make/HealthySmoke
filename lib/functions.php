<?
	/************************Функции связанные с БД*****************************/
	
	// Выборка size последних новостей для page-той страницы
	function getNewsByPages($size, $page = NULL) {
		$offset = ($page - 1) * $size;
		$sqlReq = "SELECT id, anounce, dt FROM news ORDER BY dt DESC LIMIT " .
			(is_null($page) ? "$size" : "$offset, $size");
		global $db;

		$sqlRes = mysqli_query($db, $sqlReq);
		return mysqli_fetch_all($sqlRes, MYSQLI_ASSOC);
	}

	/************************Функции связанные с БД*****************************/

	/***********************Функции не связанные с БД***************************/

	// Возвращает SQL/XSS-безопасную входную строку, если она содержит хотя бы один непробельный символ
	// Иначе возвращает NULL
	function validAnyString($str) {
		if(!isset($str))
			return NULL;
		$spaces = [" ", "\r", "\n", "\t"];
		return strlen(str_replace($spaces, "", $str)) ? addslashes(htmlspecialchars($str)) : NULL;
	}

	// Возвращает натуральное число, если его возможно получить из строки
	// Иначе возвращает 1
	function validNaturalNumber($num) {
		return ($num = intval($num)) < 1 ? 1 : $num;
	}

	// Возвращает неотрицательное вещественное число в виде строки, если его возможно получить
	// Иначе возвращает 0
	function validPositiveFloat($num) {
		return round(($num = floatval($num)) < 0 ? 0 : $num, 2);
	}

	// Возвращает валидный email, если возможно такое преобразование
	// Иначе возвращает NULL
	function validEmail($str) {
		if(!isset($str))
			return NULL;
		$symbols = [" ", "\r", "\n", "\t"];
		$str = str_replace($symbols, "", $str);
		return preg_match("!^[A-Za-z0-9]+(\.[A-Za-z0-9]+)*@[A-Za-z0-9]+(\.[A-Za-z0-9]+)*$!", $str) ? $str : NULL;
	}
	// Возвращает валидный номер телефона, если возможно такое преобразование
	// Иначе возвращает NULL
	function validPhone($str) {
		if(!isset($str))
			return NULL;
		$symbols = [" ", "\r", "\n", "\t", "+", "-", "(", ")"];
		$str = str_replace($symbols, "", $str);
		return preg_match("!^[0-9]{11,13}$!", $str) ? $str : NULL;
	}

	// Отрисовщик пагинатора
	function makePaginator($show, $cur, $max) {
		echo '<ul class="paginator catalog-page__paginator">';
		$thisScript = $_SERVER["REQUEST_URI"];
		$thisScript .= (false === strpos($thisScript, '?')) ? '?' : '&';
		echo
			'<li class="paginator__elem paginator__elem_prev">'
				. ($cur != 1 ? '<a href="' . $thisScript . 'page=' . ($cur - 1) .
				'" class="paginator__link">Предыдущая страница</a>' : '') .
			'</li>';
		// Количество отображаемых элементов в пагинаторе
		$shift = ($show - 1) / 2;
		// Мы слишком слева
		if($cur - $shift < 1) {
			if($show > $max)
				$show = $max;
			for ($i = 1; $i <= $show; $i++) {
				if($i === $cur)
					echo '<li class="paginator__elem paginator__elem_current"><span class="paginator__link">' . $i . '</span></li>';
				else
					echo '<li class="paginator__elem"><a href="' . $thisScript . 'page=' . $i . '" class="paginator__link">' . $i . '</a></li>';
			}
		}	
		// Мы слишком справа
		elseif($cur + $shift > $max) {
			$left = $max - $show + 1;
			if($left < 1)
				$left = 1;
			for ($i = $left; $i <= $max; $i++) {
				if($i === $cur)
					echo '<li class="paginator__elem paginator__elem_current"><span class="paginator__link">' . $i . '</span></li>';
				else
					echo '<li class="paginator__elem"><a href="' . $thisScript . 'page=' . $i . '" class="paginator__link">' . $i . '</a></li>';
			}
		} 
		// Мы где-то в центре
		else {
			if($show > $max)
				$show = $max;
			$left = $cur - $shift;
			$right = $left + $show;
			for ($i = $left; $i < $right; $i++) {
				if($i === $cur)
					echo '<li class="paginator__elem paginator__elem_current"><span class="paginator__link">' . $i . '</span></li>';
				else
					echo '<li class="paginator__elem"><a href="' . $thisScript . 'page=' . $i . '" class="paginator__link">' . $i . '</a></li>';
			}
		}
		echo '<li class="paginator__elem paginator__elem_next">' . ($cur != $max ? '<a href="' . $thisScript . 'page=' . ($cur + 1) . '" class="paginator__link">Следующая страница</a>' : '') . '</li></ul>';
	}

	// Функция для замены текста в header'е после его создания
	function changeTitle($buffer) {
		global $title;
		return str_replace("%TITLE_REPLACEMENT%", $title, $buffer);
	}

	/***********************Функции не связанные с БД***************************/
?>