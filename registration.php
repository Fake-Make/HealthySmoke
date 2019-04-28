<?require_once("template/header.php");?>
<?
	$title = "Регистрация — интернет-магазин Company";
	echo changeTitle(ob_get_clean());
?>
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
			<label class="template-label" for="registration-user-name">
				Имя <span class="required-star">*</span>
			</label>
			<input class="template-input-box template-input-box__name" type="text" name="registration-user-name" id="registration-user-name">
			<span class="error-text feedback-form__error-hint error-emptyness invisible">Поле «Имя» должно быть заполнено</span>
		</div>
		<div class="feedback-form__row">
			<label class="template-label" for="registration-email">
				Электронная почта <span class="required-star">*</span>
			</label>
			<input class="template-input-box template-input-box__registration-email" type="email" name="registration-email" id="registration-email">
			<span class="error-text feedback-form__error-hint error-emptyness invisible">Поле «Электронная почта» должно быть заполнено</span>
			<span class="error-text feedback-form__error-hint error_correctness	invisible">Неверный адрес электронной почты</span>
		</div>
		<div class="feedback-form__row">
			<label class="template-label optional" for="phone">
				Телефон
			</label>
			<input class="template-input-box" type="tel" name="phone" id="phone">
		</div>
		<div class="feedback-form__row feedback-form__registration-password">
			<label class="template-label" for="registration-password">
				Пароль <span class="required-star">*</span>
			</label>
			<input class="template-input-box template-input-box__password" type="password" name="registration-password" id="registration-password">
			<span class="error-text feedback-form__error-hint error-emptyness invisible">Поле «Пароль» должно быть заполнено</span>
		</div>
		<div class="feedback-form__row feedback-form__registration-password-confirm">
			<label class="template-label" for="registration-password-confirm">
				Подтверждение пароля <span class="required-star">*</span>
			</label>
			<input class="template-input-box template-input-box__password-confirm" type="password" name="registration-password-confirm"
			 id="registration-password-confirm">
			<span class="error-text feedback-form__error-hint error-emptyness invisible">Поле «Подтверждениe пароля» должно быть заполнено</span>
		</div>
		<input class="form-submit data-send form-submit__registration" type="submit" value="Зарегистрироваться">
	</form>
</section>
<?require_once "template/sidebarAndFooter.php"?>