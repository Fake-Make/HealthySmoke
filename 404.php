<?require_once("template/header.php")?>
<?
	$title = "Ошибка 404 - Company";
	echo changeTitle(ob_get_clean());
?>
<h1>Ошибка #404: Такой страницы не существует :(</h1>
<h2>На <a href="index.php">главную</a>.</h2>
<?require_once("template/footer.php")?>