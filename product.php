<?
	require_once("lib/db.php");
	if(!isset($_GET["id"]))
		header("Location: 404.php");
	// Валиднуть INT
	$id = $_GET["id"];
	$good = getGood4Product($id)["0"];
	$img = $good["img"] ? $good["img"] : "img/no-image.jpg";
	$alt = $good["img"] ? $img : "Изображение отсутствует";
	$productName = $good["name"];
	$price = $good["price"];
	$desc = $good["description"];

	// Взять название и цену товара
	$title = "$productName — купить за $price руб. в интернет-магазине Company";
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
						<?
							if (isset($_GET["category"]))
								echo '<li class="bread-crumb"><a class="bread-crumb__link" href="catalog.php?category=' . $_GET["category"] . '">' . getCategoryNameByID($_GET["category"]) . '</a></li>';
						?>
						<li class="bread-crumb bread-crumb_current"><?=$productName; ?></li>
					</ul>
				</nav>
				<section class="product">
					<h1 class="product__info-block-part product__headline"><?=$productName; ?></h1>
					<img class="product__image" src="<?=$img; ?>" alt="<?=$alt; ?>">
					<? if (is_null($price)) { ?>
						<span class="good-price good_price product__info-block-part product__info-price"><small class="good-price__currency">Цена не указана</small></span>
					<? } else { ?>
						<span class="good-price good_price product__info-block-part product__info-price"><?=$price; ?> <small class="good-price__currency">руб.</small></span>
					<? } ?>
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
						<h2>Описание товара <?=$productName; ?></h2>
						<?=$desc ? $desc : "<p>Описание отсутствует.</p>" ; ?>
					</article>
				</section>
			</main>
			<? require_once("inner/sidebar.php"); ?>
		</div>
	</div>
	<? require_once("inner/footer.php"); ?>
</body>
</html>