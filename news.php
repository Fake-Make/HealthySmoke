<?require_once("template/header.php")?>
<?
	// Если пришёл id новости, значит подобрать данные для вывода одной новости
	$id = isset($_GET["id"]) ? validNaturalNumber($_GET["id"]) : NULL;
	// Взятие новости из БД (раньше было одной функцией)
	if ($id)
		$oneNews = mysqli_fetch_assoc(mysqli_query($db, "SELECT header, content, dt FROM news WHERE id=$id"));
	if(!empty($oneNews)) {
		$newsHeader = $oneNews["header"];
		$newsContent = $oneNews["content"];
		$newsData = $oneNews["dt"];
		$title = "$newsHeader — читать новости интернет-магазина Company";
	}	else
		$title = "Новости - Company";
	echo changeTitle(ob_get_clean());
	// Далее на строках 15-16 табуляция вызывает сомнения
?>
<?if(!empty($oneNews)):?>
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
<?else:?>
	<h1 class="invisible">Архив новостей</h1>
	<nav class="bread-crumbs-container">
		<ul class="bread-crumbs">
			<li class="bread-crumb"><a class="bread-crumb__link" href="index.php">Главная</a></li>
			<li class="bread-crumb bread-crumb_current">Новости</li>
		</ul>
	</nav>
	<ul class="news-list">
		<?
			// Аналогично странице каталога
			// Взятие максимального числа новостей из БД
			$sqlReq = "SELECT count(*) FROM news";
			$maxPage = ceil(mysqli_fetch_row(mysqli_query($db, $sqlReq))["0"] / MAX_NEWS_ON_PAGE);
			$page = validNaturalNumber($_GET["page"]);
			if($page > $maxPage)
				$page = 1;
			$news = getNewsByPages(MAX_NEWS_ON_PAGE, $page);
			foreach ($news as $item) {
				echo 
					'<li class="news-item">
						<a class="news-item__link" href="news.php?id=' . $item["id"] . '">' .
							$item["anounce"] .
						'</a>
						<span class="news-item__date">' . $item["dt"] . '</span>
					</li>';
			}
		?>
	</ul>
	<? makePaginator(PAGINATOR_ELEMENTS, $page, $maxPage); ?>
<?endif?>
<?require_once("template/footer.php")?>