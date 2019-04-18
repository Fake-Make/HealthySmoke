<!--Файл, содержащий блок сайдбара для всех страниц сайта-->
<? require_once("./lib/db.php"); ?>
<div class="sidebar">
	<section class="catalog">
		<h2 class="sidebar__headline">Каталог</h2>
		<ul class="catalog-list">
			<?
				$cats = getCat4Sidebar();
				foreach ($cats as $item) {
			?>
			<li class="catalog-list__item"><a class="catalog-list__link" href="#"><?=$item["name"]; ?></a></li>
			<?
				}
			?>
		</ul>
	</section>
	<section class="news">
		<h2 class="sidebar__headline news__headline">Новости</h2>
		<ul class="news-list">
			<?
				$news = getNews4Sidebar();
				foreach ($news as $item) {
			?>
			<li class="news-item">
				<a class="news-item__link" href="#">
					<?=$item["anounce"]; ?>
				</a>
				<span class="news-item__date"><?=$item["dt"]; ?></span>
			</li>
			<?
				}
			?>
		</ul>
		<span class="archive"><a class="archive__link" href="#">Архив новостей</a></span>
	</section>
</div>