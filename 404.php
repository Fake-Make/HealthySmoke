<?require_once("template/header.php")?>
<?
	$title = "Ошибка 404 - Company";
	echo changeTitle(ob_get_clean());
?>
<h1>Ошибка #404: Такой страницы не существует :(</h1>
<p>На <a href="index.php">главную</a>.</p>
<?require_once("template/footer.php")?>