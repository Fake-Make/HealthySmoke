<!--Файл, содержащий блок подвала для всех страниц сайта-->
<footer class="page-footer">
	<div class="wrapper page-footer__wrapper">
		<div class="copyright">
			<span class="copyright__part copyright__lifetime">Copyright ©2007-<?= date("Y", time()); ?></span>
			<span class="copyright__part copyright__company-lifetime"><b>© "Company"</b>, <?= date("Y", time()); ?></span>
			<? if ("Главная" !== $activePage) echo '<a class="footer-logo__link" href="index.php">'; ?>
				<img class="copyright__image" src="img/logo.png" alt="Company-logo">
				<span class="copyright__part copyrhigt__company-name">Company</span>
			<? if ("Главная" !== $activePage) echo '</a>'; ?>	
		</div>
		<nav class="footer-nav">
			<ul class="footer-nav__list">
				<li class="footer-nav__list-item">
					<?
						if($activePage === "Главная")
							echo '<span class="footer-nav__link">Главная</span>';
						else
							echo '<a class="footer-nav__link" href="index.php">Главная</a>';
					?>
				</li>
				<li class="footer-nav__list-item">
					<?
						if($activePage === "Каталог")
							echo '<span class="footer-nav__link">Каталог</span>';
						else
							echo '<a class="footer-nav__link" href="catalog.php">Каталог</a>';
					?>
				</li>
				<li class="footer-nav__list-item">
					<?
						if($activePage === "О компании")
							echo '<span class="footer-nav__link">О компании</span>';
						else
							echo '<a class="footer-nav__link" href="#">О компании</a>';
					?>
				</li>
				<li class="footer-nav__list-item">
					<?
						if($activePage === "Новости")
							echo '<span class="footer-nav__link">Новости</span>';
						else
							echo '<a class="footer-nav__link" href="#">Новости</a>';
					?>
				</li>
				<li class="footer-nav__list-item">
					<?
						if($activePage === "Доставка и оплата")
							echo '<span class="footer-nav__link">Доставка и оплата</span>';
						else
							echo '<a class="footer-nav__link" href="paydelivery.php">Доставка и оплата</a>';
					?>
				</li>
				<li class="footer-nav__list-item">
					<?
						if($activePage === "Контакты")
							echo '<span class="footer-nav__link">Контакты</span>';
						else
							echo '<a class="footer-nav__link" href="contacts.php">Контакты</a>';
					?>	
				</li>
			</ul>
		</nav>
		<div class="developer">
			<span class="developer__ref">Разработка сайта - <a class="developer__link" href="http://itconstruct.ru">ITConstruct</a></span>
			<img class="counter" src="img/counter.png" alt="Page-counter">
		</div>
	</div>
</footer>