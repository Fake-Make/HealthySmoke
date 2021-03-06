<?require_once("template/header.php")?>
<?
	$title = "Вход — интернет-магазин электронных сигарет Company";
	echo changeTitle(ob_get_clean());
?>
<section class="feedback-form feedback-form__registration">
	<h1 class="registration-headline registration-headline_login">Вход</h1>
	<form method="POST" class="login-form" name="any-page__login-form_full">
		<div class="feedback-form__row">
			<label class="template-label" for="login-user-email">
				Электронная почта
			</label>
			<input class="template-input-box template-input-box__login-email" type="email" name="login-user-email" id="login-user-email">
		</div>
		<div class="feedback-form__row feedback-form__registration-password">
			<label class="template-label" for="login-password">
				Пароль
			</label>
			<input class="template-input-box template-input-box__login-password" type="password" name="login-password" id="login-password">
			<span class="error-text feedback-form__error-hint error_emptyness invisible">Поле «Пароль» должно быть заполнено</span>
		</div>
		<input class="form-submit data-send form-submit__registration form-submit__login" type="submit" value="Войти">
	</form>
</section>
<?require_once("template/footer.php")?>