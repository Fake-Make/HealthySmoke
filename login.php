<? require_once("inner/meta.php"); ?>
<body>
	<? require_once("inner/header.php"); ?>
	<div class="content">
		<div class="wrapper content__wrapper">
			<main class="inside-content inside-content__registration">
				<section class="feedback-form feedback-form__registration">
					<h1 class="registration-headline registration-headline_login">Вход</h1>
					<form method="POST" class="login-form" name="any-page__login-form_full">
						<div class="feedback-form__row">
							<label class="inner-label" for="login-user-email">
								Электронная почта
							</label>
							<input class="inner-input-box inner-input-box__login-email" type="email" name="login-user-email" id="login-user-email">
						</div>
						<div class="feedback-form__row feedback-form__registration-password">
							<label class="inner-label" for="login-password">
								Пароль
							</label>
							<input class="inner-input-box inner-input-box__login-password" type="password" name="login-password" id="login-password">
							<span class="error-text feedback-form__error-hint error_emptyness invisible">Поле «Пароль» должно быть заполнено</span>
						</div>
						<input class="form-submit data-send form-submit__registration form-submit__login" type="submit" value="Войти">
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