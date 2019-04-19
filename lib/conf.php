<?
	// Конфигурационный файл сайта для хранения глобальных переменных и констант
	define(DB_HOST, "localhost");
	define(DB_LOGIN, "learn");
	define(DB_PASSWORD, "qwe123qwe");
	define(DB_NAME, "smoke");
	$db = mysqli_connect(DB_HOST, DB_LOGIN, DB_PASSWORD, DB_NAME) or die ('Not connected: ' . mysql_error());;

	define(TEST_MAIL, "test@example.com");
	$title = $title ? $title : "Company - Интернет-магазин электронных сигарет";
	$activePage = $activePage ? $activePage : "Главная";
?>