<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo BASE_URL;?>/servers"><?php echo $lang->MSERVERLIST; ?></a></li>
		<li class="active"><?php echo $lang->MSERVER . " - " . $server->name; ?></a></li>
	</ol>
	<h1>
		<?php echo $lang->MSERVER . " - " . $server->name;
			if ($loggedUser->can("edit", "server")): ?>
		<a href="<?php echo BASE_URL . "/servers/modify/" . $server->id; ?>" class="btn btn-primary"><?php echo $lang->MODIFY; ?></a>
		<?php endif; ?>
	</h1>
	<div class="well">
		<div class="container-fluid">
			<div class="row">
				<em class="col-sm-2"><?php echo $lang->NAME; ?></em>
				<span class="col-sm-10"><?php echo $server->name; ?></span>
			</div>
		</div>
	</div>
</div>