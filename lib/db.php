<?
	// Файл с функциями для работы с СУБД
	// Можно сменить СУБД, но результаты вызова функций и их параметры должны остаться прежними

	// Константы определяем здесь, потому что, если сменится БД и мы полезем менять функции,
	// то где мы потом будем копаться, чтобы найти эти константы?
	define(DB_HOST, "localhost");
	define(DB_LOGIN, "learn");
	define(DB_PASSWORD, "qwe123qwe");
	define(DB_NAME, "smoke");
	// Принудительное завершение соединения находится в конце файла footer.php
	$db = mysqli_connect(DB_HOST, DB_LOGIN, DB_PASSWORD, DB_NAME) or die ('Not connected: ' . mysql_error());

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
		return mysqli_fetch_all($sqlRes, MYSQLI_ASSOC);
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
		return mysqli_fetch_all($sqlRes, MYSQLI_ASSOC);
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