<?php 
	// var_dump($team->getRowsAsArray()); 
?>
<div class="container">
	<ol class="breadcrumb">
		<li class="active"><?php echo $lang->DATALIST; ?></li>
	</ol>
<h1> <?php echo $lang->DATALIST; ?> </h1>
<hr />
<?php if ($loggedUser->can("add", "data") && $loggedUser->isPartOf($team->name)): ?>
	<a href="<?php echo BASE_URL . "/datas/" . lcfirst($team->name) . "/create";?>" class="btn btn-success" role="button" name="btn_add"><?php echo $lang->ADD; ?></a>
<?php endif;

	if (!empty($datas)) {
		echo '<div class="table-responsive"><table class="table table-condensed table-striped dataTable">
			<thead>
				<tr>';
		foreach ($team->getRowsAsArray() as $row) {
			echo '<th class="text-center">' . ucfirst($row) . '</th>';
		}
	if ($loggedUser->can("edit", "data") && $loggedUser->isPartOf($team->name)){
		echo '		<th class="text-center">' . $lang->MODIFY . '</th>';
	}
	if ($loggedUser->can("delete", "data") && $loggedUser->isPartOf($team->name)){
		echo '		<th class="text-center">' . $lang->DELETE . '</th>';
	}
		echo'	</tr>
			</thead>
			<tbody>';
		foreach ($datas as $data) {
?>
<tr class="text-center">
<?php foreach ($team->getRowsAsArray() as $row): ?>
		<td><?php echo $data[$row]; ?></td>
<?php endforeach; ?>
<?php if ($loggedUser->can("edit", "data") && $loggedUser->isPartOf($team->name)): ?>
	<td><a class="btn btn-primary" href="<?php echo BASE_URL . "/datas/" . lcfirst($team->name) . "/modify/" . $data["id"];?>"><?php echo $lang->MODIFY; ?></a></td>
<?php endif; ?>
<?php if ($loggedUser->can("delete", "data") && $loggedUser->isPartOf($team->name)): ?>
	<td><a class="btn btn-danger" href="<?php echo BASE_URL . "/datas/" . lcfirst($team->name) . "/delete/" . $data["id"];?>"><?php echo $lang->DELETE; ?></a></td>
<?php endif; ?>
	</tr>
<?php
		}
		echo '</tbody></table></div>';
	} else {
	echo '<h2>' . $lang->NODATAFOUND . '</h2>';
	}
?>
</div>