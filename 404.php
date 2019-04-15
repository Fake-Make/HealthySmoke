<?
	$activePage = "Главная";
	require_once("inner/meta.php");
?>
<body>
	<? require_once("inner/header.php"); ?>
	<div class="content">
		<div class="wrapper content__wrapper">
			<main>
				<h1 class="invisible">Такой страницы не существует :(</h1>
				<p>На <a href="index.php">главную</a>.</p>
			</main>
			<? require_once("inner/sidebar.php") ?>
		</div>
	</div>
	<? require_once("inner/footer.php"); ?>
</body>
</html>