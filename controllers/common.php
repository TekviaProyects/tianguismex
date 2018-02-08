<?php
class Common {
	function content($f) {
		if (isset($f)) {
			$this -> $f();
		}
	}

}
?>