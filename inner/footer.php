
	</div>
</div>
<footer class="page-footer">
	<div class="wrapper page-footer__wrapper">
		<div class="copyright">
			<span class="copyright__part copyright__lifetime">Copyright ©2007-<?=date("Y", time())?></span>
			<span class="copyright__part copyright__company-lifetime"><b>© "Company"</b>, <?=date("Y", time())?></span>
			<? if ("Главная" !== $activePage) echo '<a class="footer-logo__link" href="index.php">'; ?>
				<img class="copyright__image" src="img/logo.png" alt="Company-logo">
				<span class="copyright__part copyrhigt__company-name">Company</span>
			<? if ("Главная" !== $activePage) echo '</a>'; ?>	
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
<? mysqli_close($db); ?>
</body>
</html>
<?ob_end_flush();?>