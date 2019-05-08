<?require_once("template/header.php")?>
<?
	// Если пришёл id, значит подобрать данные для вывода одного товара
	$id = !empty($_GET["id"]) ? validNaturalNumber($_GET["id"]) : NULL;
	// Взятие товара из БД (раньше было одной функцией)
	if ($id)
		$good = mysqli_fetch_assoc(mysqli_query($db, "SELECT id, name, price, description, img, mainCategoryID from goods WHERE id=$id"));
	if(!empty($good)) {
		$img = $good["img"] ? $good["img"] : "img/no-image.jpg";
		$alt = $good["img"] ? $img : "Изображение отсутствует";
		$productName = $good["name"];
		$price = $good["price"];
		$desc = $good["description"];
		$catMainId = $good["mainCategoryID"];
		// Взять название и цену товара
		$title = "$productName — купить за $price руб. в интернет-магазине Company";
	}	else
		$title = "Товар не найден - Company";
	// Как и было предложено: на странице продукта валидируется только id
	$catId = $_GET["category"];
	$maxCost = $_GET["cost-to"];
	$minCost = $_GET["cost-from"];
	// Создание ссылочной конструкции
	$page = $_GET["page"];
	$linkWithCat = $catId ? "category=$catId" : "category=$catMainId";
	$linkWithCosts = $minCost ? "cost-from=$minCost" : "";
	$linkWithCosts .= $maxCost ? ($linkWithCosts ? "&" : "") . "cost-to=$maxCost" : "";
	$subLink = $linkWithCosts;
	if (1 != $page)
		$subLink .= ($subLink ? "&" : "") . "page=$page";
	if($subLink)
		$subLink = '?' . $subLink;
	// Создание альтернативной ссылки с категорией
	$subLinkWithCat = $subLink;
	if ($linkWithCat)
		$subLinkWithCat .= ($subLinkWithCat ? "&" : "?") . $linkWithCat;
	echo changeTitle(ob_get_clean());
?>
<?
	if($productName)
		echo '<h1 class="invisible">' . $productName . ' - купить онлайн в интернет-магазине Company</h1>';
	else
		echo '<h1>Товар не найден :(</h1>';
?>
<?if($productName):?>
	<nav class="bread-crumbs-container">
		<ul class="bread-crumbs">
			<li class="bread-crumb"><a class="bread-crumb__link" href="index.php">Главная</a></li>
			<li class="bread-crumb">
				<a class="bread-crumb__link" href="catalog.php<?=$subLink?>">
					Каталог
				</a>
			</li>
			<li class="bread-crumb">
				<a class="bread-crumb__link" href="catalog.php<?=$subLinkWithCat?>">
					<?=$catId ? $cats[array_search($catId, array_column($cats, "id"))]["name"] : $cats[array_search($catMainId, array_column($cats, "id"))]["name"]?>
				</a>
			</li>
			<li class="bread-crumb bread-crumb_current"><?=$productName?></li>;
		</ul>
	</nav>
<?endif?>
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
	<h2>Попробуйте вернуться на страницу
		<a href="catalog.php<?=$subLink?>">каталога</a>.
	</h2>
<?endif?>
<?require_once "template/footer.php"?>