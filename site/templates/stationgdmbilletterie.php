<?php snippet('stationgdm-header') ?>

<div class="row">
	<div class="col-1 section white">
		<div class="page section title border-bottom large bold cap">
			<p>
				<?= $page->title() ?>
			</p>
		</div>
	</div>
	<div class="col-1 white border-bottom">
	<?php foreach ($page->contents()->toBlocks() as $block): ?>
		<div id="<?= $block->id() ?>" class="component block1x1 border-bottom">
		  <?= $block ?>
		</div>
	<?php endforeach ?>
	</div>
</div>

<?php snippet('stationgdm-footer') ?>
