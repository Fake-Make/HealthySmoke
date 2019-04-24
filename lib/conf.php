<?
	require_once("db.php");
	require_once("functions.php");
	// Конфигурационный файл сайта для хранения глобальных переменных и констант
	define(TEST_MAIL, "test@example.com");
	$title = $title ? $title : "Company - Интернет-магазин электронных сигарет";
	$activePage = $activePage ? $activePage : "Главная";

	$maxNewsOnPage = 15;
	$maxNewsAtSidebar = 6;
	$maxGoodsOnPage = 12;

	$cats = getCat4Sidebar();
	foreach ($cats as $item) {
		$categoriesSubMenu[] = [
			"name"=>$item["name"],
			"href"=>"catalog.php?category=" . $item["id"]
		];
	}

	$menu = [
		"0" => ["name"=>"Главная", "href"=>"index.php"],
		"1" => ["name"=>"Каталог", "href"=>"catalog.php", "sub-menu"=>$categoriesSubMenu],
		"2" => ["name"=>"О компании", "href"=>"about.php"],
		"3" => ["name"=>"Новости", "href"=>"news.php"],
		"4" => ["name"=>"Доставка и оплата", "href"=>"paydelivery.php"],
		"5" => ["name"=>"Контакты", "href"=>"contacts.php"]
	];
?>