<?
	$title = "Каталог товаров - Company";
	$activePage = "Каталог";
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
					<li class="category good-piece">
						<a class="category__link" href="product.php">
							<img class="category__image good__image" src="img/category-1.jpg" alt="category-image-1">
							<span class="category__name-container good_name"><span class="category__name-inner">Электронная сигарета FD12</span></span>
						</a>
						<span class="good-price good_price">820 <small class="good-price__currency">руб.</small></span>
						<form method="POST">
							<input type="hidden" name="itemAmount" value="1">
							<input type="hidden" name="id" value="100000_0">
							<button class="good-to-cart good_to-cart">в корзину</button>
						</form>
					</li>
					<li class="category good-piece">
						<a class="category__link" href="#">
							<img class="category__image good__image" src="img/category-2.jpg" alt="category-image-2">
							<span class="category__name-container good_name"><span class="category__name-inner">Трубка из дерева</span></span>
						</a>
						<span class="good-price good_price">760 <small class="good-price__currency">руб.</small></span>
						<form method="POST">
							<input type="hidden" name="itemAmount" value="1">
							<input type="hidden" name="id" value="100000_1">
							<button class="good-to-cart good_to-cart">в корзину</button>
						</form>
					</li>
					<li class="category good-piece">
						<a class="category__link" href="#">
							<img class="category__image good__image" src="img/category-3.jpg" alt="category-image-3">
							<span class="category__name-container good_name"><span class="category__name-inner">Жидкость для заправки</span></span>
						</a>
						<span class="good-price good_price">59 <small class="good-price__currency">руб.</small></span>
						<form method="POST">
							<input type="hidden" name="itemAmount" value="1">
							<input type="hidden" name="id" value="100000_2">
							<button class="good-to-cart good_to-cart">в корзину</button>
						</form>
					</li>
					<li class="category good-piece">
						<a class="category__link" href="#">
							<img class="category__image good__image" src="img/category-4.jpg" alt="category-image-4">
							<span class="category__name-container good_name"><span class="category__name-inner">Аккумулятор TY132</span></span>
						</a>
						<span class="good-price good_price">820 <small class="good-price__currency">руб.</small></span>
						<form method="POST">
							<input type="hidden" name="itemAmount" value="1">
							<input type="hidden" name="id" value="100000_3">
							<button class="good-to-cart good_to-cart">в корзину</button>
						</form>
					</li>
					<li class="category good-piece">
						<a class="category__link" href="#">
							<img class="category__image good__image" src="img/category-none.jpg" alt="category-image-none">
							<span class="category__name-container good_name"><span class="category__name-inner">Картридж FG876</span></span>
						</a>
						<span class="good-price good_price">760 <small class="good-price__currency">руб.</small></span>
						<form method="POST">
							<input type="hidden" name="itemAmount" value="1">
							<input type="hidden" name="id" value="100000_4">
							<button class="good-to-cart good_to-cart">в корзину</button>
						</form>
					</li>
					<li class="category good-piece">
						<a class="category__link" href="#">
							<img class="category__image good__image" src="img/category-6.jpg" alt="category-image-6">
							<span class="category__name-container good_name"><span class="category__name-inner">Зарядное устройство</span></span>
						</a>
						<span class="good-price good_price">59 <small class="good-price__currency">руб.</small></span>
						<form method="POST">
							<input type="hidden" name="itemAmount" value="1">
							<input type="hidden" name="id" value="100000_5">
							<button class="good-to-cart good_to-cart">в корзину</button>
						</form>
					</li>
					<li class="category good-piece">
						<a class="category__link" href="#">
							<img class="category__image good__image" src="img/category-7.jpg" alt="category-image-7">
							<span class="category__name-container good_name"><span class="category__name-inner">Аксессуар</span></span>
						</a>
						<span class="good-price good_price">820 <small class="good-price__currency">руб.</small></span>
						<form method="POST">
							<input type="hidden" name="itemAmount" value="1">
							<input type="hidden" name="id" value="100000_6">
							<button class="good-to-cart good_to-cart">в корзину</button>
						</form>
					</li>
					<li class="category good-piece">
						<a class="category__link" href="#">
							<img class="category__image good__image" src="img/category-8.jpg" alt="category-image-8">
							<span class="category__name-container good_name"><span class="category__name-inner">Подарочный набор</span></span>
						</a>
						<span class="good-price good_price">760 <small class="good-price__currency">руб.</small></span>
						<form method="POST">
							<input type="hidden" name="itemAmount" value="1">
							<input type="hidden" name="id" value="100000_7">
							<button class="good-to-cart good_to-cart">в корзину</button>
						</form>
					</li>
				</ul>
				<ul class="paginator catalog-page__paginator">
					<li class="paginator__elem"><a href="#" class="paginator__link">1</a></li>
					<li class="paginator__elem"><a href="#" class="paginator__link">2</a></li>
					<li class="paginator__elem"><a href="#" class="paginator__link">3</a></li>
					<li class="paginator__elem paginator__elem_current"><span class="paginator__link">4</span></li>
					<li class="paginator__elem"><a href="#" class="paginator__link">5</a></li>
					<li class="paginator__elem"><a href="#" class="paginator__link">6</a></li>
					<li class="paginator__elem"><a href="#" class="paginator__link">7</a></li>
					<li class="paginator__elem paginator__elem_next"><a href="#" class="paginator__link">Следующая страница</a></li>
				</ul>
			</main>
			<? require_once("inner/sidebar.php"); ?>
		</div>
	</div>
	<? require_once("inner/footer.php"); ?>
</body>

</html>