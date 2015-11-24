<?php if(isset($formDatas) && !isset($server)) $server = $formDatas; ?>
<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo BASE_URL . '/servers';?>"><?php echo $lang->MSERVERLIST;?></a></li>
		<li><a href="<?php echo BASE_URL . '/server/show/' . $server->id;?>"><?php echo $lang->MSERVER . " - " . $server->name; ?></a></li>
		<li class="active"><?php echo $lang->MODIFY; ?></a></li>
	</ol>
	<h1> <?php echo $lang->MODIFY; ?> </h1>
	<div class="jumbotron row">
		<form method="POST" name="form_update" action="<?php echo BASE_URL; ?>/servers/<?php echo $server->id; ?>">
			<div role="form-group" role="form">

				<input type="hidden" name="id" value="<?php echo $server->id; ?>">

				<label class="col-sm-2 control-label" for="name"><?php echo $lang->NAME; ?> :</label>  
				<div class="col-sm-10 form-group">
					<input type="text" name="name" class="form-control" value="<?php echo $server->name; ?>">
				</div>

				<div class="col-sm-12 form-group">
					<button class="btn btn-success pull-right" type="submit"><?php echo $lang->SAVE; ?></button>
				</div>
			</div>
		</form>
	</div>
</div>