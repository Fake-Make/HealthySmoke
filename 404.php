<? require_once("inner/header.php"); ?>
<?
	$title = "Ошибка 404 - Company";
	$activePage = "404";
	echo applyChanges(ob_get_clean());
?>
<h1>Ошибка #404: Такой страницы не существует :(</h1>
<h2>На <a href="index.php">главную</a>.</h2>
<? require_once("inner/sidebar.php") ?>
<? require_once("inner/footer.php"); ?>