<?require_once "template/header.php";?>
<?echo changeTitle(ob_get_clean())?>
<h1 class="invisible">Company - Электронные сигареты</h1>
<ul class="categories">
	<?foreach($cats as $item):?>
		<li class="category">
			<a class="category__link" href="catalog.php?category=<?=$item["id"]?>">
				<img class="category__image" src="<?=$item["img"] ? $item["img"] : "img/no-image.jpg"?>" alt="<?=$item["img"] ? $img : "Изображение категории отсутствует"?>">
				<span class="category__name-container">
					<span class="category__name-template">
						<?=$item["name"]?>
					</span>
				</span>
			</a>
		</li>
	<?endforeach?>
</ul>
<?require_once("template/footer.php")?>