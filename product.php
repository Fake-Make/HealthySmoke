<?require_once("template/header.php")?>
<?
	// 1. ВАЛИДАЦИЯ
	// NB! Как и было предложено, на странице продукта валидируется только id
	if ($id = !empty($_GET["id"]) ? validNaturalNumber($_GET["id"]) : NULL) {
		// 2. ПОСТРОЕНИЕ ЗАПРОСА
		$good = mysqli_fetch_assoc(mysqli_query($db, "SELECT id, name, price, description, img, mainCategoryID from goods WHERE id=$id"));
		// Ну вот как он такой сюда пришёл? Гоните его, презирайте его, насмехайтесь над ним
		if(empty($good))
			header("Location: 404.php");
		// Всё хорошо, работаем в штатном режиме
		$img = $good["img"] ? $good["img"] : "img/no-image.jpg";
		$alt = $good["img"] ? $img : "Изображение отсутствует";
		$productName = $good["name"];
		$price = $good["price"];
		$desc = $good["description"];
		// У товаров есть основная категория. Она нужна, если мы пришли из общего поиска
		$catMainId = $good["mainCategoryID"];
	}	else
		header("Location: 404.php");
	
	// Что не пришло - будет NULL, даже если не инициализировать переменные
	$minCost = $_GET["cost-from"];
	$maxCost = $_GET["cost-to"];
	$catId = $_GET["category"];
	$page = $_GET["page"];

	// 3. ПОСТРОЕНИЕ ССЫЛКИ $subLink для сохранения фильтров
	// Сначала соберём параметры: категорию и цены
	$linkWithCat = "category=" . ($catId ? $catId : $catMainId);
	$linkWithCosts = $minCost ? "cost-from=$minCost" : "";
	$linkWithCosts .= $maxCost ? ($linkWithCosts ? "&" : "") . "cost-to=$maxCost" : "";
	// Теперь нужно склеить всё правильны образом
	$subLink = $linkWithCosts;
	if (1 != $page)
		$subLink .= ($subLink ? "&" : "") . "page=$page";
	if($subLink)
		$subLink = '?' . $subLink;
	// Создание альтернативной ссылки с категорией
	$subLinkWithCat = $subLink;
	if ($linkWithCat)
		$subLinkWithCat .= ($subLinkWithCat ? "&" : "?") . $linkWithCat;

	// 4. ВЫВОД СТРАНИЦЫ
	$title = "$productName — купить за $price руб. в интернет-магазине Company";
	echo changeTitle(ob_get_clean());
?>
<h1 class="invisible"><?="$productName - купить онлайн в интернет-магазине Company"?></h1>
<nav class="bread-crumbs-container">
	<ul class="bread-crumbs">
		<li class="bread-crumb"><a class="bread-crumb__link" href="index.php">Главная</a></li>
		<li class="bread-crumb"><a class="bread-crumb__link" href="catalog.php<?=$subLink?>">Каталог</a></li>
		<li class="bread-crumb">
			<a class="bread-crumb__link" href="catalog.php<?=$subLinkWithCat?>">
				<?=$catId ?
					$cats[array_search($catId, array_column($cats, "id"))]["name"] :
					$cats[array_search($catMainId, array_column($cats, "id"))]["name"]?>
			</a>
		</li>
		<li class="bread-crumb bread-crumb_current"><?=$productName?></li>
	</ul>
</nav>
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
<?require_once("template/footer.php")?>