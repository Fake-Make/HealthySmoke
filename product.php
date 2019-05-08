<?require_once("template/header.php")?>
<?
	// Если пришёл id, значит подобрать данные для вывода одного товара
	$id = !empty($_GET["id"]) ? validNaturalNumber($_GET["id"]) : NULL;
	// Взятие товара из БД (раньше было одной функцией)
	if ($id)
		$good = mysqli_fetch_assoc(mysqli_query($db, "SELECT id, name, price, description, img from goods WHERE id=$id"));
	if(!empty($good)) {
		$img = $good["img"] ? $good["img"] : "img/no-image.jpg";
		$alt = $good["img"] ? $img : "Изображение отсутствует";
		$productName = $good["name"];
		$price = $good["price"];
		$desc = $good["description"];
		// Взять название и цену товара
		$title = "$productName — купить за $price руб. в интернет-магазине Company";
	}	else
		$title = "Товар не найден - Company";
	$catId = !empty($_GET["category"]) ? validNaturalNumber($_GET["category"]) : NULL;
	// Валидация фильтра цены
	$maxCost = !empty($_GET["cost-to"]) ? validPositiveFloat($_GET["cost-to"]) : NULL;
	$minCost = !empty($_GET["cost-from"]) ? validPositiveFloat($_GET["cost-from"]) : NULL;
	// Создание ссылочной конструкции
	$linkWithCat = $catId ? "category=$catId" : "";
	$linkWithCosts = $minCost ? "cost-from=$minCost" : "";
	$linkWithCosts .= $maxCost ? ($linkWithCosts ? "&" : "") . "cost-to=$maxCost" : "";
	$subLink = $linkWithCat ? $linkWithCat . ($linkWithCosts ? "&" . $linkWithCosts : "") : $linkWithCosts;
	if($subLink)
		$subLink = '?' . $subLink;
	if(!is_null($maxCost) && $minCost > $maxCost)
		$maxCost = $minCost;
	echo changeTitle(ob_get_clean());
?>
<?
	if($productName)
		echo '<h1 class="invisible">' . $productName . ' - купить онлайн в интернет-магазине Company</h1>';
	else
		echo '<h1 class="invisible">Товар не найден</h1>';
?>
<nav class="bread-crumbs-container">
	<ul class="bread-crumbs">
		<li class="bread-crumb"><a class="bread-crumb__link" href="index.php">Главная</a></li>
		<?
			echo
				'<li class="bread-crumb">
					<a class="bread-crumb__link" href="catalog.php' . ($linkWithCosts ? '?' . $linkWithCosts : '') . '">
						Каталог
					</a>
				</li>';
			// Если определена категория
			if($catId) {
				echo
					'<li class="bread-crumb">
						<a class="bread-crumb__link" href="catalog.php' . $subLink . '">'
							. $cats[array_search($catId, array_column($cats, "id"))]["name"] . '
						</a>
					</li>';
			}
			echo '<li class="bread-crumb bread-crumb_current">' . ($productName ? $productName : "Товар не найден") . '</li>';
		?>		
	</ul>
</nav>
<?if(!empty($good)):?>
	<section class="product">
		<h1 class="product__info-block-part product__headline"><?=$productName?></h1>
		<img class="product__image" src="<?=$img?>" alt="<?=$alt?>">
		<span class="good-price good_price product__info-block-part product__info-price"><?=$price?> <small class="good-price__currency">руб.</small></span>
		<form class="product__info-block-part product__form" name="product-page__product-to-cart-form" method="POST">
			<span class="amount-tubmler product__amount-tumbler">
				<button type="button" class="amount-tumbler__button amount-tumbler__button_left"></button>
				<input type="number" class="search-filter__input products-amount__input" min="1" value="1">
				<button type="button" class="amount-tumbler__button amount-tumbler__button_right"></button>
			</span>
			<button class="good-to-cart good_to-cart product__good_to-cart" value="Электронная сигарета «Такая-то»">Добавить в корзину</button>
		</form>
		<article class="product__description">
			<h2>Описание товара <?=$productName?></h2>
			<?=$desc ? $desc : "<p>Описание отсутствует.</p>"?>
		</article>
	</section>
<?else:?>
	<h2>Товар не найден. Попробуйте вернуться на страницу
		<a href="catalog.php<?=$subLink?>">каталога</a>.
	</h2>
<?endif?>
<?require_once "template/footer.php"?>