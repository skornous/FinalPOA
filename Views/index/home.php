<div class="off-canvas-wrapper">
	<div class="off-canvas-wrapper-inner" data-off-canvas-wrapper>

		<?php include '/Views/templates/menu.php'; ?>

		<div class="off-canvas-content" data-off-canvas-content>
			<div class="title-bar hide-for-large">
				<div class="title-bar-left">
					<button class="menu-icon" type="button" data-open="my-info"></button>
					<span class="title-bar-title">Games</span>
				</div>
			</div>
			<div class="row small-up-2 medium-up-3 large-up-4">

				<?php for ($i = 1; $i < 9; $i++) { ?>
					<div class="column">
						<a href="<?php echo BASE_URL."/game/".$i;?>">
							<img class="thumbnail" src="<?php echo BASE_URL."/img/harf01.jpg" ?>">
							<h5>Game <?php echo $i; ?></h5>
						</a>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>