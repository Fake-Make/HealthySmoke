<? require_once("inner/header.php"); ?>
	<?
		if (isset($_GET["id"]) && !empty($good = getGood4Product($id = validNaturalNumber($_GET["id"])))) {
			$good = $good["0"];
			$img = $good["img"] ? $good["img"] : "img/no-image.jpg";
			$alt = $good["img"] ? $img : "Изображение отсутствует";
			$productName = $good["name"];
			$price = $good["price"];
			$desc = $good["description"];
			// Взять название и цену товара
			$title = "$productName — купить за $price руб. в интернет-магазине Company";
		}	else
			$title = "Каталог товаров - Company";
		$catId = isset($_GET["category"]) ? validNaturalNumber($_GET["category"]) : NULL;
		$activePage = "Каталог";
		echo applyChanges(ob_get_clean());
	?>
				<? if(!empty($good)) { ?>
					<nav class="bread-crumbs-container product__bread-crumbs">
						<ul class="bread-crumbs">
							<li class="bread-crumb"><a class="bread-crumb__link" href="index.php">Главная</a></li>
							<li class="bread-crumb"><a class="bread-crumb__link" href="catalog.php">Каталог</a></li>
							<?
								// Чтобы лишний раз не лезть в БД
								if (!is_null($catId)) {
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
						<? if (is_null($price)) { ?>
							<span class="good-price good_price product__info-block-part product__info-price"><small class="good-price__currency">Цена не указана</small></span>
						<? } else { ?>
							<span class="good-price good_price product__info-block-part product__info-price"><?=$price?> <small class="good-price__currency">руб.</small></span>
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
							<h2>Описание товара <?=$productName?></h2>
							<?=$desc ? $desc : "<p>Описание отсутствует.</p>"?>
						</article>
					</section>
				<? } else { ?>
					<h1 class="invisible">Каталог товаров</h1>
					<nav class="bread-crumbs-container">
						<ul class="bread-crumbs">
							<li class="bread-crumb"><a class="bread-crumb__link" href="index.php">Главная</a></li>
							<li class="bread-crumb bread-crumb_current">Каталог</li>
						</ul>
					</nav>
					<form class="search-filter" id="catalog-page__search-filter-1" method="POST">
						<span class="search-filter__item">
							<label class="search-filter__label" for="cost-from">Цена</label>
							<input class="search-filter__input" step="0.01" type="number" min="0" name="cost-from" id="cost-from" placeholder="от">
						</span>
						<span class="search-filter__item">
							<label class="search-filter__label" for="cost-to">—</label>
							<input class="search-filter__input" type="number" min="0" name="cost-to" id="cost-to" placeholder="до">
						</span>
						<input class="form-submit search-filter__apply" type="submit" value="Применить">
					</form>
					<ul class="categories categories__reposition">
						<?
							// Сюда нужен отряд валидашек
							// Геты вообще пидоры, хер знает, где их носило
							// Лучше лишний раз провериться и предохраниться
							$maxPage = getMaxPage4Catalog($maxGoodsOnPage, $catId);
							$page = validNaturalNumber($_GET["page"]);
							if ($page > $maxPage)
								$page = 1;
							$goods = is_null($catId) ? getGoods4Catalog($page, $maxGoodsOnPage) : getGoods4Catalog($page, $maxGoodsOnPage, $catId);
							foreach ($goods as $item) {
								$id = $item["id"];
								$img = $item["img"] ? $item["img"] : "img/no-image.jpg";
								$alt = $item["img"] ? $img : "Изображение отсутствует";
								$name = $item["name"];
								$price = $item["price"];
						?>
						<li class="category good-piece">
							<a class="category__link" href="catalog.php?id=<?=$id?><?=is_null($catId) ? "" : "&category=" . $catId?>">
								<img class="category__image good__image" src="<?=$img?>" alt="<?=$alt?>">
								<span class="category__name-container good_name"><span class="category__name-inner"><?=$name?></span></span>
							</a>
							<span class="good-price good_price">
								<?=$price?> <small class="good-price__currency">руб.</small>
							</span>
							<form method="POST">
								<input type="hidden" name="itemAmount" value="1">
								<input type="hidden" name="id" value="<?=$id?>">
								<button class="good-to-cart good_to-cart">в корзину</button>
							</form>
						</li>
						<? 
							}
						?>
					</ul>
					<? makePaginator($paginatorElements, $page, $maxPage); ?>
				<? } ?>
<? require_once("inner/sidebar.php"); ?>
<? require_once("inner/footer.php"); ?>