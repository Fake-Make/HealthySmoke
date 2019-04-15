<?
	$activePage = "Главная";
	require_once("inner/meta.php");
?>
<body>
	<? require_once("inner/header.php"); ?>
	<div class="content">
		<div class="wrapper content__wrapper">
			<main class="inside-content">
				<h1>Ошибка #404: Такой страницы не существует :(</h1>
				<h2>На <a href="index.php">главную</a>.</h2>
			</main>
			<? require_once("inner/sidebar.php") ?>
		</div>
	</div>
	<? require_once("inner/footer.php"); ?>
</body>
</html>