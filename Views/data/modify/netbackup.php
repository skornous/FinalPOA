<?php $rows = $team->getRowsAsArray(); ?>
<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo BASE_URL . '/datas/' . lcfirst($team->name);?>"><?php echo $lang->DATALIST;?> - <?php echo $team->name; ?></a></li>
		<li class="active"><?php echo $lang->MODIFY; ?></a></li>
	</ol>
	<h1> <?php echo $lang->MODIFY; ?> </h1>
	<br><br>
	<form method="POST" action="<?php echo BASE_URL; ?>/datas/<?php echo lcfirst($team->name) . "/" . $data["id"];?>" name="form_modify">
		<div role="form-group" role="form">
			<!-- Id -->
			<input type="hidden" name="id" value="<?php echo $data["id"]; ?>" />
			<!-- To -->
			<div class="row">
				<label class="col-sm-2 control-label" for="to"><?php echo $rows[2]; ?> <span class="star-important">*</span></label>  
				<div class="col-sm-10 form-group">
					<input type="number" step="0.01" name="to" required="required" class="form-control" value="<?php echo $data["To"]; ?>">
				</div>
			</div>

			<!-- MS -->
			<div class="row">
				<label class="col-sm-2 control-label" for="master_server"><?php echo ucfirst(str_replace("_", " ", $rows[1])); ?> <span class="star-important">*</span></label>  
				<div class="col-sm-10 form-group">
					<select class="form-control" name="master_server">
						<option value="0">Select a value</option>
						<?php foreach ($msList as $ms): ?>
						<option value="<?php echo $ms["id"]; ?>"<?php if ($data["master_server"] == $ms["name"]) echo 'selected="selected"'; ?>><?php echo $ms["name"]; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>

			<!-- Date -->
			<div class="row">
				<label class="col-sm-2 control-label" for="month"><?php echo ucfirst($rows[0]); ?> <span class="star-important">*</span></label>  
				<div class="col-sm-10 form-group">
					<input placeholder="<?php echo $lang->DATEFORMAT; ?>" type="date" name="month" required="required" class="form-control" value="<?php echo $data["month"]; ?>">
				</div>
			</div>

			<!-- Submit -->
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