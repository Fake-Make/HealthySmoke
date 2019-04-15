<? require_once("inner/meta.php"); ?>
<body>
	<? require_once("inner/header.php"); ?>
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
	<? require_once("inner/footer.php"); ?>
</body>

</html>