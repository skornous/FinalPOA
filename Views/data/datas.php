<?php
	// if (isset($datas)) var_dump($datas);
	// if (isset($months)) var_dump($months);
	// if (isset($type)) var_dump($type);
	if(isset($_POST) && isset($_POST["month"])) {
		$selectedMonth = $_POST["month"];
	}
	// if (isset($datas) && isset($datas["monthMinus12"])) {
	// 	unset($datas["monthMinus12"]["endMonth"]);
	// }
	$nbToName = array(
		"nb_BT" => "Batch Scheduling - BT",
		"nbi_SAP" => "SAP",
		"nb_NETBACKUP" => "Tools - Netbackup",
		"nbi_ORACLE" => "DBA- Oracle",
		"nbi_SQL" => "DBA-SQL",
		"nb_ESX" => "Wintel-VMWARE",
		"nb_CITRIX" => "Wintel-CITRIX",
	);
?>
<div class="container">
	<ol class="breadcrumb">
		<li class="active"><?php echo $lang->DATAS; ?></a></li>
	</ol>
	<h1> <?php echo $lang->DATAS; ?> </h1>
	<div class="row">
		<form method="POST" name="select_date" action="<?php echo BASE_URL; ?>/datas/<?php echo $type; ?>" onchange="this.submit();">
			<div role="form-group" role="form">

				<label class="col-sm-2 control-label" for="month"><?php echo $lang->SELECTDATE; ?></label>  
				<div class="col-sm-10 form-group">
					<select class="form-control" name="month">
						<option value="0"><?php echo $lang->SELECT; ?></option>
						<?php foreach ($months as $month): ?>
						<option value="<?php echo $month; ?>"<?php if(isset($selectedMonth) && $selectedMonth == $month) echo 'selected="selected"'; ?>><?php echo $month; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
		</form>
	</div>
	<?php if(isset($selectedMonth)): ?>
	<div class="row">
		<div class="row">
			<h2>This month datas</h2>
			<table class="table table-condensed table-striped">
				<thead>
					<tr>
						<th>Type</th>
						<th>Value</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Batch Scheduling - BT</td>
						<td><?php echo $datas["currentMonth"]["nb_BT"]; ?></td>
					</tr>
					<tr>
						<td>SAP</td>
						<td><?php echo $datas["currentMonth"]["nbi_SAP"]; ?></td>
					</tr>
					<tr>
						<td>Tools - Netbackup</td>
						<td><?php echo $datas["currentMonth"]["nb_NETBACKUP"]; ?></td>
					</tr>
					<tr>
						<td>DBA- Oracle</td>
						<td><?php echo $datas["currentMonth"]["nbi_ORACLE"]; ?></td>
					</tr>
					<tr>
						<td>DBA-SQL</td>
						<td><?php echo $datas["currentMonth"]["nbi_SQL"]; ?></td>
					</tr>
					<tr>
						<td>Wintel-VMWARE</td>
						<td><?php echo $datas["currentMonth"]["nb_ESX"]; ?></td>
					</tr>
					<tr>
						<td>Wintel-CITRIX</td>
						<td><?php echo $datas["currentMonth"]["nb_CITRIX"]; ?></td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="row">
			<h2>During the last 12 months</h2>
			<table class="table table-condensed table-striped">
				<thead>
					<tr>
						<th>Type</th>
						<?php foreach ($datas["monthMinus12"]["nbi_SAP"] as $month => $value): ?>
						<th><?php echo $month; ?></th>
						<?php endforeach; ?>
					</tr>
				</thead>
				<tbody>
					<?php
						foreach ($datas["monthMinus12"] as $type => $vals):
							if(is_array($vals) && !empty($vals)):
					?>
						<tr>
							<td><?php echo $nbToName[$type]; ?></td>
							<?php foreach ($datas["monthMinus12"]["nbi_SAP"] as $month => $value): ?>
								<td><?php echo (array_key_exists($month, $vals)) ? $vals[$month] : 0; ?></td>
							<?php endforeach; ?>
						</tr>
					<?php
							endif;
						endforeach;
					?>
				</tbody>
			</table>
		</div>
	</div>
	<div class="row">
		<h2>Graphs</h2>
		<?php
			foreach ($datas["monthMinus12"] as $type => $arr_vals) {
				if (is_array($arr_vals)) {
					echo "<h3>" . $nbToName[$type] . "</h3>";
					$xAxis = array_keys($arr_vals);
					$yAxis = array_values($arr_vals);
					foreach ($yAxis as $key => $value) {
						$yAxis[$key] = floatval($value);
					}
					include("/Views/templates/graph.php");
				}
			}
		?>
	</div>
	<?php endif; ?>
</div>