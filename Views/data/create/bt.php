<?php $rows = $team->getRowsAsArray(); ?>
<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo BASE_URL . '/datas/' . strtolower($team->name);?>"><?php echo $lang->DATALIST;?> - <?php echo $team->name; ?></a></li>
		<li class="active"><?php echo $lang->ADD; ?></a></li>
	</ol>
	<h1> <?php echo $lang->ADD; ?> </h1>
	<br><br>
	<form method="POST" action="<?php echo BASE_URL; ?>/datas/<?php echo strtolower($team->name);?>/create" name="form_add">
		<div role="form-group" role="form">
			<!-- nb_jobs -->
			<div class="row">
				<label class="col-sm-2 control-label" for="nb_jobs"><?php echo $rows[0]; ?> <span class="star-important">*</span></label>  
				<div class="col-sm-10 form-group">
					<input type="number" step="0.01" name="nb_jobs" required="required" class="form-control" value="<?php if(isset($formDatas) && isset($formDatas["To"])) echo $formDatas["To"]; ?>">
				</div>
			</div>

			<!-- Date -->
			<div class="row">
				<label class="col-sm-2 control-label" for="date"><?php echo ucfirst($rows[1]); ?> <span class="star-important">*</span></label>  
				<div class="col-sm-10 form-group">
					<input placeholder="<?php echo $lang->DATEFORMAT; ?>" type="date" name="date" required="required" class="form-control" value="<?php if(isset($formDatas) && isset($formDatas["date"])) echo $formDatas["date"]; ?>">
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