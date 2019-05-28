<?require_once("template/header.php")?>
<?
	// 1. ВАЛИДАЦИЯ
	// 1.1. КАТЕГОРИЯ
	$catId = isset($_GET["category"]) ? validNaturalNumber($_GET["category"]) : NULL;
	// Если категория пришла, но не существует
	if ($catId && false === array_search($catId, array_column($cats, "id")))
		header("Location: 404.php");

	// 1.2. ID ТОВАРА
	$id = isset($_GET["id"]) ? validNaturalNumber($_GET["id"]) : NULL;
	// Если не пришёл id товара
	if (is_null($id))
		header("Location: 404.php");

	// 2. ПОСТРОЕНИЕ ЗАПРОСА ДАННЫХ
	// Если категория не пришла, потребуется основная категория товара
	$sqlReq = "SELECT id, name, price, description, img" . (is_null($catId) ? ", mainCategoryID " : " ") . "from goods ";
	// Если категория пришла, то нужно убедиться, что товар принадлежит этой категории
	if (!is_null($catId))
		$sqlReq .= "INNER JOIN goodToCategories ON goods.id = goodToCategories.goodID ";
	$sqlReq .= "WHERE id=$id" . 
		(!is_null($catId) ? " AND categoryID=$catId" : "");
	
	if (!is_null($catId))
		$sqlReq .= " AND categoryID=$catId";
	$good = mysqli_fetch_assoc(mysqli_query($db, $sqlReq));

	// Если результат пуст
	if(empty($good))
			header("Location: 404.php");
	// Получение данных
	$img = $good["img"] ? $good["img"] : "img/no-image.jpg";
	$alt = $good["img"] ? $img : "Изображение отсутствует";
	$productName = $good["name"];
	$price = $good["price"];
	$desc = $good["description"];
	if (is_null($catId))
		$catMainId = $good["mainCategoryID"];

	// 1.3. ФИЛЬТРЫ ЦЕНЫ
	$minCost = isset($_GET["cost-from"]) ? validPositiveFloat($_GET["cost-from"]) : NULL;
	$maxCost = isset($_GET["cost-to"]) ? validPositiveFloat($_GET["cost-to"]) : NULL;
	// 1.4. СТРАНИЦА
	$page = isset($_GET["page"]) ? validNaturalNumber($_GET["page"]) : NULL;

	// 3. ПОСТРОЕНИЕ ССЫЛОЧНОЙ КОНСТРУКЦИИ $subLink ДЛЯ СОХРАНЕНИЯ ФИЛЬТРОВ
	// Сначала соберём параметры: категорию и цены
	$linkWithCat = "category=" . ($catId ? $catId : $catMainId);
	$linkWithCosts = $minCost ? "cost-from=$minCost" : "";
	$linkWithCosts .= $maxCost ? ($linkWithCosts ? "&" : "") . "cost-to=$maxCost" : "";
	// Теперь нужно склеить всё правильны образом
	$subLink = $linkWithCosts;
	if ($page && 1 != $page)
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
	<img class="product__image" src="<?=$img?>" alt="<?=$good["img"] ? $good["img"] : "Изображение отсутствует";?>">
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