<div class="container">
	<ol class="breadcrumb">
		<li class="active"><?php echo $lang->MSERVERLIST; ?></li>
	</ol>
	<h1> <?php echo $lang->MSERVERLIST; ?> </h1>
	<hr/>
	<?php if ($loggedUser->can("add", "server")): ?>
		<a href="<?php echo BASE_URL . "/servers/create"; ?>" class="btn btn-success" role="button"
		   name="btn_add"><?php echo $lang->ADD; ?></a>
	<?php endif;

		if (!empty($servers)) {
			echo '<div class="table-responsive"><table class="table table-condensed table-striped dataTable">
			<thead>
				<tr>
					<th class="text-center">' . $lang->NAME . '</th>';
			if ($loggedUser->can("edit", "server")) {
				echo '		<th class="text-center">' . $lang->MODIFY . '</th>';
			}
			if ($loggedUser->can("delete", "server")) {
				echo '		<th class="text-center">' . $lang->DELETE . '</th>';
			}
			echo '	</tr>
			</thead>
			<tbody>';
			foreach ($servers as $server) {
				if (!$server["deleted"]) {
					?>
					<tr class="text-center">
						<td><?php echo $server["name"]; ?></td>
						<?php if ($loggedUser->can("edit", "server")): ?>
							<td><a class="btn btn-primary"
							       href="<?php echo BASE_URL . "/servers/modify/" . $server["id"]; ?>"><?php echo $lang->MODIFY; ?></a>
							</td>
						<?php endif; ?>
						<?php if ($loggedUser->can("delete", "server")): ?>
							<td><a class="btn btn-danger"
							       href="<?php echo BASE_URL . "/servers/delete/" . $server["id"]; ?>"><?php echo $lang->DELETE; ?></a>
							</td>
						<?php endif; ?>
					</tr>
					<?php
				}
			}
			echo '</tbody></table></div>';
		} else {
			echo '<h2>' . $lang->NOMSERVERFOUND . '</h2>';
		}
	?>
</div>