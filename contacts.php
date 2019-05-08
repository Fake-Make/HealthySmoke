<?require_once("template/header.php");?>
<?
	$title = "Контактная информация ООО «Company»";
	// Открываем сессию или проверяем существование таковой
	session_start();
	echo changeTitle(ob_get_clean());
?>
<h1 class="contacts-page__main-headline">Контакты</h1>
<table class="contacts-section">
	<tbody>
		<tr>
			<td>
				<h2>Адрес нашего офиса:</h2>
				<p>
					630065, г. Новосибирск, Декабристов, 92, корп.7
					<br>Время приема заказов по телефону -
				</p>
				<p>
					с 9.30 до 18.00
					<br>Телефоны: +7 (383) 255‒15‒15 ; 349‒18‒49
				</p>
				<h2>Магазины партнеры:</h2>
				<h3>Москва:</h3>
				<p>
					Красный проспект, 50, стр. 1. универмаг "Московский":
					<br>1-й этаж, левое крыло пав. 71, тел.: +7 (383) 239‒39‒50;
				</p>
				<h3>Санкт-Петербург:</h3>
				<p>
					www.president-spa.club, (913) 321-83-54
				</p>
			</td>
			<td class="contacts-section__second-column">
				<h2>ООО «Компания»</h2>
				<p>
					Ген. директор:Иванов А.Ю.
				</p>
				<p>
					Юридический адрес: 630065, г. Новосибирск,
					<br>Декабристов, 92, корп.7
				</p>
				<p>
					ИНН 7733700983; КПП 7737655901;
				</p>
				<p>
					ОГРН 1097746493754 от 15 июня 2014г.
				</p>
				<p>
					Наименование банка: ОАО «УРАЛСИБ»
				</p>
				<p>
					г. Москва БИК 042591537;
					<br>Корр. счет 31542814300000000327; Расчетный счет 40418710900020003009
				</p>
			</td>
		</tr>
	</tbody>
</table>
<section class="feedback-form">
	<h2 class="feedback-form__headline">Форма обратной связи</h2>
	<?
		if(!empty($_POST)):
			// Валидация полей
			$fName = validAnyString($_POST["feedback-author"]);
			$fEmail = validEmail($_POST["email"]);
			$fPhone = validPhone($_POST["phone"]);
			$fMessage = validAnyString($_POST["feedback-text"]);
			// Флаг отсутствия ошибок
			if($fSummary = $fName && $fEmail && $fMessage) {
				// Отправка сообщения
				$message = "Пользователем " . $fName . " было отправлено обращение: \r\n" .
					$fMessage . "\r\nОтветить можно по email: " . $fEmail . 
					($fPhone ? " или по телефону: " . $fPhone . ".\r\n" : ".\r\n");
				if($fSummary = $messageSent = mail(TEST_MAIL, "Пользовательское обращение", $message)) {
					// Добавление в базу данных
					$sqlReq = "INSERT INTO appeals (userName, email, " . 
						($fPhone ? "phone, " : "") . "message) VALUES ('" . 
						$fName . "', '" . $fEmail . "', '" .
						($fPhone ? $fPhone . "', '" : "") . $fMessage . "');";
					mysqli_query($db, $sqlReq);
					$_SESSION['feedback'] = 'sent';
				}
			}
		endif;
	?>
	<?if($_SESSION['feedback'] === 'sent'):?>
		<p>Благодарим за ваше письмо. Мы свяжемся с вами в ближайшее время!</p>
	<?else:?>
		<?
			echo
				'<p class="feedback-form__hint">
					<span class="required-star">*</span> — обязательные для заполнения поля
				</p>';
			// Если пришли ошибочки
			if(!empty($_POST) && !$fSummary) {
				echo '<aside class="error-box error-text">';
				if(!$fName)
					echo
						'<p class="error-message">
							Поле «Имя» должно быть заполнено
						</p>';
				if(!$fEmail)
					echo
						'<p class="error-message">
							Поле «Электронная почта» должно быть заполнено <?=empty($_POST["email"]) ? "" : "корректно"?>
						</p>';
				if(!empty($_POST["phone"]) && !$fPhone)
					echo
						'<p class="error-message">
							Поле «Телефон» должно соответствовать примеру: 7 999 111 22 33
						</p>';
				if(!$fMessage)
						echo
							'<p class="error-message">
								Поле обращения должно быть заполнено
							</p>';
				if($fName && $fEmail && $fMessage && (empty($_POST["phone"]) || !empty($_POST["phone"]) && $fPhone) && false === $messageSent)
					echo
						'<p class="error-message">
							На сервере произошла ошибка: ваше письмо не отправлено! Попробуйте ещё раз.
						</p>';
				echo '</aside>';
			}
		?>
		<form method="POST" class="registration-form" name="contats-page__feedback-form" action="contacts.php">
			<div class="feedback-form__row">
				<label class="template-label" for="feedback-author">
					Имя <span class="required-star">*</span>
				</label>
				<input class="template-input-box template-input-box__name" type="text" name="feedback-author" id="feedback-author" <?=$fName ? 'value="' . $fName . '"' : ''?>>
				<span class="error-text feedback-form__error-hint error-emptyness invisible">Поле «Имя» должно быть заполнено</span>
			</div>
			<div class="feedback-form__row">
				<label class="template-label" for="email">
					Электронная почта <span class="required-star">*</span>
				</label>
				<input class="template-input-box template-input-box__email" type="email" name="email" id="email" <?=$fEmail ? 'value="' . $fEmail . '"' : ""?>>
				<span class="error-text feedback-form__error-hint error-emptyness invisible">Поле «Электронная почта» должно быть заполнено</span>
			</div>
			<div class="feedback-form__row">
				<label class="template-label optional" for="phone">
					Телефон
				</label>
				<input class="template-input-box" type="tel" name="phone" id="phone" <?=$fPhone ? 'value="' . $fPhone . '"' : ''?>>
			</div>
			<div class="feedback-form__row feedback-form__row_left-shift">
				<label class="template-label feedback-text-area__label" for="feedback-text">
					Пожалуйста укажите какого рода информация вас интересует <span class="required-star">*</span>
				</label>
				<textarea class="template-input-box feedback-text-area__input" name="feedback-text" id="feedback-text"><?=$fMessage ? $fMessage : ""?></textarea>
				<div>
					<input class="form-submit data-send" type="submit" value="Отправить">
					<input class="form-submit clear-inputs" type="button" value="Очистить поля">
				</div>
			</div>
		</form>
	<?endif?>
</section>
<?require_once "template/footer.php"?>