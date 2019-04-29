<?require_once("template/header.php");?>
<?
	// Если пришёл id новости, значит подобрать данные для вывода одной новости
	$id = !empty($_GET["id"]) ? validNaturalNumber($_GET["id"]) : NULL;
	// Взятие новости из БД (раньше было одной функцией)
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
		$title = "Каталог товаров - Company";
	$catId = !empty($_GET["category"]) ? validNaturalNumber($_GET["category"]) : NULL;
	// Валидация фильтра цены
	$maxCost = !empty($_GET["cost-to"]) ? validPositiveFloat($_GET["cost-to"]) : NULL;
	$minCost = !empty($_GET["cost-from"]) ? validPositiveFloat($_GET["cost-from"]) : (is_null($maxCost) ? NULL : 0);
	if(!is_null($maxCost) && $minCost > $maxCost)
		$maxCost = $minCost;
	echo changeTitle(ob_get_clean());
?>
<?if(!empty($good)):?>
	<nav class="bread-crumbs-container product__bread-crumbs">
		<ul class="bread-crumbs">
			<li class="bread-crumb"><a class="bread-crumb__link" href="index.php">Главная</a></li>
			<li class="bread-crumb"><a class="bread-crumb__link" href="catalog.php">Каталог</a></li>
			<?
				// Чтобы лишний раз не лезть в БД, посмотрим, пришла ли категория и найдём её название в соотвествующем массиве
				if(!is_null($catId)) {
					echo
						'<li class="bread-crumb">
							<a class="bread-crumb__link" href="catalog.php?category=' . $catId . '">'
								. $cats[array_search($catId, array_column($cats, "id"))]["name"] . '
							</a>
						</li>';
				}
			?>
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
<?else:?>
	<h1 class="invisible">Каталог товаров</h1>
	<nav class="bread-crumbs-container">
		<ul class="bread-crumbs">
			<li class="bread-crumb"><a class="bread-crumb__link" href="index.php">Главная</a></li>
			<li class="bread-crumb bread-crumb_current">Каталог</li>
		</ul>
	</nav>
	<form class="search-filter" id="catalog-page__search-filter-1" action="catalog.php<?=$catId ? "?category=$catId" : ""?>" method="GET">
		<span class="search-filter__item">
			<label class="search-filter__label" for="cost-from">Цена</label>
			<input class="search-filter__input" step="0.01" type="number" min="0" name="cost-from" id="cost-from" placeholder="от" <?=is_null($minCost) ? '' : "value=\"$minCost\""?>>
		</span>
		<span class="search-filter__item">
			<label class="search-filter__label" for="cost-to">—</label>
			<input class="search-filter__input" step="0.01" type="number" min="0" name="cost-to" id="cost-to" placeholder="до" <?=is_null($maxCost) ? '' : "value=\"$maxCost\""?>>
		</span>
		<?=$catId ? '<input type="hidden" name="category" value="' . $catId. '">' : ''?>
		<input class="form-submit search-filter__apply" type="submit" value="Применить">
	</form>
	<ul class="categories categories__reposition">
		<?
			// Нужно знать, сколько всего страниц, для пагинатора и корректировки текущей страницы
			// Взятие максимального числа страниц из БД
			$sqlReq = "SELECT count(*) FROM goods ";
			$sqlReqWithCost = "price " . (is_null($maxCost) ? "> $minCost " : "BETWEEN $minCost AND $maxCost ");
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
			// Если пришла категория, то фильтруем товары
			// Иначе выводим все подряд
		
			// Взятие товаров из БД (было одной функцией)
			// Запрос не сложный, но его конструирование - это сущий геморрой
			$offset = ($page - 1) * MAX_GOODS_ON_PAGE;
			$sqlReq = "SELECT id, name, price, img FROM goods ";
			if(is_null($catId)) {
				if(!is_null($minCost) || !is_null($maxCost))
					$sqlReq .= "WHERE " . $sqlReqWithCost;
				$sqlReq .= "LIMIT $offset, " . MAX_GOODS_ON_PAGE;
			} else {
				$sqlReq .= $sqlReqWithCats;
				if(!is_null($minCost) || !is_null($maxCost))
					$sqlReq .= "AND " . $sqlReqWithCost;
				$sqlReq .= "LIMIT $offset, " . MAX_GOODS_ON_PAGE;
			}
			$goods = mysqli_fetch_all(mysqli_query($db, $sqlReq), MYSQLI_ASSOC);
		?>
		<?foreach ($goods as $item):?>
			<?
				$img = $item["img"] ? $item["img"] : "img/no-image.jpg";
				$alt = $item["img"] ? $img : "Изображение отсутствует";
			?>
			<li class="category good-piece">
				<a class="category__link" href="catalog.php?id=<?=$item["id"]?><?=is_null($catId) ? "" : "&category=" . $catId?>">
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
<?endif?>
<?require_once "template/sidebarAndFooter.php"?>