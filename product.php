<?
	// Взять название и цену товара
	$productName = "Product";
	$productPrice = 20;
	$title = "$productName — купить за $productPrice руб. в интернет-магазине Company";
	$activePage = "Каталог";
	require_once("inner/meta.php");
?>
<body>
	<? require_once("inner/header.php"); ?>
	<div class="content content__product">
		<div class="wrapper content__wrapper">
			<main class="inside-content">
				<nav class="bread-crumbs-container product__bread-crumbs">
					<ul class="bread-crumbs">
						<li class="bread-crumb"><a class="bread-crumb__link" href="index.php">Главная</a></li>
						<li class="bread-crumb"><a class="bread-crumb__link" href="catalog.php">Каталог</a></li>
						<li class="bread-crumb"><a class="bread-crumb__link" href="#">Электронные сигареты</a></li>
						<li class="bread-crumb bread-crumb_current">Электронная сигарета «Такая-то»</li>
					</ul>
				</nav>
				<section class="product">
					<h1 class="product__info-block-part product__headline">Электронная сигарета «Такая-то»</h1>
					<img class="product__image" src="img/product-image-1.jpg" alt="Упс! Здесь было фото сигареты, но теперь его нет :(">
					<span class="good-price good_price product__info-block-part product__info-price">820 <small class="good-price__currency">руб.</small></span>

					<form class="product__info-block-part product__form" name="product-page__product-to-cart-form" method="POST">
						<span class="amount-tubmler product__amount-tumbler">
							<button type="button" class="amount-tumbler__button amount-tumbler__button_left"></button>
							<input type="number" class="search-filter__input products-amount__input" min="1" value="1">
							<button type="button" class="amount-tumbler__button amount-tumbler__button_right"></button>
						</span>
						<button class="good-to-cart good_to-cart product__good_to-cart" value="Электронная сигарета «Такая-то»">Добавить
							в корзину</button>
					</form>
					<article class="product__description">
						<h2>Высокое качество японских ножей</h2>
						<p>
							Сегодня японские ножи соединили в себе древнейшие традиции изготовления самурайских мечей и инновационные
							технологии и, именно поэтому японские ножи обладают уникальными свойствами. Сделаны японские ножи только из
							высококачественных материалов. Клинок японского ножа делают из высокоуглеродистой стали, что обеспечивает его
							высокую прочность и надежность. Следует отметить, что японские ножи эргономичны по своему дизайну, что
							обеспечивает удобство и комфорт в работе. Японские ножи суперострые и после заточки очень долго не тупятся,
							благодаря этому уникальному качеству они получили широкую известность. Японские ножи - это прекрасный выбор,
							который говорит о требовательности покупателя к высокому качеству ножа и о его превосходном вкусе. Кстати, нужно
							отметить, что японские ножи предназначены не только для японской, но и для европейской, а также любой другой
							кухни. В известных ресторанах крупнейших городов во всем мире используют именно японские ножи. Японские ножи
							-это профессиональные инструменты для японской кухни (купить японские ножи Вы можете у нас).
						</p>
						<p>
							Интернет магазин "Chef" предлагает купить японские ножи (ножи касуми, масахиро), нож для суши. У нас есть
							японские ножи из дамасской стали (ножи masahiro, касуми). Дамасская сталь - это не просто причудливый узор на
							лезвии ножа, это технология, сочетающая твердую сталь сердцевины клинка для сохранения остроты ножа и множество
							слоев мягкой стали, которая и создает рисунок при заточке, для придания гибкости и прочности острой, но хрупкой
							сердцевине. По этой технологии делались древние острейшие самурайские мечи катаны. Ножи из дамасской стали
							прочны, надежны и долговечны, что подтверждено многолетним опытом. Не зря ножи из дамасской стали бестселлерами
							продаж. Есть также товары, которые являются результатом современных научных технологий: титановые, керамические
							ножи из Японии.
						</p>
						<p>
							Кухонные японские ножи (ножи masahiro, касуми, хаттори) известных торговых марок уже завоевали популярность
							благодаря своей прочности и уникальным качествам - остроте и долговечности заточки. Японские ножи (ножи касуми,
							масахиро, хаттори, кухонные ножи из дамасской стали) - это профессиональные поварские инструменты, секреты
							производства которых передаются и шлифуются мастерами из поколения в поколение. Эти японские ножи обладают
							особым значением - они своего рода статус шеф-повара, в Японии обладание таким ножом считалось показателем
							высокого мастерства в поварском деле.
						</p>
					</article>
				</section>

			</main>
			<? require_once("inner/sidebar.php"); ?>
		</div>
	</div>
	<? require_once("inner/footer.php"); ?>
</body>

</html>