<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo BASE_URL . '/servers';?>"><?php echo $lang->MSERVERLIST;?></a></li>
		<li class="active"><?php echo $lang->ADD; ?></a></li>
	</ol>
	<h1> <?php echo $lang->ADD; ?> </h1>
	<br><br>
	<form method="POST" action="<?php echo BASE_URL; ?>/servers/create" name="form_add">
		<div role="form-group" role="form">
			<div class="row">
				<label class="col-sm-2 control-label" for="name"><?php echo $lang->NAME; ?> <span class="star-important">*</span></label>  
				<div class="col-sm-10 form-group">
					<input type="text" name="name" required="required" class="form-control" value="<?php if(isset($formDatas) && isset($formDatas["name"])) echo $formDatas["name"]; ?>">
				</div>
			</div>

			<div class="row">
				<div class="col-sm-12 form-group">
					<button class="btn btn-success pull-right" type="submit"><?php echo $lang->SAVE; ?></button>
				</div>
			</div>
			<div class="row">
				<span class="star-important">*</span> : <?php echo $lang->NEEDED; ?>
			</div>
		</div>
	</form>
</div>