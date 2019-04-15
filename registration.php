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
	<title>Company - Интернет-магазин электронных сигарет</title>
</head>

<body>
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
					<input class="user-info__link" type="submit" value="Войти">
				</form>
				<span class="user-info__link user-info__link_reposition header-nav-item__link_current">Регистрация</span>
				<span class="cart-label">В <a class="cart-label__link" href="#">корзине</a> товаров - <b>12</b></span>
			</div>
		</div>
		<nav class="header-nav">
			<div class="wrapper">
				<span class="menu-toggler">Меню</span>
				<ul class="menu-togglable">
					<li class="header-nav-item"><span><a class="header-nav-item__link" href="index.html">Главная</a></span></li>
					<li class="header-nav-item">
						<span class="header-nav-item__container-for-link"><a class="header-nav-item__link" href="catalog.html">Каталог</a></span>
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
					<li class="header-nav-item"><span><a class="header-nav-item__link" href="shipment.html">Доставка и оплата</a></span></li>
					<li class="header-nav-item"><span><a class="header-nav-item__link" href="contacts.html">Контакты</a></span></li>
				</ul>
			</div>
		</nav>
	</header>
	<div class="content">
		<div class="wrapper content__wrapper">
			<main class="inside-content inside-content__registration">
				<section class="feedback-form feedback-form__registration">
					<h1 class="registration-headline">Регистрация</h1>
					<p class="feedback-form__hint">
						<span class="required-star">*</span> — обязательные для заполнения поля
					</p>
					<aside class="error-box error-text">
						<p class="error-message">
							Поле «Имя» должно быть заполнено
						</p>
						<p class="error-message">
							Пользователь с такой электронной почтой уже зарегистрирован
						</p>
						<p class="error-message">
							Поле «Подтверждение пароля» должно быть заполнено
						</p>
						<p class="error-message">
							Поле «Пароль» должно быть заполнено
						</p>
					</aside>
					<form method="POST" class="registration-form" name="registration-page__registration-form">
						<div class="feedback-form__row">
							<label class="inner-label" for="registration-user-name">
								Имя <span class="required-star">*</span>
							</label>
							<input class="inner-input-box inner-input-box__name" type="text" name="registration-user-name" id="registration-user-name">
							<span class="error-text feedback-form__error-hint error-emptyness invisible">Поле «Имя» должно быть заполнено</span>
						</div>
						<div class="feedback-form__row">
							<label class="inner-label" for="registration-email">
								Электронная почта <span class="required-star">*</span>
							</label>
							<input class="inner-input-box inner-input-box__registration-email" type="email" name="registration-email" id="registration-email">
							<span class="error-text feedback-form__error-hint error-emptyness invisible">Поле «Электронная почта» должно
								быть заполнено</span>
							<span class="error-text feedback-form__error-hint error_correctness	invisible">Неверный адрес электронной почты</span>
						</div>
						<div class="feedback-form__row">
							<label class="inner-label optional" for="phone">
								Телефон
							</label>
							<input class="inner-input-box" type="tel" name="phone" id="phone">
						</div>
						<div class="feedback-form__row feedback-form__registration-password">
							<label class="inner-label" for="registration-password">
								Пароль <span class="required-star">*</span>
							</label>
							<input class="inner-input-box inner-input-box__password" type="password" name="registration-password" id="registration-password">
							<span class="error-text feedback-form__error-hint error-emptyness invisible">Поле «Пароль» должно быть
								заполнено</span>
						</div>
						<div class="feedback-form__row feedback-form__registration-password-confirm">
							<label class="inner-label" for="registration-password-confirm">
								Подтверждение пароля <span class="required-star">*</span>
							</label>
							<input class="inner-input-box inner-input-box__password-confirm" type="password" name="registration-password-confirm"
							 id="registration-password-confirm">
							<span class="error-text feedback-form__error-hint error-emptyness invisible">Поле «Подтверждение
								пароля» должно быть заполнено</span>
						</div>
						<input class="form-submit data-send form-submit__registration" type="submit" value="Зарегистрироваться">
					</form>
				</section>
			</main>
			<div class="sidebar">
				<section class="catalog">
					<h2 class="sidebar__headline">Каталог</h2>
					<ul class="catalog-list">
						<li class="catalog-list__item"><a class="catalog-list__link" href="#">Электронные сигареты</a></li>
						<li class="catalog-list__item"><a class="catalog-list__link" href="#">Трубки</a></li>
						<li class="catalog-list__item"><a class="catalog-list__link" href="#">Жидкости для заправки</a></li>
						<li class="catalog-list__item"><a class="catalog-list__link" href="#">Аккумуляторы и атомайзеры</a></li>
						<li class="catalog-list__item"><a class="catalog-list__link" href="#">Картриджи</a></li>
						<li class="catalog-list__item"><a class="catalog-list__link" href="#">Зарядные устройства</a></li>
						<li class="catalog-list__item"><a class="catalog-list__link" href="#">Аксессуары</a></li>
						<li class="catalog-list__item"><a class="catalog-list__link" href="#">Подарочные наборы</a></li>
					</ul>
				</section>
				<section class="news">
					<h2 class="sidebar__headline news__headline">Новости</h2>
					<ul class="news-list">
						<li class="news-item">
							<a class="news-item__link" href="#">
								Поздравительная речь президента международной корпорации Хуа Шэн господина Ли Вея в Международный...
							</a>
							<span class="news-item__date">2010-03-03</span>
						</li>
						<li class="news-item">
							<a class="news-item__link" href="#">
								Собрание правления киевского филиала
							</a>
							<span class="news-item__date">2010-02-27</span>
						</li>
						<li class="news-item">
							<a class="news-item__link" href="#">
								Петропавловскому офису международной корпорации Хуа Шен исполнился 1 год
							</a>
							<span class="news-item__date">2010-02-23</span>
						</li>
						<li class="news-item">
							<a class="news-item__link" href="#">
								Проведение церемонии награждения в бишкекском филиале
							</a>
							<span class="news-item__date">2010-02-22</span>
						</li>
						<li class="news-item">
							<a class="news-item__link" href="#">
								Сотрудники иркутского филиала отметили китайский новый
							</a>
							<span class="news-item__date">2010-02-15</span>
						</li>
						<li class="news-item">
							<a class="news-item__link" href="#">
								Празднование китайского нового года в одесском филиале
							</a>
							<span class="news-item__date">2010-02-14</span>
						</li>
					</ul>
					<span class="archive"><a class="archive__link" href="#">Архив новостей</a></span>
				</section>
			</div>
		</div>
	</div>
	<footer class="page-footer">
		<div class="wrapper page-footer__wrapper">
			<div class="copyright">
				<span class="copyright__part copyright__lifetime">Copyright ©2007-2010</span>
				<span class="copyright__part copyright__company-lifetime"><b>© "Company"</b>, 2010</span>
				<img class="copyright__image" src="img/logo.png" alt="Company-logo">
				<span class="copyright__part copyrhigt__company-name">Company</span>
			</div>
			<nav class="footer-nav">
				<ul class="footer-nav__list">
					<li class="footer-nav__list-item"><a class="footer-nav__link" href="index.html">Главная</a></li>
					<li class="footer-nav__list-item"><a class="footer-nav__link" href="catalog.html">Каталог</a></li>
					<li class="footer-nav__list-item"><a class="footer-nav__link" href="#">О компании</a></li>
					<li class="footer-nav__list-item"><a class="footer-nav__link" href="#">Новости</a></li>
					<li class="footer-nav__list-item"><a class="footer-nav__link" href="shipment.html">Доставка и оплата</a></li>
					<li class="footer-nav__list-item"><a class="footer-nav__link" href="contacts.html">Контакты</a></li>
				</ul>
			</nav>
			<div class="developer">
				<span class="developer__ref">Разработка сайта - <a class="developer__link" href="#">ITConstruct</a></span>
				<img class="counter" src="img/counter.png" alt="Page-counter">
			</div>
		</div>
	</footer>
</body>

</html>