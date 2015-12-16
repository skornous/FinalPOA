<?php
	if (isset($state) && !empty($state)):
		foreach ($state as $bg => $msgCode):
?>
<div class="container">
	<div class="alert alert-<?php echo $bg; ?> alert-dismissible fade in" role="alert">
	      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
	      <p><?php echo $lang->$msgCode; ?></p>
	</div>
</div>
<?php
		endforeach;
	endif;
?>