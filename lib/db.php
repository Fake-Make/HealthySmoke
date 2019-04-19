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

	// Функция проверки пользовательского обращения на пустоту
	function checkAppeal($post) {
		return is_array($post) && strlen($post["feedback-author"]) && strlen($post["email"]) && strlen($post["feedback-text"]) ? 1 : 0;
	}


	// Функция валидации пользовательского обращения
	// Экранирование символов HTML, двойных кавычек и апострофов
	function validAppeal($post) {
		global $db;
		foreach ($post as $key=>$item) {
			$validPost[$key] = mysqli_real_escape_string($db, htmlspecialchars($item));
		}
		return $validPost;
	}

	// Функция занесения обращения пользователя в БД
	function addAppeal($post) {
		global $db;
		$post = validAppeal($post);
		$sqlReq = "INSERT INTO appeals (userName, email, " . 
			($post["phone"] ? "phone, " : "") . "message) VALUES ('" . 
			$post["feedback-author"] . "', '" . $post["email"] . "', '" .
			($post["phone"] ? $post["phone"] . "', '" : "") . $post["feedback-text"] . "');";
		return mysqli_query($db, $sqlReq);
	}
?>