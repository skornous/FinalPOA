<?php if (isset($formDatas) && !isset($user)) {
	$user = $formDatas;
} ?>
<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo BASE_URL . '/users'; ?>"><?php echo $lang->USERLIST; ?></a></li>
		<li>
			<a href="<?php echo BASE_URL . '/user/show/' . $user->id; ?>"><?php echo $lang->USER . " - " . $user->login; ?></a>
		</li>
		<li class="active"><?php echo $lang->MODIFY; ?></a></li>
	</ol>
	<h1> <?php echo $lang->MODIFY; ?> </h1>
	<div class="jumbotron row">
		<form method="POST" name="form_update" action="<?php echo BASE_URL; ?>/users/<?php echo $user->id; ?>">
			<div role="form-group" role="form">

				<input type="hidden" name="id" value="<?php echo $user->id; ?>">

				<label class="col-sm-2 control-label" for="firstname"><?php echo $lang->FNAME; ?> :</label>
				<div class="col-sm-10 form-group">
					<input type="text" name="firstname" class="form-control" value="<?php echo $user->firstname; ?>">
				</div>

				<label class="col-sm-2 control-label" for="lastname"><?php echo $lang->LNAME; ?> :</label>
				<div class="col-sm-10 form-group">
					<input type="text" name="lastname" class="form-control" value="<?php echo $user->lastname; ?>">
				</div>

				<label class="col-sm-2 control-label" for="email"><?php echo $lang->EMAIL; ?> :</label>
				<div class="col-sm-10 form-group">
					<input type="text" name="email" class="form-control" value="<?php echo $user->email; ?>">
				</div>

				<label class="col-sm-2 control-label" for="login"><?php echo $lang->LOGIN; ?> :</label>
				<div class="col-sm-10 form-group">
					<input type="text" name="login" class="form-control" value="<?php echo $user->login; ?>">
				</div>

				<label class="col-sm-2 control-label" for="teams"><?php echo $lang->TEAMS; ?> :</label>
				<div class="col-sm-10 form-group">
					<select multiple="multiple" class="form-control" name="teams[]">
						<?php foreach ($teams as $team): ?>
							<option
								value="<?php echo $team["id"]; ?>"<?php if ($user->isStrictlyPartOf($team["name"])) {
								echo ' selected="selected"';
							} ?>><?php echo $team["name"]; ?></option>
						<?php endforeach; ?>
					</select>
				</div>

				<label class="col-sm-2 control-label"><?php echo $lang->ACTIVE; ?></label>
				<div class="col-sm-10 form-group">
					<input type="checkbox" name="active" <?php if ($user->active) {
						echo 'checked="checked"';
					} else {
					} ?> >
				</div>

				<div class="col-sm-12 form-group">
					<button class="btn btn-success pull-right" type="submit"><?php echo $lang->SAVE; ?></button>
				</div>
			</div>
		</form>
	</div>
</div>