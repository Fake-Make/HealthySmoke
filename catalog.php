<?
	$title = "Каталог товаров - Company";
	$activePage = "Каталог";
	require_once("lib/db.php");
	require_once("inner/meta.php");
?>
<body>
	<? require_once("inner/header.php"); ?>
	<div class="content">
		<div class="wrapper content__wrapper">
			<main class="inside-content">
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
						$page = isset($_GET["page"]) ? $_GET["page"] : 1;
						$category = isset($_GET["category"]) ? $_GET["category"] : 0;
						$cats = $category ? getGoods4Catalog($page, 12, $category) : getGoods4Catalog($page, 12);
						foreach ($cats as $item) {
							$id = $item["id"];
							$img = $item["img"] ? $item["img"] : "img/no-image.jpg";
							$alt = $item["img"] ? $img : "Изображение отсутствует";
							$name = $item["name"];
							$price = $item["price"];
					?>
					<li class="category good-piece">
						<a class="category__link" href="product.php?id=<?=$id; ?><?=isset($_GET["category"]) ? "&category=" . $_GET["category"] : ""; ?>">
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
				<? makePaginator(7, intval($_GET["page"]) ? intval($_GET["page"]) : 1, 2); ?>
			</main>
			<? require_once("inner/sidebar.php"); ?>
		</div>
	</div>
	<? require_once("inner/footer.php"); ?>
</body>

</html>