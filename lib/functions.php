<?
	// Функции PHP без обращения к БД

	// Возвращает SQL/XSS-безопасную входную строку, если она содержит хотя бы один непробельный символ
	// Иначе возвращает NULL
	function validAnyString($str) {
		if (!isset($str))
			return NULL;
		$spaces = [" ", "\r", "\n", "\t"];
		return strlen(str_replace($spaces, "", $str)) ? addslashes(htmlspecialchars($str)) : NULL;
	}

	// Возвращает натуральное число, если его возможно получить из строки
	// Иначе возвращает 1
	function validNaturalNumber($num) {
		$num = intval($num);
		if ($num < 1)
			$num = 1;
		return $num;
	}

	// Возвращает валидный email, если возможно такое преобразование
	// Иначе возвращает NULL
	function validEmail($str) {
		if (!isset($str))
			return NULL;
		$symbols = [" ", "\r", "\n", "\t"];
		$str = str_replace($symbols, "", $str);
		return preg_match("!^[A-Za-z0-9]+@[A-Za-z]+\.[A-Za-z]{2,3}$!", $str) ? $str : NULL;
	}

	// Возвращает валидный номер телефона, если возможно такое преобразование
	// Иначе возвращает NULL
	function validPhone($str) {
		if (!isset($str))
			return NULL;
		$symbols = [" ", "\r", "\n", "\t", "+", "-"];
		$str = str_replace($symbols, "", $str);
		return preg_match("!^[0-9]{11,13}$!", $str) ? $str : NULL;
	}

	// Отрисовщик логотипа с учётом текущей страницы
	function makeLogo($activePage) {
		$str = "";
		if ("Главная" !== $activePage) 
			$str .= "<a class='header-logo header-logo__link' href='index.php'>";
		else
			$str.= "<div class='header-logo'>";
		$str .= "<img class='header-logo__image' src='img/logo.png' alt='Логотип' width='95' height='75'>		
					<span class='header-logo__caption'>Company</span>";
		if ("Главная" !== $activePage)
			$str .= "</a>";
		else 
		 $str .= "</div>";
		return $str;
	}

	// Отрисовщик меню с учётом текущей страницы
	function makeMenu($activePage) {
		global $menu;
		$menuHtml = "
			<nav class='header-nav'>
				<div class='wrapper'>
					<span class='menu-toggler'>Меню</span>
					<ul class='menu-togglable'>";
		foreach ($menu as $item) {
			$menuItemName = $item["name"];
			$menuItemHref = $item["href"];
			$menuHtml .= "
			<li class='header-nav-item'>
				<span>";
			if(isset($item["sub-menu"])) {
				if($activePage === $menuItemName)
					$menuHtml .= "<span class='header-nav-item__container-for-link'><span class='header-nav-item__link header-nav-item__link_current'>$menuItemName</span></span>";
				else
					$menuHtml .= "<span class='header-nav-item__container-for-link'><a class='header-nav-item__link' href='$menuItemHref'>$menuItemName</a></span>";
				$menuHtml .= "<ul class='sub-menu'>";
				foreach($item["sub-menu"] as $subItem) {
					$menuSubItemName = $subItem["name"];
					$menuSubItemHref = $subItem["href"];
					$menuHtml .= "<li class='sub-menu__list-item'><a class='sub-menu__link' href='$menuSubItemHref'>$menuSubItemName</a></li>";
				}
				$menuHtml .= "</ul>";
			} else {
				if($activePage === $menuItemName)
					$menuHtml .= "<span class='header-nav-item__link header-nav-item__link_current'>$menuItemName</span>";
				else
					$menuHtml .= "<a class='header-nav-item__link' href='$menuItemHref'>$menuItemName</a>";
			}
			$menuHtml .= "
						</span>
					</li>";
		}
		$menuHtml .= "
				</ul>
			</div>
		</nav>";
		return $menuHtml;
	}

	// Отрисовщик пагинатора
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

	// Функция для замены текста в header'е после его создания
	function applyChanges($buffer) {
		global $title, $activePage;

		$replacement = ["%TITLE_REPLACEMENT%", "%LOGO_REPLACEMENT%", "%HEADER_MENU_REPLACEMENT%"];
		$replacers = [$title, makeLogo($activePage), makeMenu($activePage)];
 
		return str_replace($replacement, $replacers, $buffer);
	}
?>