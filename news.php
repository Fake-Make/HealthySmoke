<? require_once("inner/header.php"); ?>
	<?
		if (isset($_GET["id"]) && !empty($oneNews = getOneNews($id = intval($_GET["id"])))) {
			$oneNews = $oneNews["0"];
			$newsHeader = $oneNews["header"];
			$newsContent = $oneNews["content"];
			$newsData = $oneNews["dt"];
			$title = "$newsHeader — читать новости интернет-магазина Company";
		}	else
			$title = "Новости - Company";
		$activePage = "Новости";
		echo applyChanges(ob_get_clean());
	?>
				<? if(!empty($oneNews)) { ?>
					<nav class="bread-crumbs-container product__bread-crumbs">
						<ul class="bread-crumbs">
							<li class="bread-crumb"><a class="bread-crumb__link" href="index.php">Главная</a></li>
							<li class="bread-crumb"><a class="bread-crumb__link" href="news.php">Новости</a></li>
							<li class="bread-crumb bread-crumb_current"><?=$newsHeader?></li>
						</ul>
					</nav>
					<article>
						<p><?=$newsData?></p>
						<h1><?=$newsHeader?></h1>
						<?=$newsContent?>
					</article>
				<? } else { ?>
					<h1 class="invisible">Архив новостей</h1>
					<nav class="bread-crumbs-container">
						<ul class="bread-crumbs">
							<li class="bread-crumb"><a class="bread-crumb__link" href="index.php">Главная</a></li>
							<li class="bread-crumb bread-crumb_current">Новости</li>
						</ul>
					</nav>
					<ul class="news-list">
						<?
							// Сюда нужен отряд валидашек
							// Геты вообще пидоры, хер знает, где их носило
							// Лучше лишний раз провериться и предохраниться
							$maxPage = getMaxPage4News($maxNewsOnPage);
							$page = isset($_GET["page"]) ? intval($_GET["page"]) : 1;
							if ($page > $maxPage || $page < 1)
								$page = 1;
							$news = getNewsByPages($maxNewsOnPage, $page);
							foreach ($news as $item) {
								$id = $item["id"];
								$anounce = $item["anounce"];
								$dt = $item["dt"]
						?>
						<li class="news-item">
							<a class="news-item__link" href="news.php?id=<?=$id?>">
								<?=$anounce?>
							</a>
							<span class="news-item__date"><?=$dt?></span>
						</li>
						<?
							}
						?>
					</ul>
					<? makePaginator($paginatorElements, $page, $maxPage); ?>
				<? } ?>
<? require_once("inner/sidebar.php"); ?>
<? require_once("inner/footer.php"); ?>