<div class="navbar navbar-default">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?php echo BASE_URL; ?>"><?php echo $lang->APPNAME; ?></a>
		</div>
		<div class="collapse navbar-collapse">
			<?php if (isset($loggedUser)): ?>
			<ul class="nav navbar-nav">
				<?php if ($loggedUser->can("see", "data")): ?>
					<!-- <li class="dropdown"><a href="<?php echo BASE_URL . "/datas";?>"><?php echo $lang->MDATA; ?></a></li> -->
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $lang->MDATA; ?><span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="<?php echo BASE_URL; ?>/datas/real_time"><?php echo $lang->RTDATAS; ?></a></li>
							<li><a href="<?php echo BASE_URL; ?>/datas/stocked"><?php echo $lang->SDATAS; ?></a></li>
						</ul>
					</li>
				<?php endif; ?>
				<?php if ($loggedUser->can("see", "data")): ?>
					<!-- Datas -->
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $lang->MDATAADMIN; ?><span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
						<?php if ($loggedUser->isPartOf("Netbackup") || $loggedUser->isPartOf("GenericUser")): ?>
							<li class="dropdown-submenu">
								<a href="#"><?php echo $lang->M_NETBACKUP; ?></a>
								<ul class="dropdown-menu">
									<?php if ($loggedUser->can("see", "data")): ?>
									<li><a href="<?php echo BASE_URL . "/datas/netbackup";?>"><?php echo $lang->DATALIST; ?></a></li>
									<?php endif; ?>
									<?php if ($loggedUser->can("add", "data")): ?>
									<li><a href="<?php echo BASE_URL . "/datas/netbackup/create";?>"><?php echo $lang->CREATE; ?></a></li>
									<?php endif; ?>
									<?php if ($loggedUser->can("add", "data") && $loggedUser->canAccessEditMenuOnObject("server")): ?>
									<li class="divider"></li>
									<?php endif; ?>
									<?php if ($loggedUser->canAccessEditMenuOnObject("server")): ?>
									<li class="dropdown-submenu">
										<a href="#"><?php echo $lang->M_MSERVER; ?></a>
										<ul class="dropdown-menu">
											<?php if ($loggedUser->can("see", "server")): ?>
											<li><a href="<?php echo BASE_URL . "/servers";?>"><?php echo $lang->MSERVERLIST; ?></a></li>
											<?php endif; ?>
											<?php if ($loggedUser->can("add", "server")): ?>
											<li><a href="<?php echo BASE_URL . "/servers/create";?>"><?php echo $lang->CREATE; ?></a></li>
											<?php endif; ?>
										</ul>
									</li>
									<?php endif; ?>
								</ul>
							</li>
						<?php endif; ?>
						<?php if ($loggedUser->isPartOf("BT") || $loggedUser->isPartOf("GenericUser")): ?>
							<li class="dropdown-submenu">
								<a href="#"><?php echo $lang->M_BT; ?></a>
								<ul class="dropdown-menu">
									<?php if ($loggedUser->can("see", "data")): ?>
									<li><a href="<?php echo BASE_URL . "/datas/bt";?>"><?php echo $lang->DATALIST; ?></a></li>
									<?php endif; ?>
									<?php if ($loggedUser->can("add", "data")): ?>
									<li><a href="<?php echo BASE_URL . "/datas/bt/create";?>"><?php echo $lang->CREATE; ?></a></li>
									<?php endif; ?>
								</ul>
							</li>
						<?php endif; ?>
						</ul>
					</li>
				<?php endif; ?>
				<?php if ($loggedUser->canAccessEditMenuOnObject("user")): ?>
					<!-- Users -->
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $lang->MADMIN; ?><span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li class="dropdown-submenu">
								<a href="#"><?php echo $lang->MUSERS; ?></a>
								<ul class="dropdown-menu">
									<?php if ($loggedUser->can("see", "user")): ?>
									<li><a href="<?php echo BASE_URL . "/users";?>"><?php echo $lang->USERLIST; ?></a></li>
									<?php endif; ?>
									<?php if ($loggedUser->can("see", "user") && $loggedUser->can("add", "user")): ?>
									<li class="divider"></li>
									<?php endif; ?>
									<?php if ($loggedUser->can("add", "user")): ?>
									<li><a href="<?php echo BASE_URL . "/users/create";?>"><?php echo $lang->CREATE; ?></a></li>
									<?php endif; ?>
								</ul>
							</li>
						</ul>
					</li>
				<?php endif; ?>
			</ul>
			<?php endif;?>
			<ul class="nav navbar-nav navbar-right">
				<?php if (!isset($loggedUser)):?>
					<li<?php if ($page=="connect") echo ' class="active"'; ?>><a href="<?php echo BASE_URL . "/connect";?>"><?php echo $lang->CONNECT; ?></a></li>
				<?php else:?>
					<li<?php if ($page=="connect") echo ' class="active"'; ?>>
						<a href="<?php echo BASE_URL; ?>/users/change_password" >
							<span class="label label-primary" data-toggle="tooltip" data-placement="bottom" title="<?php echo $lang->CHANGEPSWD; ?>"><?php echo $loggedUser->firstname . " " . $loggedUser->lastname; ?></span>
						</a>
					</li>
					<li> 
						<a href="<?php echo BASE_URL . "/disconnect";?>"><span class="label label-danger"><?php echo $lang->DECONNEXION; ?></span></a>
					</li>
				<?php endif;?>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $lang->LANG; ?><span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="?lang=en"><?php echo $lang->LEN; ?></a></li>
						<li><a href="?lang=fr"><?php echo $lang->LFR; ?></a></li>
					</ul>
				</li>
			</ul>
		</div><!--/.nav-collapse -->
	</div><!-- /.container -->
</div> <!-- /.navbar.navbar-default -->