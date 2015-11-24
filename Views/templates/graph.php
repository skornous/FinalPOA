<div id="<?php echo $type; ?>" class="col-sm-12" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

<script type="text/javascript">
	var tab_date_<?php echo $type; ?> = <?php echo json_encode($xAxis); ?>;
	var tab_values_<?php echo $type; ?> = <?php echo json_encode($yAxis); ?>;
</script>