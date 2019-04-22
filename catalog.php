<?
	require_once("lib/db.php");
	// Если выборка будет пуста
	//if(!isset($_GET["id"]))
	//	header("Location: 404.php");
	if (isset($_GET["id"]) && !empty($good = getGood4Product($id = intval($_GET["id"])))) {
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
	$activePage = "Каталог";
	require_once("inner/meta.php");
?>
<body>
	<? require_once("inner/header.php"); ?>
	<div class="content">
		<div class="wrapper content__wrapper">
			<main class="inside-content">
				<? if(!empty($good)) { ?>
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
							$category = isset($_GET["category"]) ? $_GET["category"] : NULL;
							$maxPage = getMaxPage4Catalog(12, $category);
							$page = isset($_GET["page"]) ? intval($_GET["page"]) : 1;
							if ($page > $maxPage)
								$page = 1;
							// Тупа место для SQL-инъекции охуенное
							$cats = $category ? getGoods4Catalog($page, 12, $category) : getGoods4Catalog($page, 12);
							foreach ($cats as $item) {
								$id = $item["id"];
								$img = $item["img"] ? $item["img"] : "img/no-image.jpg";
								$alt = $item["img"] ? $img : "Изображение отсутствует";
								$name = $item["name"];
								$price = $item["price"];
						?>
						<li class="category good-piece">
							<a class="category__link" href="catalog.php?id=<?=$id; ?><?=isset($_GET["category"]) ? "&category=" . $_GET["category"] : ""; ?>">
								<img class="category__image good__image" src="<?=$img; ?>" alt="<?=$alt; ?>">
								<span class="category__name-container good_name"><span class="category__name-inner"><?=$name; ?></span></span>
							</a>
							<span class="good-price good_price">
								<? if (is_null($price)) { ?>
									<small class="good-price__currency">Цена не указана</small>
								<? } else { ?>
									<?=$price; ?> <small class="good-price__currency">руб.</small>
								<? } ?>
							</span>
							<form method="POST">
								<input type="hidden" name="itemAmount" value="1">
								<input type="hidden" name="id" value="<?=$id; ?>">
								<button class="good-to-cart good_to-cart">в корзину</button>
							</form>
						</li>
						<? 
							}
						?>
					</ul>
					<? makePaginator(7, intval($_GET["page"]) ? intval($_GET["page"]) : 1, $maxPage); ?>
				<? } ?>
			</main>
			<? require_once("inner/sidebar.php"); ?>
		</div>
	</div>
	<? require_once("inner/footer.php"); ?>
</body>

</html>