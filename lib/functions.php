<?
	/************************Функции связанные с БД*****************************/

	// Выборка названий всех категорий для сайдбара
	function getCat4Sidebar() {
		$sqlReq = "SELECT id, name, img from categories";
		global $db;

		$sqlRes = mysqli_query($db, $sqlReq);
		return mysqli_fetch_all($sqlRes, MYSQLI_ASSOC);
	}
	
	// Выборка size последних новостей для page-той страницы
	function getNewsByPages($size, $page = NULL) {
		$offset = ($page - 1) * $size;
		$sqlReq = is_null($page) ?
			"SELECT id, anounce, dt FROM news ORDER BY dt DESC LIMIT $size" :
			"SELECT id, anounce, dt FROM news ORDER BY dt DESC LIMIT $offset, $size";
		global $db;

		$sqlRes = mysqli_query($db, $sqlReq);
		return mysqli_fetch_all($sqlRes, MYSQLI_ASSOC);
	}

	// Получение заголовка и содержимого для новости id
	function getOneNews($id) {
		$sqlReq = "SELECT header, content, dt FROM news WHERE id=$id";
		global $db;

		$sqlRes = mysqli_query($db, $sqlReq);
		return mysqli_fetch_assoc($sqlRes);
	}

	// Выборка size товаров для page-той страницы
	function getGoods4Catalog($page, $size, $category = NULL) {
		$offset = ($page - 1) * $size;

		$sqlReq = is_null($category) ?
			"SELECT id, name, price, img FROM goods LIMIT $offset, $size" :
			"SELECT id, name, price, img FROM goods WHERE id IN 
				(SELECT goodID FROM goodToCategories WHERE
					categoryID = $category) LIMIT $offset, $size";
		global $db;

		$sqlRes = mysqli_query($db, $sqlReq);
		return mysqli_fetch_all($sqlRes, MYSQLI_ASSOC);
	}

	// Получение максималного количества страниц товаров для разных запросов
	function getMaxPage4Catalog($size, $category = NULL) {
		$sqlReq = is_null($category) ?
			"SELECT count(*) FROM goods" :
			"SELECT count(*) FROM goods WHERE id IN 
				(SELECT goodID FROM goodToCategories WHERE
					categoryID = $category)";
		global $db;

		$sqlRes = mysqli_query($db, $sqlReq);
		return ceil(mysqli_fetch_row($sqlRes)["0"] / $size);
	}

	// Получение максималного количества страниц товаров для разных запросов
	function getMaxPage4News($size) {
		$sqlReq = "SELECT count(*) FROM news";
		global $db;

		$sqlRes = mysqli_query($db, $sqlReq);
		return ceil(mysqli_fetch_row($sqlRes)["0"] / $size);
	}
	
	// Взятие данных для товара id
	function getGood4Product($id) {
		$sqlReq = "SELECT id, name, price, description, img from goods WHERE id=$id";
		global $db;

		$sqlRes = mysqli_query($db, $sqlReq);
		return mysqli_fetch_assoc($sqlRes);
	}

	// Функция занесения обращения пользователя в БД
	function addAppeal($name, $email, $text, $phone = 0) {
		global $db;
		$sqlReq = "INSERT INTO appeals (userName, email, " . 
			($phone ? "phone, " : "") . "message) VALUES ('" . 
			$name . "', '" . $email . "', '" .
			($phone ? $phone . "', '" : "") . $text . "');";
		return mysqli_query($db, $sqlReq);
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

	// Возвращает валидный email, если возможно такое преобразование
	// Иначе возвращает NULL
	function validEmail($str) {
		if(!isset($str))
			return NULL;
		$symbols = [" ", "\r", "\n", "\t"];
		$str = str_replace($symbols, "", $str);
		return preg_match("!^[A-Za-z0-9]+@[A-Za-z]+(\.[A-Za-z]+)+$!", $str) ? $str : NULL;
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
		echo '<li class="paginator__elem paginator__elem_next">'
			. ($cur != 1 ? '<a href="' . $thisScript . '?page=' . ($cur - 1) .
			'" class="paginator__link">Предыдущая страница</a>' : '') . '</li>';
		// Количество отображаемых элементов в пагинаторе
		$shift = ($show - 1) / 2;
		$thisScript = $_SERVER["SCRIPT_NAME"];
		// Мы слишком слева
		if($cur - $shift < 1) {
			if($show > $max)
				$show = $max;
			for ($i = 1; $i <= $show; $i++) {
				if($i === $cur)
					echo '<li class="paginator__elem paginator__elem_current"><span class="paginator__link">' . $i . '</span></li>';
				else
					echo '<li class="paginator__elem"><a href="' . $thisScript . '?page=' . $i . '" class="paginator__link">' . $i . '</a></li>';
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
					echo '<li class="paginator__elem"><a href="' . $thisScript . '?page=' . $i . '" class="paginator__link">' . $i . '</a></li>';
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
					echo '<li class="paginator__elem"><a href="' . $thisScript . '?page=' . $i . '" class="paginator__link">' . $i . '</a></li>';
			}
		}
		echo '<li class="paginator__elem paginator__elem_next">' . ($cur != $max ? '<a href="' . $thisScript . '?page=' . ($cur + 1) . '" class="paginator__link">Следующая страница</a>' : '') . '</li></ul>';
	}

	// Функция для замены текста в header'е после его создания
	function changeTitle($buffer) {
		global $title;
		return str_replace("%TITLE_REPLACEMENT%", $title, $buffer);
	}

	/***********************Функции не связанные с БД***************************/
?>