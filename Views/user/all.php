<div class="container">
	<ol class="breadcrumb">
		<li class="active"><?php echo $lang->USERLIST; ?></li>
	</ol>
<h1> <?php echo $lang->USERLIST; ?> </h1>
<hr />
<?php if ($loggedUser->can("add", "user")): ?>
	<a href="<?php echo BASE_URL . "/users/create";?>" class="btn btn-success" role="button" name="btn_add"><?php echo $lang->ADD; ?></a>
<?php endif;

	if (!empty($users)) {
		echo '<div class="table-responsive"><table class="table table-condensed table-striped dataTable">
			<thead>
				<tr>
					<th class="text-center">' . $lang->FNAME . '</th>
					<th class="text-center">' . $lang->LNAME . '</th>
					<th class="text-center">' . $lang->LOGIN . '</th>
					<th class="text-center">' . $lang->EMAIL . '</th>
					<th class="text-center">' . $lang->ACTIVE . '</th>';
	if ($loggedUser->can("edit", "user")){
		echo '		<th class="text-center">' . $lang->MODIFY . '</th>';
	}
	if ($loggedUser->can("delete", "user")){
		echo '		<th class="text-center">' . $lang->DELETE . '</th>';
	}
		echo'	</tr>
			</thead>
			<tbody>';
		foreach ($users as $user) {
			if (!$user["deleted"]) {
?>
<tr class="text-center">
	<td><?php echo $user["firstname"]; ?></td>
	<td><?php echo $user["lastname"]; ?></td>
	<td><a href="<?php echo BASE_URL . "/users/" . $user["id"];?>"><?php echo $user["login"]; ?></a></td>
	<td><?php echo $user["email"]; ?></td>
	<td><span class="glyphicon glyphicon-<?php echo ($user["active"]) ? "ok" : "remove"; ?>"></span></td>
<?php if ($loggedUser->can("edit", "user")): ?>
	<td><a class="btn btn-primary" href="<?php echo BASE_URL . "/users/modify/" . $user["id"];?>"><?php echo $lang->MODIFY; ?></a></td>
<?php endif; ?>
<?php if ($loggedUser->can("delete", "user")): ?>
	<td><a class="btn btn-danger" href="<?php echo BASE_URL . "/users/delete/" . $user["id"];?>"><?php echo $lang->DELETE; ?></a></td>
<?php endif; ?>
	</tr>
<?php
			}
		}
		echo '</tbody></table></div>';
	} else {
		echo '<h2>' . $lang->NOUSERFOUND . '</h2>';
	}
?>
</div>