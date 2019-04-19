<?
	// Файл с функциями для работы с СУБД
	// Можно сменить СУБД, но результаты вызова функций и их параметры должны остаться прежними

	require_once("conf.php");

	// Выборка названий и изображений всех категорий для главной страницы
	function getCat4Index() {
		$sqlReq = "SELECT name, img from categories";
		global $db;

		$sqlRes = mysqli_query($db, $sqlReq);
		return mysqli_fetch_all($sqlRes, MYSQLI_ASSOC);
	}

	// Выборка названий всех категорий для сайдбара
	function getCat4Sidebar() {
		$sqlReq = "SELECT name from categories";
		global $db;

		$sqlRes = mysqli_query($db, $sqlReq);
		return mysqli_fetch_all($sqlRes, MYSQLI_ASSOC);
	}
	
	// Выборка шести последних новостей для сайдбара
	function getNews4Sidebar() {
		$sqlReq = "SELECT anounce, dt from news ORDER BY dt DESC LIMIT 6";
		global $db;

		$sqlRes = mysqli_query($db, $sqlReq);
		return mysqli_fetch_all($sqlRes, MYSQLI_ASSOC);
	}

	// Возвращает SQL/XSS-безопасную входную строку, если она содержит хотя бы один непробельный символ
	// Иначе возвращает 0
	function validAnyString($str) {
		if (!isset($str))
			return 0;
		global $db;
		$spaces = [" ", "\r", "\n", "\t"];
		return strlen(str_replace($spaces, "", $str)) ? mysqli_real_escape_string($db, htmlspecialchars($str)) : 0;
	}

	// Возвращает валидный email, если возможно такое преобразование
	// Иначе возвращает 0
	function validEmail($str) {
		if (!isset($str))
			return 0;
		$symbols = [" ", "\r", "\n", "\t"];
		echo $str . "\n";
		$str = str_replace($symbols, "", $str);
		echo $str . "\n";
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

	// Функция занесения обращения пользователя в БД
	function addAppeal($name, $email, $text, $phone = 0) {
		global $db;
		$sqlReq = "INSERT INTO appeals (userName, email, " . 
			($phone ? "phone, " : "") . "message) VALUES ('" . 
			$name . "', '" . $email . "', '" .
			($phone ? $phone . "', '" : "") . $text . "');";
		return mysqli_query($db, $sqlReq);
	}
?>