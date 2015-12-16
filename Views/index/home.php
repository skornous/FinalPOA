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

				<?php for ($i = 0; $i < 12; $i++) { ?>
					<div class="column">
						<img class="thumbnail" src="https://media.giphy.com/media/nguAwtOo4nxAY/giphy.gif">
						<h5>Penguins</h5>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>