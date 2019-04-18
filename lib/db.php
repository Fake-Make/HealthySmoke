<?
	// Файл с функциями для работы с СУБД
	// Можно сменить СУБД, но результаты вызова функций и их параметры должны остаться прежними

	require_once("conf.php");

/*
	name VARCHAR(255) NOT NULL,
	img VARCHAR(255),
*/

	function getCat4Index() {
		$sqlReq = "SELECT name, img from categories";
		global $db;

		$sqlRes = mysqli_query($db, $sqlReq);
		return mysqli_fetch_all($sqlRes, MYSQLI_ASSOC);
	}

	function getCat4Sidebar() {
		$sqlReq = "SELECT name from categories";
		global $db;

		$sqlRes = mysqli_query($db, $sqlReq);
		return mysqli_fetch_all($sqlRes, MYSQLI_ASSOC);
	}
	
	function getNews4Sidebar() {
		$sqlReq = "SELECT anounce, dt from news ORDER BY dt DESC LIMIT 6";
		global $db;

		$sqlRes = mysqli_query($db, $sqlReq);
		return mysqli_fetch_all($sqlRes, MYSQLI_ASSOC);
	}
?>