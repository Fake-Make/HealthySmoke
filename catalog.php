<?require_once("template/header.php")?>
<?
	// 1. ВАЛИДАЦИЯ
	// 1.1. КАТЕГОРИЯ
	$catId = !empty($_GET["category"]) ? validNaturalNumber($_GET["category"]) : NULL;
	$catName = 
		false !== ($catIndex = (array_search($catId, array_column($cats, "id")))) ?
			$cats[$catIndex]["name"] :
			NULL;
	// Если названия категории не нашлось, то категории с таким id нет
	if ($catId && !$catName)
		header("Location: 404.php");
	
	// 1.2. ФИЛЬТР ЦЕНЫ
	$maxCost = isset($_GET["cost-to"]) ? validPositiveFloat($_GET["cost-to"]) : NULL;
	$minCost = isset($_GET["cost-from"]) ? validPositiveFloat($_GET["cost-from"]) : NULL;
	if (!is_null($maxCost) && !is_null($minCost) && $minCost > $maxCost)
		$maxCost = $minCost;
	
	// 1.3. МАКСИМАЛЬНОЕ ЧИСЛО СТРАНИЦ
	// Конструируем основное тело запроса с учётом ограничений фильтра
	$sqlReq = "";
	// Учитываем категорию
	if ($catId)
		$sqlReq .=
			"INNER JOIN goodToCategories ON goods.id = goodToCategories.goodID
			WHERE categoryID = $catId ";
	// Учитываем цену
	if (!is_null($minCost) || !is_null($maxCost))
		$sqlReq .= ($catId ? "AND " : "WHERE ") . "price " .
		(is_null($maxCost) ? ">= $minCost " : (is_null($minCost) ? "<= $maxCost " : "BETWEEN $minCost AND $maxCost "));
	// Выполнение запроса
	$maxPage = ceil(mysqli_fetch_row(mysqli_query($db, "SELECT count(*) FROM goods " . $sqlReq))["0"] / MAX_GOODS_ON_PAGE);
	if ($maxPage < 1)
		$maxPage = 1;

	// 1.4. ТЕКУЩАЯ СТРАНИЦА
	$page = validNaturalNumber($_GET["page"]);
	if ($page > $maxPage)
		$page = 1;
	
	// 2. ПОСТРОЕНИЕ ЗАПРОСА
	// Пользуемся уже имеющимся телом запроса
	$offset = ($page - 1) * MAX_GOODS_ON_PAGE;
	$sqlReq = "SELECT id, name, price, img FROM goods " . $sqlReq .
	"LIMIT " . ($offset ? "$offset, " : "") . MAX_GOODS_ON_PAGE;
	$goods = mysqli_fetch_all(mysqli_query($db, $sqlReq), MYSQLI_ASSOC);

	// 3. ПОСТРОЕНИЕ ССЫЛОЧНОЙ КОНСТРУКЦИИ ДЛЯ СОХРАНЕНИЯ ФИЛЬТРОВ
	// Оформим параметры фильтра
	$linkWithCosts = $minCost ? "cost-from=$minCost" : "";
	$linkWithCosts .= $maxCost ? ($linkWithCosts ? "&" : "") . "cost-to=$maxCost" : "";
	// Затем перейдём к категории
	$subLink = $catId ? "category=$catId" : "";
	// Осталось правильно всё совместить
	$subLink .= ($subLink ? "&" : "") . $linkWithCosts;
	if (1 != $page)
		$subLink .= ($subLink ? "&" : "") . "page=$page";
	if ($subLink)
		$subLink = '?' . $subLink;

	// 4. ВЫВОД СТРАНИЦЫ
	$title = "Каталог товаров - Company";
	echo changeTitle(ob_get_clean());
?>
<?if (!empty($goods)):?>
	<h1 class="invisible">Каталог товаров</h1>
	<nav class="bread-crumbs-container">
		<ul class="bread-crumbs">
			<li class="bread-crumb"><a class="bread-crumb__link" href="index.php">Главная</a></li>
			<?if (!is_null($catId) && $catName):?>
				<li class="bread-crumb"><a class="bread-crumb__link" href="catalog.php">Каталог</a></li>
				<li class="bread-crumb"><?=$catName?></li>
			<?else:?>
				<li class="bread-crumb">Каталог</li>
			<?endif?>
		</ul>
	</nav>
	<form class="search-filter" id="catalog-page__search-filter-1" action="catalog.php" method="GET">
		<span class="search-filter__item">
			<label class="search-filter__label" for="cost-from">Цена</label>
			<input class="search-filter__input" step="0.01" type="number" min="0" name="cost-from" id="cost-from" placeholder="от" <?=is_null($minCost) ? '' : 'value="' . $minCost . '"'?>>
		</span>
		<span class="search-filter__item">
			<label class="search-filter__label" for="cost-to">—</label>
			<input class="search-filter__input" step="0.01" type="number" min="0" name="cost-to" id="cost-to" placeholder="до" <?=is_null($maxCost) ? '' : 'value="' . $maxCost . '"'?>>
		</span>
		<?=$catId ? '<input type="hidden" name="category" value="' . $catId. '">' : ''?>
		<input class="form-submit search-filter__apply" type="submit" value="Применить">
	</form>
	<ul class="categories categories__reposition">
		<?foreach ($goods as $item):?>
			<li class="category good-piece">
				<a class="category__link" href="product.php<?=$subLink ? $subLink . '&id=' . $item["id"] : '?id=' . $item["id"]?>">
					<img class="category__image good__image" src="<?=$item["img"] ? $item["img"] : "img/no-image.jpg"?>" alt="<?=$item["img"] ? $img : "Изображение отсутствует"?>">
					<span class="category__name-container good_name"><span class="category__name-template"><?=$item["name"]?></span></span>
				</a>
				<span class="good-price good_price">
					<?=$item["price"]?> <small class="good-price__currency">руб.</small>
				</span>
				<form method="POST">
					<input type="hidden" name="itemAmount" value="1">
					<input type="hidden" name="id" value="<?=$item["id"]?>">
					<button class="good-to-cart good_to-cart">в корзину</button>
				</form>
			</li>
		<?endforeach?>
	</ul>
	<?=makePaginator(PAGINATOR_ELEMENTS, $page, $maxPage)?>
<?else:?>
	<h1>Ошибка поиска!</h1>
	<h2>Товаров с такими параметрами не найдено :(</h2>
	<p>Возможно, вы задали слишком строгие критерии фильтрации. Попробуйте <a href="catalog.php<?=$catId ? "?category=$catId" : ""?>">сбросить параметры</a> и поискать ещё раз.</p>
<?endif?>
<?require_once("template/footer.php")?>