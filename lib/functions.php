<?
	// Возвращает SQL/XSS-безопасную входную строку, если она содержит хотя бы один непробельный символ
	// Иначе возвращает NULL
	function validAnyString($str, $db = NULL) {
		return strlen(trim($str)) ?
			// Если передали указатель на соединение с БД
			// То валидируем строку и по отношению к БД
			($db ?
				mysqli_real_escape_string($db, htmlspecialchars($str)) :
				addslashes(htmlspecialchars($str))) :
			NULL;
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
	function validEmail($str, $db = NULL) {
		$str = trim($str);
		return preg_match("!^[A-Za-z0-9\-]+(\.[A-Za-z0-9\-]+)*@[A-Za-z0-9\-]+(\.[A-Za-z0-9\-]+)*$!", $str) ? $str : NULL;
	}

	// Возвращает валидный номер телефона, если возможно такое преобразование
	// Иначе возвращает NULL
	function validPhone($str) {
		$symbols = ["+", "-", "(", ")"];
		$str = str_replace($symbols, "", trim($str));
		return preg_match("!^[0-9]{11,13}$!", $str) ? $str : NULL;
	}

	// Отрисовщик пагинатора
	function makePaginator($show, $cur, $max) {
		// Текущая ссылка без GET-параметра page
		$thisScript = preg_replace('!(&page=\d)*|(\?page=\d&?)*!', '' , $_SERVER["REQUEST_URI"]);
		$thisScript .= (false === strpos($thisScript, '?')) ? '?' : '&';
		// Количество отображаемых элементов в пагинаторе
		$shift = ($show - 1) / 2;
		$paginatorHtml = "";

		$paginatorHtml .=
			'<ul class="paginator catalog-page__paginator">' .
				'<li class="paginator__elem paginator__elem_prev">'
					. ($cur != 1 ? '<a href="' . $thisScript . 'page=' . ($cur - 1) .
					'" class="paginator__link">Предыдущая страница</a>' : '') .
				'</li>';
		
		// Мы слишком слева
		if ($cur - $shift < 1) {
			if ($show > $max)
				$show = $max;
			for ($i = 1; $i <= $show; $i++) {
				if ($i === $cur)
					$paginatorHtml .= '<li class="paginator__elem paginator__elem_current"><span class="paginator__link">' . $i . '</span></li>';
				else
					$paginatorHtml .= '<li class="paginator__elem"><a href="' . $thisScript . 'page=' . $i . '" class="paginator__link">' . $i . '</a></li>';
			}
		}	
		// Мы слишком справа
		elseif ($cur + $shift > $max) {
			$left = $max - $show + 1;
			if ($left < 1)
				$left = 1;
			for ($i = $left; $i <= $max; $i++) {
				if ($i === $cur)
					$paginatorHtml .= '<li class="paginator__elem paginator__elem_current"><span class="paginator__link">' . $i . '</span></li>';
				else
					$paginatorHtml .= '<li class="paginator__elem"><a href="' . $thisScript . 'page=' . $i . '" class="paginator__link">' . $i . '</a></li>';
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
					$paginatorHtml .= '<li class="paginator__elem paginator__elem_current"><span class="paginator__link">' . $i . '</span></li>';
				else
					$paginatorHtml .= '<li class="paginator__elem"><a href="' . $thisScript . 'page=' . $i . '" class="paginator__link">' . $i . '</a></li>';
			}
		}
		$paginatorHtml .=
				'<li class="paginator__elem paginator__elem_next">' .
					($cur != $max ? '<a href="' . $thisScript . 'page=' . ($cur + 1) . '" class="paginator__link">Следующая страница</a>' : '') .
				'</li>
			</ul>';
		return $paginatorHtml;
	}

	// Функция для замены текста в header'е после его создания
	function changeTitle($buffer) {
		global $title;
		return str_replace("%TITLE_REPLACEMENT%", $title, $buffer);
	}
?>