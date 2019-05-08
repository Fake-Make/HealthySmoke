<?
	require_once("lib/conf.php");
	require_once("lib/functions.php");
	ob_start();
	// Сразу берём категории, т.к. они всегда нужны для сайдбара, а он на каждой странице
	// Т.к. категорий не должно быть много, то сразу подцепляем и ссылки на изображения
	// Помимо прочего не переопределяем подменю после инициализации меню, чтобы избежать
	// избыточных обращений к массиву массива
	$db = mysqli_connect(DB_HOST, DB_LOGIN, DB_PASSWORD, DB_NAME) or die ('Not connected: ' . mysql_error());
	// Взятие категорий из БД (раньше было одной функцией)
	$sqlReq = "SELECT id, name, img from categories";
	$cats = mysqli_fetch_all(mysqli_query($db, $sqlReq), MYSQLI_ASSOC);
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
	$title = "Интернет-магазин электронных сигарет - Company";
	$mainPageScript = $menu["0"]["href"];
	$thisScript = $_SERVER["SCRIPT_NAME"];
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
				<?
					// Флаг, показывающий, что мы не на главной странице
					$isNotMainPage = false === strpos($thisScript, $mainPageScript);
					echo $isNotMainPage ? 
						'<a class="header-logo header-logo__link" href="index.php">' :
						'<div class="header-logo">';

					echo 
						'<img class="header-logo__image" src="img/logo.png" alt="Логотип" width="95" height="75">
						<span class="header-logo__caption">Company</span>';
					
					echo $isNotMainPage ?
						'</a>' :
						'</div>';
				?>
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
					echo false !== strpos($_SERVER["SCRIPT_NAME"], "registration.php") ?
						'<span class="user-info__link user-info__link_reposition">Регистрация</span>' :
						'<a class="user-info__link user-info__link_hover user-info__link_reposition" href="registration.php">Регистрация</a>';
				?>
				<span class="cart-label">В <a class="cart-label__link" href="#">корзине</a> товаров - <b>12</b></span>
			</div>
		</div>
		<?
			echo
				'<nav class="header-nav">
					<div class="wrapper">
						<span class="menu-toggler">Меню</span>
						<ul class="menu-togglable">';
			foreach ($menu as $item) {
				$menuItemName = $item["name"];
				$menuItemHref = $item["href"];
				// Флаг, показывающий, что текущий элемент меню - есть текущая страница
				$isCurrentPage = false !== strpos($thisScript, $menuItemHref);
				echo '<li class="header-nav-item"><span>';
				// Если есть под-меню
				if(isset($item["sub-menu"])) {
					echo '<span class="header-nav-item__container-for-link">' .
						($isCurrentPage ?
							'<span class="header-nav-item__link header-nav-item__link_current">' . $menuItemName . '</span>' :
							'<a class="header-nav-item__link" href="' . $menuItemHref . '">' . $menuItemName . '</a>') .
						'</span><ul class="sub-menu">';

					foreach($item["sub-menu"] as $subItem) {
						$menuSubItemName = $subItem["name"];
						$menuSubItemHref = $subItem["href"];
						echo '<li class="sub-menu__list-item"><a class="sub-menu__link" href="' . $menuSubItemHref . '">' . $menuSubItemName . '</a></li>';
					}
					echo '</ul>';
				} else {
					echo $isCurrentPage ?
						'<span class="header-nav-item__link header-nav-item__link_current">' . $menuItemName . '</span>' :
						'<a class="header-nav-item__link" href="' . $menuItemHref . '">' . $menuItemName . '</a>';
				}
				echo '</span></li>';
			}
			echo '</ul></div></nav>';
		?>
	</header>
	<div class="content">
		<div class="wrapper content__wrapper">
			<main class="inside-content">