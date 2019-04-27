<?require_once "template/header.php";?>
<?
	$activePage = "Главная";
	// Вместо использования callback-функции для буфера
	// производим подстановку сразу после инициализации требуемых переменных
	// Таким образом str_replace будет работать с меньшим объёмом информации
	echo applyChanges(ob_get_clean());
?>
<h1 class="invisible">Company - Электронные сигареты</h1>
<ul class="categories">
	<?
		// Категории уже получены в конфиге
		// Было нужно для меню
		foreach ($cats as $item) {
			$id = $item["id"];
			$img = $item["img"] ? $item["img"] : "img/no-image.jpg";
			$alt = $item["img"] ? $img : "Изображение категории отсутствует";
			// Правильность табуляции на строках 10-25 вызывает сомнения
	?>
		<li class="category">
			<a class="category__link" href="catalog.php?category=<?=$item["id"]?>">
				<img class="category__image" src="<?=$img?>" alt="<?=$alt?>">
				<span class="category__name-container"><span class="category__name-template"><?=$item["name"]?></span></span>
			</a>
		</li>
	<?}?>
</ul>
<?require_once "template/sidebarAndFooter.php"?>