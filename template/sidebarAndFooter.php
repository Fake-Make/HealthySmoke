		</main>
		<div class="sidebar">
			<section class="catalog">
				<h2 class="sidebar__headline">Каталог</h2>
				<ul class="catalog-list">
					<?
						foreach ($cats as $item) {
							$SBCatName = $item["name"];
							$SBCatId = $item["id"];
					?>
						<?if(!is_null($catId) && $catId == $SBCatId) {?>
							<li class="catalog-list__item catalog-list__item_active">					
								<span class="catalog-list__link"><?=$SBCatName?></a>
							</li>
						<?} else {?>
							<li class="catalog-list__item">
								<a class="catalog-list__link" href="catalog.php?category=<?=$SBCatId?>"><?=$SBCatName?></a>
							</li>
						<?
							}
						}
					?>
				</ul>
			</section>
			<section class="news">
				<h2 class="sidebar__headline news__headline">Новости</h2>
				<ul class="news-list">
					<?
						$news = getNewsByPages(MAX_NEWS_ON_SIDEBAR);
						foreach ($news as $item) {
					?>
					<li class="news-item">
						<a class="news-item__link" href="#">
							<?=$item["anounce"]; ?>
						</a>
						<span class="news-item__date"><?=$item["dt"]?></span>
					</li>
					<?}?>
				</ul>
				<span class="archive"><a class="archive__link" href="news.php">Архив новостей</a></span>
			</section>
		</div>
		<?
			if ($handle = opendir(INCLUDE_AREAS_PATH)) {
				while ($entry = readdir($handle)) {
					// Если запись в директории - это файл
					// И в нём содержится название вставляемого файла
					// То инклюдим
					if(is_file(INCLUDE_AREAS_PATH . $entry) && false !== strpos($_SERVER["SCRIPT_NAME"], str_replace("_include.php", "", $entry))) {
						include(INCLUDE_AREAS_PATH . $entry);
					}
				}
				closedir($handle);
			}
		?>
	</div>
</div>
<footer class="page-footer">
	<div class="wrapper page-footer__wrapper">
		<div class="copyright">
			<span class="copyright__part copyright__lifetime">Copyright ©2007-<?=date("Y", time())?></span>
			<span class="copyright__part copyright__company-lifetime"><b>© "Company"</b>, <?=date("Y", time())?></span>
			<?if("Главная" !== $activePage) echo '<a class="footer-logo__link" href="index.php">';?>
				<img class="copyright__image" src="img/logo.png" alt="Company-logo">
				<span class="copyright__part copyrhigt__company-name">Company</span>
			<?if("Главная" !== $activePage) echo '</a>';?>	
		</div>
		<nav class="footer-nav">
			<ul class="footer-nav__list">
				<?
					foreach ($menu as $item) {
						$menuItemName = $item["name"];
						$menuItemHref = $item["href"];
				?>
				<li class="footer-nav__list-item">
					<?
						if($activePage === $item["name"])
							echo "<span class='footer-nav__link'>$menuItemName</span>";
						else
							echo "<a class='footer-nav__link' href='$menuItemHref'>$menuItemName</a>";
					?>
				</li>
				<?}?>
			</ul>
		</nav>
		<div class="developer">
			<span class="developer__ref">Разработка сайта - <a class="developer__link" href="http://itconstruct.ru">ITConstruct</a></span>
			<img class="counter" src="img/counter.png" alt="Page-counter">
		</div>
	</div>
</footer>
<?mysqli_close($db);?>
</body>
</html>