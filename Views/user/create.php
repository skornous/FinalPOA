<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo BASE_URL . '/users';?>"><?php echo $lang->USERLIST;?></a></li>
		<li class="active"><?php echo $lang->ADD; ?></a></li>
	</ol>
	<h1> <?php echo $lang->ADD; ?> </h1>
	<br><br>
	<form method="POST" action="<?php echo BASE_URL; ?>/users/create" name="form_add">
		<div role="form-group" role="form">
			<div class="row">
				<label class="col-sm-2 control-label" for="firstname"><?php echo $lang->FNAME; ?> <span class="star-important">*</span></label>  
				<div class="col-sm-10 form-group">
					<input type="text" name="firstname" required="required" class="form-control" value="<?php if(isset($formDatas) && isset($formDatas["firstname"])) echo $formDatas["firstname"]; ?>">
				</div>
			</div>

			<div class="row">
				<label class="col-sm-2 control-label" for="lastname"><?php echo $lang->LNAME; ?> <span class="star-important">*</span></label>  
				<div class="col-sm-10 form-group">
					<input type="text" name="lastname" required="required" class="form-control" value="<?php if(isset($formDatas) && isset($formDatas["lastname"])) echo $formDatas["lastname"];?>">
				</div>
			</div>

			<div class="row">
				<label class="col-sm-2 control-label" for="email"><?php echo $lang->EMAIL; ?> <span class="star-important">*</span></label>  
				<div class="col-sm-10 form-group">
					<input type="email" name="email" required="required" class="form-control" value="<?php if(isset($formDatas) && isset($formDatas["email"])) echo $formDatas["email"];?>">
				</div>
			</div>

			<div class="row">
				<label class="col-sm-2 control-label" for="login"><?php echo $lang->LOGIN; ?> <span class="star-important">*</span></label>  
				<div class="col-sm-10 form-group">
					<input type="text" name="login" required="required" class="form-control" value="<?php if(isset($formDatas) && isset($formDatas["login"])) echo $formDatas["login"];?>">
				</div>
			</div>

			<div class="row">
				<label class="col-sm-2 control-label" for="password"><?php echo $lang->PSWD; ?> <span class="star-important">*</span></label>
				<div class="col-sm-2 form-group">
					<input type="password" required="required" class="form-control" name="password" value="" onclick="this.select()" >
				</div>
				<div class="col-sm-6 form-group">
					<select name="charLen" id="charLen">
						<option value="8" selected="">8</option>
						<?php for ($i=9;$i<=18;$i++): ?>
							<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
						<?php endfor; ?>
					</select>
					<input type="checkbox" name="uppercase" checked> Uppercase included 
					<input type="checkbox" name="figures" checked> Figures included 
					<input type="checkbox" name="punctuation" > Special chars included 
				</div>
				<div class="col-sm-2 form-group">
					<input class="btn btn-default" type="button" value=" Generate Password " style="font-size: 1.1em;" onclick="GeneratePassword()"></td>
				</div>
			</div>

			<div class="row">
				<label class="col-sm-2 control-label" for="teams"><?php echo $lang->TEAMS; ?> :</label>  
				<div class="col-sm-10 form-group">
					<select multiple="multiple" class="form-control" name="teams[]">
						<?php foreach ($teams as $team): ?>
							<option value="<?php echo $team["id"]; ?>"<?php 
								if (isset($formDatas) && isset($formDatas["teams"])) {
									if (
										(is_array($formDatas["teams"]) && in_array($team, $formDatas["teams"]))
										|| (is_string($formDatas["teams"]) && $formDatas["teams"] == $team)
									) {
										echo ' selected="selected"';
									}
								} 
							?>><?php echo $team["name"]; ?></option>
						<?php endforeach; ?>
					</select>
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
<script src="../libs/GeneratePSWD/generate_password.js"></script>