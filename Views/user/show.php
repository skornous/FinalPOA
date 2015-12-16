<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo BASE_URL;?>/users"><?php echo $lang->USERLIST; ?></a></li>
		<li class="active"><?php echo $lang->USER . " - " . $user->login; ?></a></li>
	</ol>
	<h1>
		<?php echo $lang->USER . " - " . $user->login;
			if ($loggedUser->can("edit", "user")): ?>
		<a href="<?php echo BASE_URL . "/users/modify/" . $user->id; ?>" class="btn btn-primary"><?php echo $lang->MODIFY; ?></a>
		<?php endif; ?>
	</h1>
	<div class="well">
		<div class="container-fluid">
			<div class="row">
				<em class="col-sm-2"><?php echo $lang->FNAME; ?></em>
				<span class="col-sm-10"><?php echo $user->firstname; ?></span>
			</div>
			<div class="row">
				<em class="col-sm-2"><?php echo $lang->LNAME; ?></em>
				<span class="col-sm-10"><?php echo $user->lastname; ?></span>
			</div>
			<div class="row">
				<em class="col-sm-2"><?php echo $lang->LOGIN; ?></em>
				<span class="col-sm-10"><strong><?php echo $user->login; ?></strong></span>
			</div>
			<div class="row">
				<em class="col-sm-2"><?php echo $lang->EMAIL; ?></em>
				<span class="col-sm-10"><a href="mailto:<?php echo $user->email;?>"><?php echo $user->email; ?></a></span>
			</div>
			<div class="row">
				<em class="col-sm-2"><?php echo $lang->ACTIVE; ?></em>
				<span class="col-sm-10"><span class="glyphicon glyphicon-<?php echo ($user->active) ? "ok" : "remove"; ?>"></span></span>
			</div>
			<div class="row">
				<em class="col-sm-2"><?php echo $lang->DELETED; ?></em>
				<span class="col-sm-10"><span class="glyphicon glyphicon-<?php echo ($user->deleted) ? "ok" : "remove"; ?>"></span></span>
			</div>
			<div class="row">
				<em class="col-sm-2"><?php echo $lang->TEAMS; ?></em>
				<span class="col-sm-10">
					<?php
						$teams = $user->getTeams();
						if (!empty($teams)):
					?><br>
						<ul class="list-unstyled">
						<?php foreach ($teams as $team): ?>
							<li>- <?php echo $team["name"]; ?></li>
						<?php endforeach; ?>
						</ul>
					<?php else:
							echo $lang->NOTEAMS;
						endif;
					?>
				</span>
			</div>
		</div>
	</div>
</div>