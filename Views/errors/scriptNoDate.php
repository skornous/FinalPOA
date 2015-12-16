<div class="container">
	<ol class="breadcrumb">
		<li class="active"><?php echo $lang->DATAS; ?></a></li>
	</ol>
	<h1> <?php echo $lang->DATAS; ?> </h1>
	<div class="text-center row">
		<h1><?php echo $lang->ENODATE; ?></h1>
		<div class="breadcrumb"><?php echo $lang->ENODATE_TEXT; ?></div>
	</div>
	<div class="row">
		<form method="POST" name="select_date" action="<?php echo BASE_URL; ?>/datas; ?>" onchange="this.submit();">
			<div role="form-group" role="form">

				<label class="col-sm-2 control-label" for="month"><?php echo $lang->SELECTDATE; ?></label>
				<div class="col-sm-10 form-group">
					<select class="form-control" name="month">
						<option value="0"><?php echo $lang->SELECT; ?></option>
						<?php foreach ($months as $month): ?>
							<option value="<?php echo $month; ?>"><?php echo $month; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
		</form>
	</div>
</div>