<?
	function makePager($iCurr, $iEnd, $iLeft, $iRight) {
		if ($iCurr > $iLeft && $iCurr < ($iEnd - $iRight)) {
			for ($i = $iCurr - $iLeft; $i <= $iCurr + $iRight; $i++) {
				if ($i === $iCurr)
					echo "<span> $i </span>";
				else
					echo "<a href='#'> $i </a>";
			}
		} elseif ($iCurr <= $iLeft) {
			$iSlice = 1 + $iLeft - $iCurr;
			for ($i = 1; $i <= $iCurr + ($iRight + $iSlice); $i++) {
				if ($i === $iCurr)
					echo "<span> $i </span>";
				else
					echo "<a href='#'> $i </a>";
			}
		} else {
			$iSlice = $iRight - ($iEnd - $iCurr);
			for ($i = $iCurr - ($iLeft + $iSlice); $i <= $iEnd; $i++) {
				if ($i === $iCurr)
					echo "<span> $i </span>";
				else
					echo "<a href='#'> $i </a>";
			}
		}
	}
	makePager(1, 5, 3, 3);
?>