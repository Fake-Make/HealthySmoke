<?
	function makePaginator($show, $cur, $max) {
		echo '<ul class="paginator catalog-page__paginator">';
		$shift = ($show - 1) / 2;
		// Мы слишком лево
		if ($cur - $shift < 1) {
			if ($show > $max)
				$show = $max;
			for ($i = 1; $i <= $show; $i++) {
				if ($i === $cur)
					echo "<li class='paginator__elem paginator__elem_current'><span class='paginator__link'>$i</span></li>";
				else
					echo "<li class='paginator__elem'><a href='" . $_SERVER['SCRIPT_NAME'] . "?page=$i" . "' class='paginator__link'>$i</a></li>";
			}
		}	
		// Мы слишком право
		elseif ($cur + $shift > $max) {
			$left = $max - $show + 1;
			if ($left < 1)
				$left = 1;
			for ($i = $left; $i <= $max; $i++) {
				if ($i === $cur)
					echo "<li class='paginator__elem paginator__elem_current'><span class='paginator__link'>$i</span></li>";
				else
					echo "<li class='paginator__elem'><a href='" . $_SERVER['SCRIPT_NAME'] . "?page=$i" . "' class='paginator__link'>$i</a></li>";
			}
		} 
		// Мы где-то в центре
		else {
			if ($show > $max)
				$show = $max;
			$left = $cur - $shift;
			$right = $left + $show;
			for ($i = $left; $i < $right; $i++) {
				if ($i === $cur)
					echo "<li class='paginator__elem paginator__elem_current'><span class='paginator__link'>$i</span></li>";
				else
					echo "<li class='paginator__elem'><a href='" . $_SERVER['SCRIPT_NAME'] . "?page=$i" . "' class='paginator__link'>$i</a></li>";
			}
		}
		if ($cur != $max)
			echo "<li class='paginator__elem paginator__elem_next'><a href='" . $_SERVER['SCRIPT_NAME'] . "?page=" . ($cur + 1) . "' class='paginator__link'>Следующая страница</a></li>";
		echo "</ul>";
	}
	makePaginator(7, intval($_GET["page"]), 5);
?>