<?
	require_once("lib/conf.php");
	require_once("lib/functions.php");
	ob_start();
	// Сразу берём категории, т.к. они всегда нужны для сайдбара, а он на каждой странице
	// Т.к. категорий не должно быть много, то сразу подцепляем и ссылки на изображения
	// Помимо прочего не переопределяем подменю после инициализации меню, чтобы избежать
	// избыточных обращений к массиву массива
	$db = mysqli_connect(DB_HOST, DB_LOGIN, DB_PASSWORD, DB_NAME) or die ('Not connected: ' . mysql_error());
	$cats = getCat4Sidebar();
	foreach ($cats as $item) {
		$categoriesSubMenu[] = [
			"name"=>$item["name"],
			"href"=>"catalog.php?category=" . $item["id"]
		];
	}

	// Храним меню в массиве, т.к. оно повторяется дважды и может изменяться
	$menu = [
		["name"=>"Главная", "href"=>"index.php"],
		["name"=>"Каталог", "href"=>"catalog.php", "sub-menu"=>$categoriesSubMenu],
		["name"=>"О компании", "href"=>"about.php"],
		["name"=>"Новости", "href"=>"news.php"],
		["name"=>"Доставка и оплата", "href"=>"paydelivery.php"],
		["name"=>"Контакты", "href"=>"contacts.php"]
	];
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" href="css/stylesheet.css">
	<link rel="shortcut icon" href="img/favicon.png" type="image/png">
	<link rel="alternate" href="https://allfont.ru/allfont.css?fonts=arial-narrow">
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="js/script.js"></script>
	<title>%TITLE_REPLACEMENT%</title>
</head>
<body>
	<header class="page-header">
		<div class="wrapper">
			<aside class="header-top">
				%LOGO_REPLACEMENT%
				<div class="company-info">
					<b class="company-info__tagline">Нанотехнологии здоровья</b>
					<div class="contacts">
						<a class="contacts__link-mail" href="mailto:info@company.ru">info@company.ru</a>
						<a class="contacts__link-phone" href="tel:+73833491849">+7 (383) 349-18-49</a>
					</div>
				</div>
			</aside>
			<div class="user-info">
				<form class="user-info__form" method="POST" action="login.php">
					<span>
						<label class="user-info__label" for="user-name">Логин: </label>
						<input class="user-info__input" type="text" name="user-name" id="user-name">
					</span>
					<span>
						<label class="user-info__label user-info__label_margin-right_bigger" for="user-password">Пароль: </label>
						<input class="user-info__input" type="password" name="user-password" id="user-password">
					</span>
					<input class="user-info__link user-info__link_hover" type="submit" name="submit" value="Войти">
				</form>
				<?
					if($activePage === "Регистрация")
						echo '<span class="user-info__link user-info__link_reposition">Регистрация</span>';
					else
						echo '<a class="user-info__link user-info__link_hover user-info__link_reposition" href="registration.php">Регистрация</a>';
				?>
				<span class="cart-label">В <a class="cart-label__link" href="#">корзине</a> товаров - <b>12</b></span>
			</div>
		</div>
		%HEADER_MENU_REPLACEMENT%
	</header>
	<div class="content">
		<div class="wrapper content__wrapper">
			<main class="inside-content">