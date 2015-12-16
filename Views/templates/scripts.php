	<script src="<?php echo BASE_URL; ?>/Views/libs/jquery/jquery-1.11.2.min.js"></script>
	<script src="<?php echo BASE_URL; ?>/Views/libs/jquery/jquery-ui-1.10.2.min.js"></script>
	<script src="<?php echo BASE_URL; ?>/Views/libs/bootstrap/js/bootstrap.min.js"></script>
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>
	<!-- <script src="<?php echo BASE_URL; ?>/Views/libs/HighCharts/highcharts.js"></script>
	<script src="<?php echo BASE_URL; ?>/Views/libs/HighCharts/modules/exporting.js"></script> -->
	<script src="<?php echo BASE_URL; ?>/Views/libs/DataTables/media/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo BASE_URL; ?>/Views/libs/GeneratePSWD/generate_password.js"></script>
	
	<?php
		if (isset($scripts) && !empty($scripts)){
			echo "<script>var BASE_URL = '" . BASE_URL . "'</script>";
			foreach ($scripts as $scriptpath) {
				echo '<script src="' . BASE_URL . '/Views/libs/' . $scriptpath . '.js"></script>';
			}
		}
	?>
	<script src="<?php echo BASE_URL; ?>/Views/libs/adds/js/init.js"></script>