<!--Файл, содержащий заголовочный блок для всех страниц сайта-->
<header class="page-header">
	<div class="wrapper">
		<aside class="header-top">
			<div class="header-logo">
				<img class="header-logo__image" src="img/logo.png" alt="Логотип" width="95" height="75">
				<span class="header-logo__caption">Company</span>
			</div>
			<div class="company-info">
				<b class="company-info__tagline">Нанотехнологии здоровья</b>
				<div class="contacts">
					<a class="contacts__link-mail" href="mailto:info@company.ru">info@company.ru</a>
					<a class="contacts__link-phone" href="tel:+73833491849">+7 (383) 349-18-49</a>
				</div>
			</div>
		</aside>
		<div class="user-info">
			<form class="user-info__form" method="POST" action="send">
				<span>
					<label class="user-info__label" for="user-name">Логин: </label>
					<input class="user-info__input" type="text" name="user-name" id="user-name">
				</span>
				<span>
					<label class="user-info__label user-info__label_margin-right_bigger" for="user-password">Пароль: </label>
					<input class="user-info__input" type="password" name="user-password" id="user-password">
				</span>
				<input class="user-info__link" type="submit" name="submit" value="Войти">
			</form>
			<a class="user-info__link user-info__link_reposition" href="registration.php">Регистрация</a>
			<span class="cart-label">В <a class="cart-label__link" href="#">корзине</a> товаров - <b>12</b></span>
		</div>
	</div>
	<nav class="header-nav">
		<div class="wrapper">
			<span class="menu-toggler">Меню</span>
			<ul class="menu-togglable">
				<li class="header-nav-item"><span><span
							class="header-nav-item__link header-nav-item__link_current">Главная</span></span></li>
				<li class="header-nav-item">
					<span class="header-nav-item__container-for-link"><a class="header-nav-item__link"
							href="catalog.php">Каталог</a></span>
					<ul class="sub-menu">
						<li class="sub-menu__list-item"><a class="sub-menu__link" href="#">Электронные сигареты</a></li>
						<li class="sub-menu__list-item"><a class="sub-menu__link" href="#">Трубки</a></li>
						<li class="sub-menu__list-item"><a class="sub-menu__link" href="#">Картриджи</a></li>
						<li class="sub-menu__list-item"><a class="sub-menu__link" href="#">Аккумуляторы и атомайзеры</a></li>
						<li class="sub-menu__list-item"><a class="sub-menu__link" href="#">Аксессуары</a></li>
						<li class="sub-menu__list-item"><a class="sub-menu__link" href="#">Зарядные устройства</a></li>
						<li class="sub-menu__list-item"><a class="sub-menu__link" href="#">Жидкости для заправки</a></li>
						<li class="sub-menu__list-item"><a class="sub-menu__link" href="#">Подарочные наборы</a></li>
					</ul>
				</li>
				<li class="header-nav-item"><span><a class="header-nav-item__link" href="#">О компании</a></span></li>
				<li class="header-nav-item"><span><a class="header-nav-item__link" href="#">Новости</a></span></li>
				<li class="header-nav-item"><span><a class="header-nav-item__link" href="shipment.php">Доставка и
							оплата</a></span></li>
				<li class="header-nav-item"><span><a class="header-nav-item__link" href="contacts.php">Контакты</a></span></li>
			</ul>
		</div>
	</nav>
</header>