<?require_once("template/header.php")?>
<?
	// Если пришёл id новости, значит подобрать данные для вывода одной новости
	$id = !empty($_GET["id"]) ? validNaturalNumber($_GET["id"]) : NULL;
	// Взятие новости из БД (раньше было одной функцией)
	$title = "Каталог товаров - Company";
		
	$catId = !empty($_GET["category"]) ? validNaturalNumber($_GET["category"]) : NULL;
	$catName = NULL;
	if(false !== (array_search($catId, array_column($cats, "id"))))
		$catName = $cats[array_search($catId, array_column($cats, "id"))]["name"];
	// Валидация фильтра цены
	$maxCost = !empty($_GET["cost-to"]) ? validPositiveFloat($_GET["cost-to"]) : NULL;
	$minCost = !empty($_GET["cost-from"]) ? validPositiveFloat($_GET["cost-from"]) : NULL;
	// Сохраняем и текущую страницу при переходе от каталога к товару
	// Нужно знать, сколько всего страниц, для пагинатора и корректировки текущей страницы
	// Взятие максимального числа страниц из БД
	$sqlReq = "SELECT count(*) FROM goods ";
	$sqlReqWithCost = "price " . (is_null($maxCost) ? ">= $minCost " : (is_null($minCost) ? "<= $maxCost " : "BETWEEN $minCost AND $maxCost "));
	$sqlReqWithCats = 
		"INNER JOIN goodToCategories ON goods.id = goodToCategories.goodID
			WHERE categoryID = $catId ";
	if($catId)
		$sqlReq .= $sqlReqWithCats;
	if(!is_null($minCost) || !is_null($maxCost))
		$sqlReq .= ($catId ? "AND " : "WHERE ") . $sqlReqWithCost;
	$maxPage = ceil(mysqli_fetch_row(mysqli_query($db, $sqlReq))["0"] / MAX_GOODS_ON_PAGE);
	if($maxPage < 1)
		$maxPage = 1;
	$page = validNaturalNumber($_GET["page"]);
	if($page > $maxPage)
		$page = 1;
	// Создание ссылочной конструкции
	$linkWithCat = $catId ? "category=$catId" : "";
	$linkWithCosts = $minCost ? "cost-from=$minCost" : "";
	$linkWithCosts .= $maxCost ? ($linkWithCosts ? "&" : "") . "cost-to=$maxCost" : "";
	$subLink = $linkWithCat;
	$subLink .= ($subLink ? "&" : "") . $linkWithCosts;
	if (1 != $page)
		$subLink .= ($subLink ? "&" : "") . "page=$page";
	if($subLink)
		$subLink = '?' . $subLink;
	if(!is_null($maxCost) && $minCost > $maxCost)
		$maxCost = $minCost;

	// Перенаправление на страницу товара
	if ($id)
		header('Location: product.php' . ($subLink ? $subLink . '&' : '?') . "id=$id");
	// Если пришла категория, то фильтруем товары
	// Иначе выводим все подряд
	
	// Взятие товаров из БД (было одной функцией)
	// Запрос не сложный, но его конструирование - это сущий геморрой
	$offset = ($page - 1) * MAX_GOODS_ON_PAGE;
	$sqlReq = "SELECT id, name, price, img FROM goods ";
	if(is_null($catId)) {
		if(!is_null($minCost) || !is_null($maxCost))
			$sqlReq .= "WHERE " . $sqlReqWithCost;
		$sqlReq .= "LIMIT " . ($offset ? "$offset, " : "") . MAX_GOODS_ON_PAGE;
	} else {
		$sqlReq .= $sqlReqWithCats;
		if(!is_null($minCost) || !is_null($maxCost))
			$sqlReq .= "AND " . $sqlReqWithCost;
		$sqlReq .= "LIMIT $offset, " . MAX_GOODS_ON_PAGE;
	}
	$goods = mysqli_fetch_all(mysqli_query($db, $sqlReq), MYSQLI_ASSOC);
	
	echo changeTitle(ob_get_clean());
?>
<?if(!empty($goods)):?>
	<h1 class="invisible">Каталог товаров</h1>
	<nav class="bread-crumbs-container">
		<ul class="bread-crumbs">
			<li class="bread-crumb"><a class="bread-crumb__link" href="index.php">Главная</a></li>
			<?
				// Если определена категория
				if(!is_null($catId) && $catName) {
					echo '<li class="bread-crumb"><a class="bread-crumb__link" href="catalog.php' . ($linkWithCosts ? '?' . $linkWithCosts : '') . '">Каталог</a></li>';
					// Если просматривается продукт
					echo
						'<li class="bread-crumb">' .
							$catName .
						'</li>';
				}	else {
					echo '<li class="bread-crumb">Каталог</li>';
				}
			?>		
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
			<?
				$img = $item["img"] ? $item["img"] : "img/no-image.jpg";
				$alt = $item["img"] ? $img : "Изображение отсутствует";
			?>
			<li class="category good-piece">
				<a class="category__link" href="product.php<?=$subLink ? $subLink . '&id=' . $item["id"] : '?id=' . $item["id"]?>">
					<img class="category__image good__image" src="<?=$img?>" alt="<?=$alt?>">
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
	<?makePaginator(PAGINATOR_ELEMENTS, $page, $maxPage)?>
<?else:?>
	<?
		echo '<h1>Ошибка 404: товаров не найдено!</h1>';
		if($catId && !$catName)
			echo
				'<h2>Выбранной категории не существует :(</h2>
				<p>Возможно, вы попали сюда по ошибке. Попробуйте посмотреть
					<a href="catalog.php">все товары</a>.</p>';				
		else
			echo
				'<h2>Товаров с такими параметрами не найдено :(</h2>
				<p>Возможно, вы задали слишком строгие критерии фильтрации. Попробуйте 
					<a href="catalog.php">сбросить параметры</a> и поискать ещё раз.</p>';			
	?>
<?endif?>
<?require_once "template/footer.php"?>