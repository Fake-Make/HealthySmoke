<div class="sidebar">
	<section class="catalog">
		<h2 class="sidebar__headline">Каталог</h2>
		<ul class="catalog-list">
			<?
				foreach ($cats as $item) {
					$SBCatName = $item["name"];
					$SBCatId = $item["id"];
			?>
				<? if (isset($_GET["category"]) && $_GET["category"] === $SBCatId) { ?>
					<li class="catalog-list__item catalog-list__item_active">					
						<span class="catalog-list__link"><?=$SBCatName?></a>
					</li>
				<? } else { ?>
					<li class="catalog-list__item">
						<a class="catalog-list__link" href="catalog.php?category=<?=$SBCatId?>"><?=$SBCatName?></a>
					</li>
			<?
				} }
			?>
		</ul>
	</section>
	<section class="news">
		<h2 class="sidebar__headline news__headline">Новости</h2>
		<ul class="news-list">
			<?
				$news = getNewsByPages($maxNewsAtSidebar);
				foreach ($news as $item) {
			?>
			<li class="news-item">
				<a class="news-item__link" href="#">
					<?=$item["anounce"]; ?>
				</a>
				<span class="news-item__date"><?=$item["dt"]?></span>
			</li>
			<?
				}
			?>
		</ul>
		<span class="archive"><a class="archive__link" href="news.php">Архив новостей</a></span>
	</section>
</div>