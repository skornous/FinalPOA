<div class="container">
	<ol class="breadcrumb">
		<li class="active"><?php echo $lang->PSWD . " - " . $loggedUser->login; ?></a></li>
	</ol>
	<form method="POST" action="" name="form_pswd">
		<div role="form-group" role="form">
			<input type="hidden" name="userID" value="<?php echo $loggedUser->id; ?>">
			<div class="row">
				<label class="col-sm-3 control-label" for="oldpassword"><?php echo $lang->OLDPSWD; ?> <span
						class="star-important">*</span></label>
				<div class="col-sm-9 form-group">
					<input type="password" name="oldpassword" class="form-control" value="">
				</div>
			</div>
			<div class="row">
				<label class="col-sm-3 control-label" for="newpassword1">
					<button type="button"
					        class="btn btn-xs btn-default" data-container="body" data-toggle="popover"
					        data-placement="bottom" data-content="<?php echo "$lang->PSWDRULES"; ?>">?
					</button> <?php echo $lang->NEWPSWD; ?> <span class="star-important">*</span></label>
				<div class="col-sm-9 form-group">
					<input type="password" name="newpassword1" class="form-control" value="">
				</div>
			</div>
			<div class="row">
				<label class="col-sm-3 control-label" for="newpassword2"><?php echo $lang->NEWPSWDVERIF; ?> <span
						class="star-important">*</span></label>
				<div class="col-sm-9 form-group">
					<input type="password" name="newpassword2" class="form-control" value="">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 form-group">
					<button class="btn btn-success pull-right" type="submit"><?php echo $lang->SAVE; ?></button>
				</div>
			</div>
		</div>
	</form>
</div>