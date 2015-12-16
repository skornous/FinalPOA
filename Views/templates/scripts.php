<script src="<?php echo BASE_URL; ?>/Views/libs/jquery.min.js"></script>
<script src="<?php echo BASE_URL; ?>/Views/libs/foundation.min.js"></script>
<script>
	$(document).foundation();
</script>

<?php
	if (isset($scripts) && !empty($scripts)) {
		echo "<script>var BASE_URL = '" . BASE_URL . "'</script>";
		foreach ($scripts as $scriptpath) {
			echo '<script src="' . BASE_URL . '/Views/libs/' . $scriptpath . '.js"></script>';
		}
	}
?>