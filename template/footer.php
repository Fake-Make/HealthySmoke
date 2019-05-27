		</main>
		<div class="sidebar">
			<section class="catalog">
				<h2 class="sidebar__headline">Каталог</h2>
				<ul class="catalog-list">
					<?
						// Вывод категорий в сайдбаре
						foreach($cats as $item):
							$SBCatName = $item["name"];
							$SBCatId = $item["id"];
							// Если активная категория является текущей
							if($catId == $SBCatId) {
								echo
									'<li class="catalog-list__item catalog-list__item_active">
										<span class="catalog-list__link">' . $SBCatName . '</a>
									</li>';
							} else {
								echo
									'<li class="catalog-list__item">
										<a class="catalog-list__link" href="catalog.php?category=' . $SBCatId .
											(isset($minCost) && !is_null($minCost) ? '&cost-from=' . $minCost : '') .
											(isset($maxCost) && !is_null($maxCost) ? '&cost-to=' . $maxCost : '') .
										'">' . $SBCatName . '</a>
									</li>';
							}
						endforeach;
					?>
				</ul>
			</section>
			<section class="news">
				<h2 class="sidebar__headline news__headline">Новости</h2>
				<ul class="news-list">
					<?
						// Можно было взять новости и header'е, но мы бы делали лишнюю работу
						// при возникновении ошибок до загрузки footer'а
						$sqlReq = "SELECT id, anounce, dt FROM news ORDER BY dt DESC LIMIT " . MAX_NEWS_ON_SIDEBAR;
						$news = mysqli_fetch_all(mysqli_query($db, $sqlReq), MYSQLI_ASSOC);
					?>
					<?foreach($news as $item):?>
						<li class="news-item">
							<a class="news-item__link" href="news.php?id=<?=$item["id"]?>">
								<?=$item["anounce"]?>
							</a>
							<span class="news-item__date"><?=$item["dt"]?></span>
						</li>
					<?endforeach?>
				</ul>
				<span class="archive"><a class="archive__link" href="news.php">Архив новостей</a></span>
			</section>
		</div>
		<?
			if(!$isNotMainPage && is_file(INCLUDE_AREAS_PATH . 'index_include.php'))
				include(INCLUDE_AREAS_PATH . 'index_include.php');
		?>
	</div>
</div>
<footer class="page-footer">
	<div class="wrapper page-footer__wrapper">
		<div class="copyright">
			<span class="copyright__part copyright__lifetime">Copyright ©2007-<?=date("Y", time())?></span>
			<span class="copyright__part copyright__company-lifetime"><b>© "Company"</b>, <?=date("Y", time())?></span>
			<?if($isNotMainPage) echo '<a class="footer-logo__link" href="index.php">'?>
				<img class="copyright__image" src="img/logo.png" alt="Company-logo">
				<span class="copyright__part copyrhigt__company-name">Company</span>
			<?if($isNotMainPage) echo '</a>'?>
		</div>
		<nav class="footer-nav">
			<ul class="footer-nav__list">
				<?
					// Вывод нижнего меню
					foreach($menu as $item)
						echo
							'<li class="footer-nav__list-item">' .
								(false !== strpos($thisScript, $item["href"]) ?
									'<span class="footer-nav__link">' . $item["name"] . '</span>' :
									'<a class="footer-nav__link" href="' . $item["href"] . '">' . $item["name"] . '</a>') .
							'</li>';
				?>
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