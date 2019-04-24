<?
	$title = "Информация о доставке и оплате — интернет-магазин Company";
	$activePage = "Доставка и оплата";
	require_once("lib/conf.php");
	require_once("inner/meta.php");
?>
<body>
	<? require_once("inner/header.php"); ?>
	<div class="content">
		<div class="wrapper content__wrapper">
			<main class="inside-content">
				<article class="shipment-article">
					<h1>Доставка</h1>
					<p><b>Уважаемые покупатели!</b></p>
					<p>
						Оплатить свой заказ Вы можете любым из следующих способов:
					</p>
					<ol>
						<li>Оплата наличными курьеру (в Москве в пределах МКАД)</li>
						<li>Оплата с помощью Яндекс.Деньги</li>
						<li>Оплата по безналичному расчету</li>
						<li>Оплата по квитанции Сбербанка РФ или другого коммерческого банка.</li>
					</ol>
					<p>В двух последних случаях мы выписываем Вам счет, который Вы получаете по электронной почте после подтверждения
						Вашего заказа. После получения денег, мы в течение 2-3 рабочих дней доставляем Вам товар с помощью транспортных
						компаний "СПСР" и "Грузовозофф" (по РФ), а так же по желанию "Почтой РФ". Стоимость доставки по РФ
						согласовывается с Вами и включается в стоимость счета.</p>
					<p>Доставка по Москве осуществляется на следующий день после согласования заказа.</p>
					<p>Стоимость курьерской доставки по Москве составляет <b>250 р.</b></p>
					<p>Доставка по Москве крупногабаритных товаров (от 5 кг) - <b>300 р.</b></p>
					<p>Доставка за пределы МКАД - по договоренности</p>
					<p><i>Также, Вы имеете возможность приобрести товары в нашем шоу-руме на м.Сходненская</i></p>
				</article>
			</main>
			<? require_once("inner/sidebar.php"); ?>
		</div>
	</div>
	<? require_once("inner/footer.php"); ?>
</body>

</html>