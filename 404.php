<?require_once("template/header.php")?>
<?
	$title = "Ошибка 404 - Company";
	echo changeTitle(ob_get_clean());
?>
<h1>Ошибка #404: Такой страницы не существует :(</h1>
<?if(1 === $error = intval($_GET["error"])):?>
	<h2>Выбранной категории не существует :(</h2>
	<p>Возможно, вы попали сюда по ошибке. Попробуйте посмотреть
	<a href="catalog.php">все товары</a>.</p>
<?elseif(2 === $error):?>
	<h2>Товар не найден :(</h2>
	<p>Попробуйте вернуться на страницу
		<a href="catalog.php<?=$subLink?>">каталога</a>.
	</p>
<?else:?>
	<h2>На <a href="index.php">главную</a>.</h2>
<?endif?>
<?require_once("template/footer.php")?>