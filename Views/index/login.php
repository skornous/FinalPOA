<div class="container">
	<div class="row">
		<h1><?php echo $lang->CONNEXION; ?> </h1>
	</div>
	<br><br>
	<div class="row">
		<form class="col-sm-8" method="POST" name="form_update" action="">
			<div class="row" role="form-group" role="form" name="form_connect">
				<label class="col-sm-2 control-label" for="login"><?php echo $lang->LOGIN; ?></label>
				<div class="col-sm-10 form-group">
					<input type="text" name="login" class="form-control">
				</div>
				<label class="col-sm-2 control-label" for="login"><?php echo $lang->PSWD; ?></label>
				<div class="col-sm-10 form-group">
					<input type="password" name="pswd" class="form-control">
				</div>
			</div>
			<div class="col-sm-2 form-group"></div>
			<div class="col-sm-10 form-group">
				<button class="btn btn-lg btn-primary btn-block" type="submit"><?php echo $lang->CONNECT; ?></button>
			</div>
		</form>

	</div>
</div>